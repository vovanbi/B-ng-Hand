<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(10);
        $viewData= [
            'contacts' => $contacts,
        ];
        return view('admin.contact.index',$viewData);
    }
    public function action($action,$id)
    {
        if($action)
        {
            $contact = Contact::find($id);
            switch ($action)
            {
                case 'status':
                    $contact->c_status = $contact->c_status ? 0 : 1;
                    $contact->save();
                    $messages= 'Cập nhật thành công';
                    break;
                case 'delete':
                    $contact->delete();
                    $messages= 'Xóa thành công';
                    break;
            }
        }
        return redirect()->back()->with('success',$messages);
    }
}
