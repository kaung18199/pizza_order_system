<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //user filter
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //user change password
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
            return back()->with(['changeSuccess'=>'Password Changed Success....']);
        }
        return back()->with(['notMatch'=>'The old password not Match . Try Again!']);
    }

    //user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //user account change
    public function accountChange($id,Request $request){
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
        return back()->with(['updateSuccess'=>'Admin Account Updated ...']);
    }

    // pizzaDetails
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //cart list page
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')->leftJoin('products','products.id','carts.product_id')->where('carts.user_id',Auth::user()->id)->get();
        // dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty;
        }
        // dd($totalPrice);

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //direct history Page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }

     //password validation check
     private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=> 'required|min:6|max:10',
            'newPassword'=> 'required|min:6|max:10',
            'confirmPassword'=> 'required|min:6|max:10|same:newPassword',
        ])->validate();
    }

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
            'image' => 'mimes:png,jpg,jpeg,webp|file'
        ])->validate();
    }

    //Direct user list page
    public function userList(){
        $users = User::when(request('key'),function($q){
                $key = request('key');
                $q->orWhere('name','like','%'.$key.'%')
                  ->orWhere('email','like','%'.$key.'%')
                  ->orWhere('address','like','%'.$key.'%')
                  ->orWhere('gender','like','%'.$key.'%');
                })
                ->where('role','user')->paginate(3);

        return view('admin.user.list',compact('users'));
    }

    //ajax change role
    public function userChangeRole(Request $request){
        User::where('id',$request->userId)->update([
            'role'=> $request->status
        ]);
    }

    //user delete
    public function userDelete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#userList')->with(['deleteSuccess'=>'User account is deleted...']);
    }
}
