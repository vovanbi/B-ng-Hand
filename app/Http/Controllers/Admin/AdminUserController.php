<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = User::where('type','=',1)->get();
        $viewData = [
            'users'=>$users,
        ];

        return view('admin.user.index',$viewData);
    }
   public function action($action,$id)
    {
        if($action)
        {
            $user = User::find($id);
            switch ($action)
            {
                case 'delete':
                    if($user->rating){
                        foreach ($user->rating as $key => $value) {
                            $value->delete();
                        }
                    }
                    if($user->orders){
                        foreach ($user->orders as $key => $value) {
                            foreach($value->orderDetails as $key => $item){
                                $item->delete();
                            }
                            $value->delete();
                        }
                    }
                    if($user->avatar){
                        $unlink= 'uploads/user/'.$user->avatar;
                        unlink($unlink);
                    }                   
                    $user->delete();
                    $messages = 'Xoá thành công';
                    break;
            }

        }
        return redirect()->back()->with('success',$messages);
    }
    
}
