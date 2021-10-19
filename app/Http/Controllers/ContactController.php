<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Tintnaingwin\EmailChecker\Facades\EmailChecker;
use App\Http\Requests\RequestContact;
class ContactController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getContact()
    {
        return view('info.contact');
    }
    public function saveContact(RequestContact $request)
    {
        $data = $request->except('_token');
        Contact::insert($data);
        return redirect()->back()->with('success','Gủi phản hồi thành công');
    }
}
