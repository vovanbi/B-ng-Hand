<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use WithoutMiddleware;

class AdminRatingControllerTest extends TestCase
{
    public function testViewIndexAdminRating(){
	    $this->withoutMiddleware();
	    $response = $this->post(route('post.login', ['email' => 'ShoesShop.UED@gmail.com','password' => '123',]));
    	$response = $this->get('admin/rating');
    	$response->assertStatus(200);
    	$response->assertViewIs('admin.rating.index')->assertSee('Quản lý đánh giá');
    	$this->assertTrue(isset($response['ratings']));
    }
}
