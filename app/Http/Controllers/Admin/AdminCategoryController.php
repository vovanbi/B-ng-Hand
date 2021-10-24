<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\RequestCategory;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories= Category::select('id','c_name','c_avatar','c_home')->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RequestCategory $requestCategory)
    {
        $this->insertOrUpdate($requestCategory);
        return redirect()->back()->with('success','Thêm mới thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.update',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RequestCategory $requestCategory,$id)
    {
        $this->insertOrUpdate($requestCategory,$id);
        return redirect()->back()->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function insertOrUpdate($requestCategory,$id='')
    {
        $category= new Category();
        if($id) $category= Category::find($id);
        $category->c_name = $requestCategory->name;
        $category->c_slug = Str::slug($requestCategory->name);
        if($requestCategory->hasFile('avatar'))
        {
            if($id!=''){
                $unlink= 'uploads/category/'.$category->c_avatar;
                unlink($unlink);
            }
            $name = date("y-m-d-h-m-s", time()) .'_'. $requestCategory->avatar->getClientOriginalName();
            $requestCategory->avatar->move(public_path().'/uploads/category', $name);
            //save image
            $category->c_avatar = $name;
        }
        $category->save();

    }
    public function action($action,$id)
    {
        if($action)
        {
            $category = Category::find($id);
            switch ($action)
            {
                case 'delete':
                    $products = Product::where('pro_category_id','=',$category->id)->get();
                    foreach ($products as $key => $item) {
                        foreach ($item->images as $key => $value) {
                            $unlink= 'uploads/'.$value->pi_avatar;
                            unlink($unlink);
                            $value->delete();
                        }
                        $item->delete();
                    }
                    if($category->c_avatar){
                        $unlink= 'uploads/category/'.$category->c_avatar;
                        unlink($unlink);
                    }
                    $category->delete();
                    $messages = 'Xoá thành công';
                    
                    break;
                case 'home':
                    $category->c_home = $category->c_home == 1 ? 0 : 1;
                    $messages = 'Cập nhật thành công';
                    $category->save();
                    break;
            }
        }
        return redirect()->back()->with('success',$messages);
    }
}
