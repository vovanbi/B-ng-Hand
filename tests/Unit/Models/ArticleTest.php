<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleTest extends TestCase
{
    public function testHasManyComments()
    {
        $article = new Article();

        $relation = $article->comments();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('comments.co_article_id', $relation->getQualifiedForeignKeyName());
    }
}
