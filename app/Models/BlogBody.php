<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogBody extends Model
{
    use HasFactory;

    protected $fillable = [
        'body','ArticleId'
    ];
    protected $table = 'blog-body';
    public $timestamps = false;


    public function article()
    {
        return $this->belongsTo(BlogArticle::class);
    }
}
