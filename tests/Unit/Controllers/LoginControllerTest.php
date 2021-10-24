<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use WithoutMiddleware;
use App\Models\User;

class LoginControllerTest extends TestCase
{
	public function testViewIndexCategory(){
    	$response = $this->get('/dang-nhap');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login')->assertSee('Đăng nhập');
    }
    public function testCanLoginAdmin()
    {
    	$user= [
	        'email' => 'ShoesShop.UED@gmail.com',
	        'password' => '123',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap', [
	        'email' => $user['email'],
	        'password' => $user['password'],
	    ]);

	    $response->assertRedirect('/admin');
	    $response->assertStatus(302);
	    $this->assertTrue(\Auth::attempt($user));
    }
    public function testCanLogin()
    {
    	$user= [
	        'email' => 'hungbbtbbt10@gmail.com',
	        'password' => 'fingerg12',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap', [
	        'email' => $user['email'],
	        'password' => $user['password'],
	    ]);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertTrue(\Auth::attempt($user));
    }
    public function testCannotLoginWithIncorrectPassword()
	{
	    $user= [
	        'email' => 'ShoesShop.UED@gmail.com',
	        'password' => '321',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap', [
	        'email' => $user['email'],
	        'password' => $user['password'],
	    ]);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
	}
	public function testLogout()
    {
	    $response= $this->get('/dang-xuat');
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::check());
    }
}
