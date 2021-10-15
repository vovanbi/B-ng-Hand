<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Images;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImageTest extends TestCase
{
    public function testBelongsToProduct()
    {
        $image = new Images();

        $relation = $image->product();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('product_images.pi_product_id', $relation->getQualifiedForeignKeyName());

        $this->assertEquals('products.id', $relation->getQualifiedOwnerKeyName());
    }
}
