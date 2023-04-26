<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostCatalogue;

class PostCatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postCatalogue =  [
            [                
                'post_catalogue_name' => 'Giới thiệu',
            ],
            [
                'post_catalogue_name' => 'Sự kiện nổi bật',
            ],
            [
                'post_catalogue_name' => 'Tin tức',
            ],
        ];

        PostCatalogue::insert($postCatalogue);
    }
}
