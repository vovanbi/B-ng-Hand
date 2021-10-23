<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use WithoutMiddleware;
use App\Models\User;

class RegisterControllerTest extends TestCase
{
	public function testViewIndexCategory(){
    	$response = $this->get('/dang-ky');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register')->assertSee('Đăng ký');
    }
    public function testCanRegister()
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
	    $response= $this->post('/dang-ky', [
	        'email' => $user['email'],
	        'password' => $user['password'],
	        'password_confirmation' => $user['password_confirmation'],
	        'name' => $user['name'],
	        'phone' => $user['phone'],
	        'address' => $user['address'],
	    ]);
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
	    $response= $this->post('/dang-ky', [
	        'email' => $user['email'],
	        'password' => $user['password'],
	        'password_confirmation' => $user['password_confirmation'],
	        'name' => $user['name'],
	        'phone' => $user['phone'],
	        'address' => $user['address'],
	    ]);
	    $newUser = User::where('email','=',$user['email'])->first();
	    $this->assertFalse(isset($newUser));
	    $response->assertRedirect('/');
	    $response->assertStatus(302);
	}
}
