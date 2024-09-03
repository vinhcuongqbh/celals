<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory; 

    protected $table = 'posts';
    protected $primaryKey = 'post_id';

    public function catalogue() : BelongsTo {
        return $this->belongsTo(PostCatalogue::class, 'post_catalogue_id', 'post_catalogue_id')->withDefault();
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'post_author_id', 'user_id')->withDefault();
    }
       
}
