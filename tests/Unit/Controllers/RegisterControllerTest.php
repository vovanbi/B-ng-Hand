<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use WithoutMiddleware;
use App\Models\User;

class RegisterControllerTest extends TestCase
{
	public function testViewIndexRegister(){
    	$response = $this->get('/dang-ky');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register')->assertSee('Đăng ký');
    }
    public function testRegister()
    {	
    	$user= [
	        'email' => 'ShoesShop.UED1@gmail.com',
	        'password' => '12345678',
	        'password_confirmation' => '12345678',
	        'name' => 'Nguyen Van A',
	        'phone' => '0369026023',
	        'address' => '491 Ton Duc Thang',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-ky', $user);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertTrue(isset($newUser));
	    $newUser->delete();
	    $response->assertRedirect('/dang-nhap');
	    $response->assertStatus(302);
    }
    public function testCannotRegisterWithIncorrectConfirmPassword()
	{
	    $user= [
	        'email' => 'ShoesShop.UED1@gmail.com',
	        'password' => '12345678',
	        'password_confirmation' => '123456789',
	        'name' => 'Nguyen Van A',
	        'phone' => '0369026023',
	        'address' => '491 Ton Duc Thang',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-ky', $user);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertFalse(isset($newUser));
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	}
	public function testCannotRegisterWithEmailUnique()
	{
	    $user= [
	    	'email' => 'ShoesShop.UED@gmail.com',
	        'password' => '12345678',
	        'password_confirmation' => '12345678',
	        'name' => 'Nguyen Van A',
	        'phone' => '0369026023',
	        'address' => '491 Ton Duc Thang',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-ky', $user);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertTrue(isset($newUser));
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	}
	public function testCannotRegisterWithNoEmail()
	{
	    $user= [
	    	'email' => '',
	        'password' => '12345678',
	        'password_confirmation' => '12345678',
	        'name' => 'Nguyen Van A',
	        'phone' => '0369026023',
	        'address' => '491 Ton Duc Thang',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-ky', $user);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertFalse(isset($newUser));
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	}
	public function testCannotRegisterWithNoPassword()
	{
	    $user= [
	    	'email' => 'ShoesShop.UED1@gmail.com',
	        'name' => 'Nguyen Van A',
	        'phone' => '0369026023',
	        'address' => '491 Ton Duc Thang',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-ky', $user);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertFalse(isset($newUser));
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	}
	public function testCannotRegisterWithNoName()
	{
	    $user= [
	    	'email' => 'ShoesShop.UED1@gmail.com',
	    	'password' => '12345678',
	        'password_confirmation' => '12345678',
	        'phone' => '0369026023',
	        'address' => '491 Ton Duc Thang',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-ky', $user);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertFalse(isset($newUser));
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	}
	public function testCannotRegisterWithNoAddress()
	{
	    $user= [
	    	'email' => 'ShoesShop.UED1@gmail.com',
	    	'password' => '12345678',
	        'password_confirmation' => '12345678',
	        'name' => 'Nguyen Van A',
	        'phone' => '0369026023',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-ky', $user);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertFalse(isset($newUser));
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	}
	public function testCannotRegisterWithPasswordMin()
	{
	    $user= [
	    	'email' => 'ShoesShop.UED1@gmail.com',
	    	'password' => '123456',
	        'password_confirmation' => '123456',
	        'name' => 'Nguyen Van A',
	        'address' => '491 Ton Duc Thang',
	        'phone' => '0369026023',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-ky', $user);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertFalse(isset($newUser));
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	}
	public function testCannotRegisterWithIncorrectPhone()
	{
	    $user= [
	    	'email' => 'ShoesShop.UED1@gmail.com',
	    	'password' => '12345678',
	        'password_confirmation' => '12345678',
	        'name' => 'Nguyen Van A',
	        'address' => '491 Ton Duc Thang',
	        'phone' => '0369',
	    ];
	    $this->withoutMiddleware();
	    $response= $this->post('/dang-ky', $user);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertFalse(isset($newUser));
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	}
}
