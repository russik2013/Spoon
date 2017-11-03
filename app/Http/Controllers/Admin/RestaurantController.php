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

        $monday = explode('-', $restaurant -> monday);
        $tuesday = explode('-', $restaurant -> tuesday);
        $wednesday = explode('-', $restaurant -> wednesday);
        $thursday = explode('-', $restaurant -> thursday);
        $friday = explode('-', $restaurant -> friday);
        $saturday = explode('-', $restaurant -> saturday);
        $sunday = explode('-', $restaurant -> sunday);

        $restaurant -> monday_from = $monday[0];
        $restaurant -> monday_to = $monday[1];

        $restaurant ->tuesday_from = $tuesday[0];
        $restaurant ->tuesday_to = $tuesday[1];

        $restaurant ->wednesday_from = $wednesday[0];
        $restaurant ->wednesday_to = $wednesday[1];

        $restaurant ->thursday_from = $thursday[0];
        $restaurant ->thursday_to = $thursday[1];

        $restaurant ->friday_from = $friday[0];
        $restaurant ->friday_to = $friday[1];

        $restaurant ->saturday_from = $saturday[0];
        $restaurant ->saturday_to = $saturday[1];

        $restaurant ->sunday_from = $sunday[0];
        $restaurant ->sunday_to = $sunday[1];



        return view('admin.restaurant.edit', compact('restaurant'));

    }

    public function update($id, Request $request){
        //dd($request -> all());
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

        $restaurant -> monday = $request -> monday_from . '-'. $request -> monday_to;
        $restaurant -> tuesday = $request -> tuesday_from . '-'. $request -> tuesday_to;
        $restaurant -> wednesday = $request -> wednesday_from . '-'. $request -> wednesday_to;
        $restaurant -> thursday = $request -> thursday_from . '-'. $request -> thursday_to;
        $restaurant -> friday = $request -> friday_from . '-'. $request -> friday_to;
        $restaurant -> saturday = $request -> saturday_from . '-'. $request -> saturday_to;
        $restaurant -> sunday = $request -> sunday_from . '-'. $request -> sunday_to;

        if(isset($request-> specify_time))
            $restaurant -> specify_time = 1;
        else $restaurant -> specify_time = 0;

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
