<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use WithoutMiddleware;

class ShoppingCartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddCartSuccess()
    {
        $product = Product::find(5);
        $this->assertTrue($product->pro_number>0);
        $response = $this->get('/add/5');
        $result = \Cart::content();
        $this->assertTrue($result->isNotEmpty());
        \Cart::destroy();
    }
    public function testCannotAddCartWithOutOfProduct()
    {
        $product = Product::find(19);
        $this->assertEquals($product->pro_number,0);
        $response = $this->get('/add/19');   
        $result = \Cart::content();
        $this->assertTrue($result->isEmpty());
    }
    public function testCannotPaymentWithNoLogin()
    {   
        $this->assertFalse(\Auth::check());
        $response = $this->get('/gio-hang/thanh-toan');
        $response->assertStatus(302);
    }

    public function testCannotPaymentWithOutOfProduct()
    {   
        $product = Product::find(19);
        $this->assertEquals($product->pro_number,0);
        $response = $this->get('/add/19');   
        $result = \Cart::content();
        $this->assertTrue($result->isEmpty());
        $response = $this->get('/gio-hang/thanh-toan');
        $response->assertStatus(302);
    }

    public function testViewPaymentSuccess()
    {   
        $this->withoutMiddleware();
        $response = $this->post(route('post.login', ['email' => 'hungbbtbbt10@gmail.com','password' => 'fingerg12',]));

        $product = Product::find(5);
        $this->assertTrue($product->pro_number>0);
        $response = $this->get('/add/5');
        $result = \Cart::content();
        $this->assertTrue($result->isNotEmpty());

        $response = $this->get('/gio-hang/thanh-toan');
        $response->assertStatus(200);
    }
}
