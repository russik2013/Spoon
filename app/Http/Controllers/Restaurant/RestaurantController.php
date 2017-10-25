<?php

namespace App\Http\Controllers\Restaurant;

use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function index(){


        $restaurant = Auth::user();

        return view('restaurant.home', compact('restaurant'));

    }

    public function edit(){

        $restaurant = Auth::user();


        $monday = explode('-', Auth::user() -> monday);
        $tuesday = explode('-', Auth::user() -> tuesday);
        $wednesday = explode('-', Auth::user() -> wednesday);
        $thursday = explode('-', Auth::user() -> thursday);
        $friday = explode('-', Auth::user() -> friday);
        $saturday = explode('-', Auth::user() -> saturday);
        $sunday = explode('-', Auth::user() -> sunday);

        Auth::user() -> monday_from = $monday[0];
        Auth::user() -> monday_to = $monday[1];

        Auth::user() ->tuesday_from = $tuesday[0];
        Auth::user() ->tuesday_to = $tuesday[1];

        Auth::user() ->wednesday_from = $wednesday[0];
        Auth::user() ->wednesday_to = $wednesday[1];

        Auth::user() ->thursday_from = $thursday[0];
        Auth::user() ->thursday_to = $thursday[1];

        Auth::user() ->friday_from = $friday[0];
        Auth::user() ->friday_to = $friday[1];

        Auth::user() ->saturday_from = $saturday[0];
        Auth::user() ->saturday_to = $saturday[1];

        Auth::user() ->sunday_from = $sunday[0];
        Auth::user() ->sunday_to = $sunday[1];



        return view('restaurant.edit', compact('restaurant'));

    }

    public function update(Request $request){

        $rules = [
            'password' => 'min:2|max:40',
            'name' => 'alpha_dash|min:2|max:40',
            'nets' => 'alpha_dash|min:2|max:40',
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



        $restaurant = Auth::user();

        $restaurant ->fill($request -> all());

        $restaurant -> save();

        return view('restaurant.edit', compact('restaurant'));

    }
}
