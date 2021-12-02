<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use WithoutMiddleware;

class AdminUserControllerTest extends TestCase
{
    public function testViewIndexAdminUser(){
	    $this->withoutMiddleware();
	    $response = $this->post(route('post.login', ['email' => 'ShoesShop.UED@gmail.com','password' => '123',]));
    	$response = $this->get('admin/user');
    	$response->assertStatus(200);
    	$response->assertViewIs('admin.user.index')->assertSee('Quản lý khách hàng');
    	$this->assertTrue(isset($response['users']));
    }
}
