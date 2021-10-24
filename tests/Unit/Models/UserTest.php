<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserTest extends TestCase
{
    public function testHasManyRatings()
    {
        $user = new User();

        $relation = $user->rating();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('ratings.ra_user_id', $relation->getQualifiedForeignKeyName());
    }
    public function testHasManyOrders()
    {
        $user = new User();

        $relation = $user->orders();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('orders.o_user_id', $relation->getQualifiedForeignKeyName());
    }
}
