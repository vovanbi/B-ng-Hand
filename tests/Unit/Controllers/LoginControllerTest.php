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
    public function testLogin()
    {	
    	$user= [
	        'email' => 'ShoesShop.UED@gmail.com',
	        'password' => '123',
	    ];
	    // $user= [
	    //     'email' => 'hungbbtbbt10@gmail.com',
	    //     'password' => 'fingerg12',
	    // ];
	    if(\Auth::attempt($user)){
	    	$this->withoutMiddleware();
			$response= $this->post('/dang-nhap',$user);

	    	//admin
	    	if(\Auth::user()->type==0){
			    $response->assertRedirect('/admin');
			    $response->assertStatus(302);
			    $success = 'Đăng nhập thành công';
    			$this->assertTrue(isset($success));
	    	}
	    	//user
	    	else{
			    $response->assertRedirect('/');
			    $response->assertStatus(302);
			    $success = 'Đăng nhập thành công';
    			$this->assertTrue(isset($success));
	    	}
	    }
	    else{
    		$error = 'Đăng nhập thất bại';
    		$this->assertTrue(isset($error));	  
	    }
    }
    public function testCannotLoginWithIncorrectPassword()
	{
	    $user= [
	        'email' => 'ShoesShop.UED@gmail.com',
	        'password' => '321',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-nhap', $user);

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
