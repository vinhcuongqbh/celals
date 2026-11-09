<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class BunnyStorageService
{
    private function storageBaseUrl(): string
    {
        $region = config('services.bunny.storage_region', 'storage');

        $host = $region === 'storage'
            ? 'storage.bunnycdn.com'
            : $region . '.storage.bunnycdn.com';

        return 'https://' . $host;
    }

    /**
     * Upload file lên Bunny Storage và trả về URL CDN.
     */
    public function upload(UploadedFile $file, string $folder): string
    {
        $zone = config('services.bunny.storage_zone');
        $password = config('services.bunny.storage_password');
        $cdnUrl = rtrim(config('services.bunny.cdn_url'), '/');

        if (!$zone || !$password || !$cdnUrl) {
            throw new RuntimeException('Thiếu cấu hình Bunny Storage trong .env.');
        }

        // Tạo tên file duy nhất, tránh ghi đè file đang được sử dụng.
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid('', true) . ($extension ? '.' . $extension : '');

        $folder = trim($folder, '/');
        $path = ($folder !== '' ? $folder . '/' : '') . $filename;

        $segments = array_map('rawurlencode', explode('/', $path));

        $url = $this->storageBaseUrl()
            . '/' . rawurlencode($zone)
            . '/' . implode('/', $segments);

        $response = Http::withHeaders([
            'AccessKey' => $password,
        ])
            ->timeout(120)
            ->withBody(
                file_get_contents($file->getRealPath()),
                $file->getMimeType() ?: 'application/octet-stream'
            )
            ->put($url);

        if (!$response->successful()) {
            throw new RuntimeException(
                'Upload Bunny thất bại. HTTP ' . $response->status()
                    . ': ' . $response->body()
            );
        }

        return $cdnUrl . '/' . implode('/', $segments);
    }

    /**
     * Xóa file trên Bunny bằng URL CDN đã lưu trong database.
     */
    public function deleteByCdnUrl(?string $cdnFileUrl): void
    {
        if (empty($cdnFileUrl)) {
            return;
        }

        $cdnBase = rtrim(config('services.bunny.cdn_url'), '/');
        $expectedHost = parse_url($cdnBase, PHP_URL_HOST);
        $actualHost = parse_url($cdnFileUrl, PHP_URL_HOST);
        $scheme = parse_url($cdnFileUrl, PHP_URL_SCHEME);

        // Chỉ cho phép xóa file thuộc CDN đã cấu hình.
        if (
            !$expectedHost ||
            strtolower((string) $actualHost) !== strtolower($expectedHost) ||
            strtolower((string) $scheme) !== 'https'
        ) {
            throw new RuntimeException(
                'URL file không thuộc CDN Bunny đã cấu hình; không xóa file.'
            );
        }

        $path = ltrim((string) parse_url($cdnFileUrl, PHP_URL_PATH), '/');

        if ($path === '') {
            throw new RuntimeException('Đường dẫn file Bunny không hợp lệ.');
        }

        $zone = config('services.bunny.storage_zone');

        // URL CDN phải trỏ trực tiếp đến file trong Storage Zone.
        $segments = array_map('rawurlencode', explode('/', $path));

        $url = $this->storageBaseUrl()
            . '/' . rawurlencode($zone)
            . '/' . implode('/', $segments);

        $response = Http::withHeaders([
            'AccessKey' => config('services.bunny.storage_password'),
        ])
            ->timeout(30)
            ->delete($url);

        if (!$response->successful()) {
            throw new RuntimeException(
                'Xóa file Bunny thất bại. HTTP ' . $response->status()
                    . ': ' . $response->body()
            );
        }
    }
}
