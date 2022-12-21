<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbHashValue = $user->password;

        // dd($dbPassword);
        // dd('changePassword');
        // $hashValue = Hash::make('kaung');

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = ['password' => Hash::make($request->newPassword)];

            User::where('id',Auth::user()->id)->update($data);

            // Auth::logout();
            return redirect()->route('category#list')->with(['changeSuccess'=>'Password Changed Success....']);
        }
        return back()->with(['notMatch'=>'The old password not Match . Try Again!']);
    }

    //admin direct details page
    public function details(){
        return view('admin.account.details');
    }

    //driect admin profile edit
    public function edit(){
        return view('admin.account.edit');
    }

    //direct admin profile update
    public function update(Request $request,$id){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            //old image name | check | delete |store
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated ...']);
    }

    //admin list
    public function list(){
        $admin = User::when(request('key') ,function($q){
            $q->orWhere('name','like','%'.request('key').'%')
              ->orWhere('email','like','%'.request('key').'%')
              ->orWhere('address','like','%'.request('key').'%')
              ->orWhere('gender','like','%'.request('key').'%');
        })->where('role','admin')->paginate(3);
        return view('admin.account.list',compact('admin'));
    }

    //admin delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Admin Account deleted']);
    }

    //change Role page
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //change role
    public function change(Request $request,$id){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //ajax change user
    //change status
    public function ajaxChangeUser(Request $request){
        logger($request->all());
        User::where('id',$request->userId)->update([
            'role'=> $request->status
        ]);
    }

    //request user data role
    private function requestUserData($request){
        return [
            'role' => $request->role,
        ];
    }

    //request user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'image' => 'mimes:png,jpg,jpeg|file'
        ])->validate();
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=> 'required|min:6|max:10',
            'newPassword'=> 'required|min:6|max:10',
            'confirmPassword'=> 'required|min:6|max:10|same:newPassword',
        ])->validate();
    }

}
