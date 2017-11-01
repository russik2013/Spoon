<?php

namespace App\Http\Controllers\Admin;

use App\Products;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function index(){

        $restaurants = Restaurant::where('role','user') -> get();

        return view('admin.restaurant.index', compact('restaurants'));

    }


    public function edit($id){

        $restaurant = Restaurant::find($id);

        return view('admin.restaurant.edit', compact('restaurant'));

    }

    public function update($id, Request $request){
        $rules = [
            'password' => 'min:2|max:40',
            'name' => 'alpha_dash|min:2|max:40',
            'nets' => 'nullable|alpha_dash|min:2|max:40',
            'category' => 'alpha_dash|min:2|max:40',
            'description' => 'min:2|max:512',
            'phone' => 'numeric',
            'average_check' => 'numeric|min:1|max:99999',
            'photos' => 'image',
            "monday_from" => "required_if:specify_time,==,on",
            "monday_to" => "required_if:specify_time,==,on",
            "tuesday_from" => "required_if:specify_time,==,on",
            "tuesday_to" => "required_if:specify_time,==,on",
            "wednesday_from" => "required_if:specify_time,==,on",
            "wednesday_to" => "required_if:specify_time,==,on",
            "thursday_from" => "required_if:specify_time,==,on",
            "thursday_to" => "required_if:specify_time,==,on",
            "friday_from" => "required_if:specify_time,==,on",
            "friday_to" => "required_if:specify_time,==,on",
            "saturday_from" => "required_if:specify_time,==,on",
            "saturday_to" => "required_if:specify_time,==,on",
            "sunday_from" => "required_if:specify_time,==,on",
            "sunday_to" => "required_if:specify_time,==,on",

        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();// $validator->errors()->all();;
        }

        $restaurant = Restaurant::find($id);

        $restaurant ->fill($request -> all());

        $restaurant -> save();

        return redirect('/admin/restaurant');

    }

    public function menu($id){

        $products = Restaurant::find($id) -> products;

        return view('admin.restaurant.menu', compact('products'));
    }

    public function product($id){

        $product = Products::find($id);

        $kitchens = DB::table('kitchen_types')->get();

        return view('admin.restaurant.product', compact('product', 'kitchens'));

    }

    public function updateProduct($id, Request $request){
        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:40',
            'description' => 'required|min:2|max:512',
            'ingredients' => 'required',
            'image' => 'image'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();// $validator->errors()->all();;
        }

        $product = Products::find($id);

        $product -> fill($request -> all());

        $product -> save();


        return redirect('/admin/restaurant/'.$product->restaurants_id.'/menu');

    }

}
