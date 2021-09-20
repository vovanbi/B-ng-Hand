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
        $users = User::all();
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
                    $user->delete();
                    break;
            }

        }
        return redirect()->back();
    }
    
}
