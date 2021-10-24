<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductTest extends TestCase
{
    public function testBelongsToCategory()
    {
        $product = new Product();

        $relation = $product->category();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('products.pro_category_id', $relation->getQualifiedForeignKeyName());

        $this->assertEquals('categories.id', $relation->getQualifiedOwnerKeyName());
    }
    public function testHasManyImages()
    {
        $product = new Product();

        $relation = $product->images();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('product_images.pi_product_id', $relation->getQualifiedForeignKeyName());
    }
    public function testHasManyRatings()
    {
        $product = new Product();

        $relation = $product->rating();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('ratings.ra_product_id', $relation->getQualifiedForeignKeyName());
    }
}
