<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomePageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string'],
            'email' => ['required', 'email:filter', 'max:255'],
            
        ]);

        if ($validation->fails()) {
            return response()->json(['code' => 400, 'msg' => $validation->errors()->first()]);
        }

        $name = $request->name;
        $mobile = $request->mobile;
        $email = $request->email;
       

        $msg = "
        Name: $name \n
        Mobile: $mobile \n
        Email: $email
        ";

        $receiver = "pashaofficial4u@gmail.com";
        Mail::to($receiver)->send(new ContactMail($msg));
        return response()->json(['code' => 200, 'msg' => 'Thanks for contacting us, we will get back to you soon.']);
    }
    
    // public function sendEmail(Request $req)
    // {
    //     $data=[
    //         'name' =>$req->name,
    //         'mobile' =>$req->mobile,
    //         'email' =>$req->email
    //     ];
    //     Mail::to('pashaofficial4u@gmail.com')->send(new ContactMail($data));
    //     return response()->json(['success' => 'Your E-mail was sent! Allegedly.'],200);
    //     // return redirect()->back();
    //    // return redirect()->back()->withSuccess('IT WORKS!');
    //     // return redirect()->back()->with('message', 'IT WORKS!');
    //     // if($data){
    //     //     return redirect()->back()->with('message','You have signed in successful');
    //     // } else {
    //     //     return redirect()->back()->with('message','something went wrong');
    //     // }
    // }
}

