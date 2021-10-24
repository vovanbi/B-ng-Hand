<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingTest extends TestCase
{
    public function testBelongsToUser()
    {
        $rating = new Rating();

        $relation = $rating->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('ratings.ra_user_id', $relation->getQualifiedForeignKeyName());

        $this->assertEquals('users.id', $relation->getQualifiedOwnerKeyName());
    }
    public function testBelongsToProduct()
    {
        $rating = new Rating();

        $relation = $rating->product();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('ratings.ra_product_id', $relation->getQualifiedForeignKeyName());

        $this->assertEquals('products.id', $relation->getQualifiedOwnerKeyName());
    }
}
