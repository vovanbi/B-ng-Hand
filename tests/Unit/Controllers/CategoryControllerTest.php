<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Product;

class CategoryControllerTest extends TestCase
{
	public function testViewIndexCategory(){
    	$response = $this->get('/san-pham');
        $response->assertStatus(200);
        $response->assertViewIs('product.index')->assertSee('Sản Phẩm');
    }
    public function testValueArrayIndexCategory(){
    	$response = $this->get('/san-pham');
        $this->assertTrue(isset($response['categories']));
        $this->assertEquals(5, $response['categories']->count());
    }
    public function testValueArrayIndexProduct(){
        $response = $this->get('/san-pham');
        $this->assertTrue(isset($response['products']));
        $this->assertEquals(6, $response['products']->count());
    }
}
