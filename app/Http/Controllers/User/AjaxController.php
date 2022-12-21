<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizzalist
    public function pizzaList(Request $request){
        // logger($request->status);

        if($request->status == 'desc'){
        $data = Product::orderBy('created_at','desc')->get();
        }else{
        $data = Product::orderBy('created_at','asc')->get();
        }
        return response()->json($data,200);
    }

    //return addtoCart
    public function addToCart(Request $request){
        // logger($request->all());
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message' => 'Add To Cart Complete',
            'status' => 'success'
        ];
        return response()->json($response,200);

    }


    //order
    public function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
           $data = OrderList::create($item);

           $total += $data->total;
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+3000
        ]);

        // logger($total+3000);

        return response()->json([
            'status' => 'success',
            'message' => 'order Complete'
        ],200);
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clear current product
    public function clearCurrentProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
             ->where('product_id',$request->productId)
             ->where('id',$request->orderId)
             ->delete();
    }

    //increase view count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->productId)->first();
        $viewCount = [
            'view_count' => $pizza->view_count + 1,
        ];

        Product::where('id',$request->productId)->update($viewCount);
    }

    //get order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at ' => Carbon::now(),
            'updated_at ' => Carbon::now(),
        ];
    }
}
