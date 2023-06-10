<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id', 'image', 'path'
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

}
