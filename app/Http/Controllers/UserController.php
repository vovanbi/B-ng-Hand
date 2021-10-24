<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;	
use App\Models\Order;    
use Illuminate\Support\Facades\Hash;

class UserController extends FrontendController
{

	public function __construct()
    {
        parent::__construct();
    }
    public function getUser()
    {
    	$user=User::find(auth()->id());
 
        $viewData=[
            'user' => $user
        ];
    	return view('user.index',$viewData);
      	
    }
    public function getSetting()
    {
        //info user
        $user=User::find(auth()->id());
    	return view('user.setting',compact('user'));
    }
    public function updateInfo(Request $request)
    {   
        $checkUser=User::where('email','=',$request->email)->first();
        $user=User::find(auth()->id());
        if($checkUser && $checkUser->email!=$user->email){
            return redirect()->back()->with('danger','Cập nhật thông tin thất bại');
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->address=$request->address;

        if($request->hasFile('avatar'))
        {
            if($user->avatar){
                $unlink= 'uploads/user/'.$user->avatar;
                unlink($unlink);
            }
            $name = date("y-m-d-h-m-s", time()) .'_'. $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path().'/uploads/user', $name);
            //save image
            $user->avatar = $name;
        }
        
        $user->save();
        return redirect()->back()->with('success','Cập nhật thông tin thành công');
    }
    public function updatePassword(Request $request)
    {
         
        $user=User::find(auth()->id());

        if(Hash::check($request->password,$user->password))
        {
            if($request->newpassword==$request->repassword)
            {
                $user->password=bcrypt($request->newpassword);
                $user->save();
                return redirect()->back()->with('success','Thay đổi mật khẩu thành công');
            }
            else{
                return redirect()->back()->with('danger','Nhập lại mật khẩu không đúng');
            }
        }
        else{
            return redirect()->back()->with('danger','Nhập sai mật khẩu');
        }    
    }

    public function destroy()
    {
        $user = User::find($id);
        $unlink= 'uploads/user/'.$user->avatar;
        unlink($unlink);
        $user->delete();
        return redirect()->back()->with('success','Xóa tài khoản thành công');
    }
    public function postUser()
    {
        $user = User::find(auth()->id());//id
        $orders = Order::where('o_user_id',auth()->id())->get();
        $totalorder = Order::where('o_user_id',auth()->id())->select('id')->count('id');
        $totalorderDone = Order::where([
            ['o_user_id',auth()->id()],
            ['o_status',Order::STATUS_DONE],
        ])->select('id')->count('id');
        $viewData = [
            'totalorder' => $totalorder,
            'totalorderDone' => $totalorderDone,
            'orders' => $orders,
            'user' => $user
        ];
        return view('user.post',$viewData);
    }
}
