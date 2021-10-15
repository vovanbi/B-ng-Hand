<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderTest extends TestCase
{
    public function testBelongsToUser()
    {
        $order = new Order();

        $relation = $order->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('orders.o_user_id', $relation->getQualifiedForeignKeyName());

        $this->assertEquals('users.id', $relation->getQualifiedOwnerKeyName());
    }
    public function testHasManyOrderDetails()
    {
        $order = new Order();

        $relation = $order->orderDetails();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('order_detail.od_orders_id', $relation->getQualifiedForeignKeyName());
    }
}
