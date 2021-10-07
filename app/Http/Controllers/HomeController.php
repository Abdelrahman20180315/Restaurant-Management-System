<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Chefs;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        if(Auth::id()){
            return redirect("redirects");
        }
        else{

        $data = Food::all();
        $data2 = Chefs::all();
        return view('home',compact("data","data2"));
        }
    }

    public function redirects(){

        $usertype = Auth::user()->usertype;
        $data = Food::all();
        $data2 = Chefs::all();
        if($usertype == '1'){
            return view('admin/adminhome');
        }
        else{
            $user_id = Auth::id();
            $count = Cart::where('user_id',$user_id)->count();
            return view('home',compact("data","data2","count"));
        }
    }

    public function addcart(Request $request,$id){
        if(Auth::id()){
            $cart = new Cart();
            $user_id = Auth::id();
            $food_id = $id;
            $cart->user_id = $user_id;
            $cart->food_id = $food_id;
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back();
        }
        else{
            return redirect('/login');
        }

    }

    public function showcart($id){
        if(Auth::id()==$id){
            $count = Cart::where('user_id',$id)->count();
            $data2 = Cart::select('*')->where('user_id',$id)->get();
            $data = Cart::where('user_id',$id)->join('food','carts.food_id','=','food.id')->get();
            return view('showcart',compact('count','data','data2'));
        }
        else{
            return redirect()->back();
        }
        
    }

    public function remove($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function makeorder(Request $request){
        foreach($request->title as $key =>$title){

        $order = new Order();
        $order->foodname = $title;
        $order->price = $request->price[$key];
        $order->quantity = $request->quantity[$key];
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->save();
        }
        return redirect()->back();
    }
}
