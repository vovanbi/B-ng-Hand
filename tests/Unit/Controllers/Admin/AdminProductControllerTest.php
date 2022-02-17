<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use WithoutMiddleware;

class AdminProductControllerTest extends TestCase
{
    public function testViewIndexAdminProduct(){
	    $this->withoutMiddleware();
	    $response = $this->post(route('post.login', ['email' => 'ShoesShop.UED@gmail.com','password' => '123',]));
    	$response = $this->get('admin/product');
    	$response->assertStatus(200);
    	$response->assertViewIs('admin.product.index')->assertSee('Quản lý sản phẩm');
    	$this->assertTrue(isset($response['products']));
    }
}
