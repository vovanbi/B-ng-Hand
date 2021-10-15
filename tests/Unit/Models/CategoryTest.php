<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryTest extends TestCase
{
    public function testHasManyProducts()
    {
        $category = new Category();

        $relation = $category->products();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('products.pro_category_id', $relation->getQualifiedForeignKeyName());
    }
}
