<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table ='comments';
    use HasFactory;

    public function article()
    {
        return $this->belongsTo(Article::class,'co_article_id');
    }
}
