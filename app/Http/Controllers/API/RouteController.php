<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $product = Product::get();
        // $category = Category::get();

        $data = [
            'product' => $product,
            // 'category' => $category
        ];
        // return $data['product'][0]->name;
        return response()->json($data, 200);
    }

    //get all category list
    public function categoryList(){
        $category = Category::get();
        return response()->json($category, 200);
    }

    //post category create
    public function createCategroy(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $response = Category::create($data);
        return $response;
    }

    //post create contact
    public function createContact(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Contact::create($data);
        $contact = Contact::orderBy('id','desc')->get();
        return $contact;
    }

    //post delete category
    public function deleteCategory($id){

        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status' => 'true','message'=>'delete success','deleteData'=>$data], 200);

        }
        return response()->json(['status' => 'false','message' => 'there is no data'], 200);

        // return isset($data);
        // Category::where('id',$request->category_id)->delete();
        // return response()->json(['message'=>'delete success'], 200);
    }

    //edit category
    public function categoryDetails($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            // Category::where('id',$id)->delete();
            return response()->json(['status' => 'true','detail'=>$data], 200);

        }
        return response()->json(['status' => 'false','message' => 'there is no category'], 500);
    }

    //update Category
    public function updateCategory(Request $request){
        // return $request->all();
        $dbSource = Category::where('id',$request->category_id)->first();

        if(isset($dbSource)){
            $data = $this->getCategoryUpdateData($request);
            Category::where('id',$request->category_id)->update($data);
            $updateData = Category::where('id',$request->category_id)->first();
            return response()->json(['status' => 'true','category'=>$updateData,'message'=>'category update success'], 200);
        }
        return response()->json(['status' => 'false','message' => 'there is no category for update'], 500);
    }

    private function getCategoryUpdateData($request){
        return [
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ];
    }

}
