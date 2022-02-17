<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Rating;
use WithoutMiddleware;

class RatingProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCannotRatingNoLogin()
    {
        $this->assertFalse(\Auth::check());
        $product = Product::find(5);
        $this->assertTrue(isset($product));
        $response = $this->get('/san-pham/'.$product->pro_slug);
        $response->assertStatus(200);
        $response->assertDontSee('Gửi Đánh Giá');
    }
    public function testCannotRatingNoBuy()
    {
        $user= [
            'email' => 'hungbbtbbt10@gmail.com',
            'password' => 'fingerg12',
        ];
        $this->withoutMiddleware();
        $response= $this->post('/dang-nhap',$user);
        $this->assertTrue(\Auth::check());

        $product = Product::find(19);
        $this->assertTrue(isset($product));
        $response = $this->get('/san-pham/'.$product->pro_slug);
        $response->assertStatus(200);
        $response->assertDontSee('Gửi Đánh Giá');
    }
    public function testCanRating()
    {
        $user= [
            'email' => 'hungbbtbbt10@gmail.com',
            'password' => 'fingerg12',
        ];
        $this->withoutMiddleware();
        $response= $this->post('/dang-nhap',$user);
        $this->assertTrue(\Auth::check());

        $product = Product::find(5);
        $this->assertTrue(isset($product));
        $response = $this->get('/san-pham/'.$product->pro_slug);
        $response->assertStatus(200);
        $response->assertSee('Gửi Đánh Giá');
    }
}
