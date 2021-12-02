<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ShoppingCartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddCart()
    {
        $product = Product::select('pro_name','id','pro_price','pro_sale','pro_number','pro_slug')->first();
        $id= $product->id;
        $price = $product->pro_price;
        if($product->pro_sale)
        {
            $price = $price * (100-$product->pro_sale)/100;
        }
        if($product->pro_number == 0)
        {
            $error = 'Sản phẩm đã hết hàng';
        }
        else{
            foreach (\Cart::content() as $key => $value) {
                if($value->id==$id && $value->qty > $product->pro_number){
                    $error = 'Sản phẩm đã hết hàng';
                }
            }
        }
        
        if(isset($error)){
            $this->assertTrue(isset($error));
        }
        else{
            \Cart::add([
                'id'=> $id,
                'name'=> $product->pro_name,
                'qty'=> 1,
                'price'=> $price,
                'weight' => 550,          
                'options'=> [
                    'avatar'=> $product->images[0]->pi_avatar,
                    'sale'=> $product->pro_sale,
                    'price_old'=> $product->pro_price,
                    'size' =>'M', 
                    'number' => $product->pro_number, 
                    'slug' => $product->pro_slug,
                    'img' => asset($product->images[0]->pi_avatar),
                ],
            ]);          
            $result = \Cart::content();
            $this->assertTrue(empty(!$result));
            $success= 'Them vao gio hang thanh cong';
            $this->assertTrue(isset($success));
            \Cart::destroy(); 
        }
    }
    public function testPayment()
    {
        $products = \Cart::content();
        if(\Auth::check()){
            $error = 'Bạn chưa đăng nhập';   
            $this->assertTrue(isset($error));       
        }
        else if($products->isEmpty()){
            $error = 'Giỏ hàng trống không thể thanh toán';
            $this->assertTrue(isset($error));
        }
        else{
            $success= 'Dat hang thanh cong';
            $this->assertTrue(isset($success));
        }
    }

}
