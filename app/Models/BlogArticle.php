<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'main_image',
        'author',
        'slug'

    ];
    protected $table = 'blog-article';
    
    public function postBody()
    {
        return $this->hasOne(BlogBody::class,'ArticleId');
    }

    public function articleAuthor()
    {
        return $this->belongsTo(User::class,'author');
    }
}
