<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetailTest extends TestCase
{
    public function testBelongsToProduct()
    {
        $orderDetail = new OrderDetail();

        $relation = $orderDetail->product();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('order_detail.od_product_id', $relation->getQualifiedForeignKeyName());

        $this->assertEquals('products.id', $relation->getQualifiedOwnerKeyName());
    }
	public function testBelongsToOrder()
    {
        $orderDetail = new OrderDetail();

        $relation = $orderDetail->order();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('order_detail.od_orders_id', $relation->getQualifiedForeignKeyName());

        $this->assertEquals('orders.id', $relation->getQualifiedOwnerKeyName());
    }
}
