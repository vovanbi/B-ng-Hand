<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\Images;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \SplFileInfo as SplFileInfo;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $products= Product::all();
        return view('admin.product.index',compact('products'));
    }
    public function create()
    {
        $categories= $this->getCategories();
        return view('admin.product.create',compact('categories'));
    }
    public function store(RequestProduct $requestProduct)
    {
        $this->insertOrUpdate($requestProduct);
        return redirect()->back()->with('success','Thêm mới thành công');
    }
    public function edit($id)
    {
        $categories= $this->getCategories();
        $product= Product::find($id);
        return view('admin.product.update',compact('product','categories'));
    }
    public function update(RequestProduct $requestProduct,$id)
    {
        $this->insertOrUpdate($requestProduct,$id);
        return redirect()->back()->with('success','Cập nhật thành công');
    }
    public function getCategories()
    {
        return Category::all();
    }
    public function insertOrUpdate($requestProduct,$id='')
    {  
        $product= new Product();
        if($id) $product= Product::find($id);
        $product->pro_name = $requestProduct->pro_name;
        $product->pro_slug = Str::slug($requestProduct->pro_name);
        $product->pro_category_id = $requestProduct->pro_category_id;
        $product->pro_price = $requestProduct->pro_price;
        $product->pro_number = $requestProduct->pro_number;
        $product->pro_sale = $requestProduct->pro_sale;
        $product->pro_gender = $requestProduct->pro_gender;
        $product->pro_content = $requestProduct->pro_content;
        $product->pro_title_seo = $requestProduct->pro_title_seo ? $requestProduct->pro_title_seo : $requestProduct->pro_name;
        
        $product->save();

        if($requestProduct->hasFile('avatar'))
        {
            foreach ($requestProduct->avatar as $key => $value) {
                $name = date("y-m-d-h-m-s", time()) .'_'. $value->getClientOriginalName();
                $value->move(public_path().'/uploads', $name);
                //save image
                $images= new Images();
                // if($id) $images= Images::find($product->pro_avatar);
                $images->pi_avatar = $name;
                $images->pi_product_id = $product->id;
                $images->save();
            }
        }
    }
    public function action($action,$id)
    {
        if($action)
        {
            $product = Product::find($id);
            switch ($action)
            {
                case 'active':
                    $product->pro_active = $product->pro_active ? 0 : 1;
                    $product->save();
                    $messages = 'Cập nhật thành công';
                    break;
                case 'hot':
                    $product->pro_hot = $product->pro_hot ? 0 : 1;
                    $product->save();
                    $messages = 'Cập nhật thành công';
                    break;
                case 'delete':
                    foreach ($product->images as $key => $value) {
                        $unlink= 'uploads/'.$value->pi_avatar;
                        unlink($unlink);
                        $value->delete();
                    }
                    $product->delete();
                    $messages = 'Xoá thành công';
                    break;
            }

        }
        return redirect()->back()->with('success',$messages);
    }
}
