<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;
class AdminRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $ratings = Rating::with('product:id,pro_name','user:id,name')->paginate(10);
        $viewData = [
            'ratings'=>$ratings,
        ];

        return view('admin.rating.index',$viewData);
    }
   public function action($action,$id)
    {
        if($action)
        {
            $rating = Rating::find($id);
            switch ($action)
            {
                case 'delete':
                    $rating->delete();
                    $messages = 'Xoá thành công';
                    break;
            }

        }
        return redirect()->back()->with('success',$messages);
    }
    
}
