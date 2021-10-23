<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Product;

class ProductDetailControllerTest extends TestCase
{
	public function testViewIndexProductDetail(){
        $product = Product::first();
        $response = $this->get(route('get.detail.product', ['slug' => $product->pro_slug]));
        $response->assertStatus(200);
        $response->assertViewIs('product.detail')->assertSee('Chi Tiết');
    }
    public function testValueArrayIndexProductDetail(){
    	$product = Product::first();
        $response = $this->get(route('get.detail.product', ['slug' => $product->pro_slug]));
    	$this->assertTrue(isset($response['productDetail']));
    	$this->assertEquals($product->id, $response['productDetail']->id);
    }
}
