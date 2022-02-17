<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use WithoutMiddleware;
use App\Models\User;

class LoginControllerTest extends TestCase
{
	public function testViewIndexLogin(){
    	$response = $this->get('/dang-nhap');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login')->assertSee('Đăng nhập');
    }
    public function testAdminCanLogin()
    {
    	$user= [
	        'email' => 'ShoesShop.UED@gmail.com',
	        'password' => '123',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

	    $response->assertRedirect('/admin');
	    $response->assertStatus(302);
	    $this->assertTrue(\Auth::attempt($user));
    }
    public function testAdminCannotLoginWithIncorrectPassword()
    {
    	$user= [
	        'email' => 'ShoesShop.UED@gmail.com',
	        'password' => '321',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
    }
    public function testAdminCannotLoginWithIncorrectEmail()
    {
    	$user= [
	        'email' => '1ShoesShop.UED@gmail.com',
	        'password' => '123',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
    }
    public function testAdminCannotLoginNoEmail()
    {
    	$user= [
	        'password' => '123',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
    }
    public function testAdminCannotLoginNoPassword()
    {
    	$user= [
    		'email' => 'ShoesShop.UED@gmail.com',
    		'password' => '',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
    }
    public function testAdminCannotLoginNoEmailvsPassword()
    {
    	$user= [
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
    }
    public function testUserCanLogin()
    {
    	$user= [
	        'email' => 'hungbbtbbt10@gmail.com',
	        'password' => 'fingerg12',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertTrue(\Auth::attempt($user));
    }
    public function testUserCannotLoginWithIncorrectPassword()
	{
	    $user= [
	        'email' => 'hungbbtbbt10@gmail.com',
	        'password' => '123',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap', $user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
	}
	public function testUserCannotLoginWithIncorrectEmail()
	{
	    $user= [
	        'email' => '1hungbbtbbt10@gmail.com',
	        'password' => 'fingerg12',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap', $user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
	}
	public function testUserCannotLoginNoEmail()
    {
    	$user= [
	        'password' => 'fingerg12',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
    }
    public function testUserCannotLoginNoPassword()
    {
    	$user= [
    		'email' => 'hungbbtbbt10@gmail.com',
    		'password' => '',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	    $this->assertFalse(\Auth::attempt($user));
    }
    public function testUserCannotLoginNoEmailvsPassword()
    {
    	$user= [
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap',$user);

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
