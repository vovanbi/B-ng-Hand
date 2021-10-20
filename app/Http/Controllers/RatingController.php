<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RatingController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function saveRating(Request $request,$id)
    {
        Rating::insert([
            'ra_product_id' => $id,
            'ra_number' =>  $request->star,
            'ra_content' => $request->content,
            'ra_user_id' => auth()->id(),           
        ]);     

        $product = Product::find($id);
        $product->pro_total_number += $request->star;
        $product->pro_total_rating += 1;
        $product->save();
        
        return redirect()->back()->with('success','Đánh giá thành công');
    }
}