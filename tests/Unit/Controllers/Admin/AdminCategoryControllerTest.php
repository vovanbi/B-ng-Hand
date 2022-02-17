<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use WithoutMiddleware;

class AdminCategoryControllerTest extends TestCase
{
    public function testViewIndexAdminCategory(){
	    $this->withoutMiddleware();
	    $response = $this->post(route('post.login', ['email' => 'ShoesShop.UED@gmail.com','password' => '123',]));
    	$response = $this->get('admin/category');
    	$response->assertStatus(200);
    	$response->assertViewIs('admin.category.index')->assertSee('Quản lý danh mục');
    	$this->assertTrue(isset($response['categories']));
    }
}
