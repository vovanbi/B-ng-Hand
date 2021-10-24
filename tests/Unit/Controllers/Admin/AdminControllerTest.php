<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use WithoutMiddleware;

class AdminControllerTest extends TestCase
{
    public function testViewIndexAdmin(){
	    $this->withoutMiddleware();
	    $response = $this->post(route('post.login', ['email' => 'ShoesShop.UED@gmail.com','password' => '123',]));
    	$response = $this->get('admin');
    	$response->assertStatus(200);
    	$response->assertViewIs('admin.index')->assertSee('Thống Kê');
    }
}
