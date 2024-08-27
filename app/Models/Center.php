<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Center extends Model
{
    use HasFactory;

    protected $table = 'centers';
    protected $primaryKey = 'center_id';

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'center_id', 'center_id')->withDefault();
    }
}
