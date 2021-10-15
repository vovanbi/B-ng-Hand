<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentTest extends TestCase
{
    public function testBelongsToArticle()
    {
        $comment = new Comment();

        $relation = $comment->article();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('comments.co_article_id', $relation->getQualifiedForeignKeyName());

        $this->assertEquals('articles.id', $relation->getQualifiedOwnerKeyName());
    }
}
