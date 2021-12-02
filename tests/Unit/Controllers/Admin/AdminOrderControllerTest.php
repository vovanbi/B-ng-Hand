<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use WithoutMiddleware;

class AdminOrderControllerTest extends TestCase
{
    public function testViewIndexAdminOrder(){
	    $this->withoutMiddleware();
	    $response = $this->post(route('post.login', ['email' => 'ShoesShop.UED@gmail.com','password' => '123',]));
    	$response = $this->get('admin/order');
    	$response->assertStatus(200);
    	$response->assertViewIs('admin.order.index')->assertSee('Quản lý đơn hàng');
    	$this->assertTrue(isset($response['orders']));
    }
}
