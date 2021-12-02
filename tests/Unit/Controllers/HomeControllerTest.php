<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Product;

class HomeControllerTest extends TestCase
{
	public function testViewIndexHome(){
    	$response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('home')->assertSee('Shop Thời Trang - Bông Hand');
    }
    public function testValueArrayIndexHome(){
    	$response = $this->get('/');
    	$this->assertTrue(isset($response['productsHot']));
        $this->assertTrue(isset($response['productsSell']));
		$this->assertEquals(6, $response['productsSell']->count());
    }
}
