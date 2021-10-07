<?php

namespace App\Http\Controllers;

use App\Models\Chefs;
use App\Models\Food;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function users(){

        $data = User::all();
        return view('admin.users',compact("data"));
    }


    public function deleteuser($id){

        $data = User::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function uploadfood(Request $request){

        $data = new Food();
        $image = $request->image;
        $imagename =time().'.'.$image->getClientOriginalExtension();
        $request->image->move('FoodImage',$imagename);
        $data->image = $imagename;
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->save();
        return redirect()->back();
        
    }

    public function FoodMenu(){
        $data = Food::all();
        return view('admin.FoodMenu',compact("data"));
    }

    public function deletemenu($id){
        $data = Food::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function updatemenu($id){
        $data = Food::find($id);
        return view('admin.updatemenu',compact("data"));
    }

    public function update(Request $request,$id){
        $data = Food::find($id);
        $image = $request->image;
        $imagename =time().'.'.$image->getClientOriginalExtension();
        $request->image->move('FoodImage',$imagename);
        $data->image = $imagename;
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->save();
        return redirect()->back();
        
    }

    public function reservations(Request $request){

        $data = new Reservation();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->guest = $request->guest;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->message = $request->message;
        $data->save();
        return redirect()->back();
    }

    public function viewreservation(){
        if(Auth::id()){
            
        $data = Reservation::all();
        return view('admin.adminreservation',compact("data"));
        }
        else{
            return redirect('login');
        }

    }

    public function viewchefs(){
        $data = Chefs::all();
        return view('admin.adminchefs',compact("data"));
    }

    public function uploadchefs(Request $request){

        $data = new Chefs();
        $image = $request->image;
        $imagename =time().'.'.$image->getClientOriginalExtension();
        $request->image->move('ChefsImage',$imagename);
        $data->image = $imagename;
        $data->name= $request->name;
        $data->speciality = $request->speciality;
        $data->save();
        return redirect()->back();
    }

    public function deletechef($id){
        $data = Chefs::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function updatechef($id){
        $data = Chefs::find($id);
        return view('admin.adminupdatechef',compact("data"));
    }

    public function updatechefdb(Request $request,$id){
        $data = Chefs::find($id);
        $image = $request->image;
        $imagename =time().'.'.$image->getClientOriginalExtension();
        $request->image->move('ChefsImage',$imagename);
        $data->image = $imagename;
        $data->name = $request->name;
        $data->speciality = $request->speciality;
        $data->save();
        return redirect()->back();
    }

    public function vieworders(){
        $data = Order::all();
        return view('admin.vieworders',compact('data'));
    }

    public function search(Request $request){
        $search = $request->search;
        $data = Order::where('name','like','%'.$search.'%')->orWhere('foodname','like','%'.$search.'%')
        ->get();
        return view('admin.vieworders',compact('data'));
    }


}
