<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //Home page for contact
    public function contactHome(){
        return view('user.contact.contact');
    }

    //message send
    public function messageSend(Request $request){
        $this->messageValidationCheck($request);
        $data = $this->getMessageData($request);
        Contact::create($data);
        return redirect()->route('user#contactHome')->with(['success'=>'Send Message Success']);
    }

    //contact admin list page
    public function contactList(){
        $contact = Contact::when(request('key'),function($q){
            $key = request('key');
            $q->orWhere('name','like','%'.$key.'%')
              ->orWhere('email','like','%'.$key.'%');
        })
            ->orderBy('created_at','desc')->paginate(5);
        return view('admin.contact.list',compact('contact'));
    }

    //contact detail page
    public function contactDetail($id){
        $data = Contact::where('id',$id)->first();
        return view('admin.contact.detail',compact('data'));
    }

    //contact delete page
    public function contactDelete($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('admin#contactList')->with(['delete'=>'message is deleted']);
    }

    //validation check for message
    private function messageValidationCheck($request){
        Validator::make($request->all(),[
            'userName' => 'required',
            'userEmail' => 'required',
            'userMessage' => 'required|min:10'
        ])->validate();
    }

    //get message data
    private function getMessageData($request){
        return [
            'name' => $request->userName,
            'email' => $request->userEmail,
            'message' => $request->userMessage
        ];
    }
}
