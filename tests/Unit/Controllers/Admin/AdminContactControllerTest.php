<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use WithoutMiddleware;

class AdminContactControllerTest extends TestCase
{
    public function testViewIndexAdminContact(){
	    $this->withoutMiddleware();
	    $response = $this->post(route('post.login', ['email' => 'ShoesShop.UED@gmail.com','password' => '123',]));
    	$response = $this->get('admin/contact');
    	$response->assertStatus(200);
    	$response->assertViewIs('admin.contact.index')->assertSee('Quản lý liên hệ');
    }
}
