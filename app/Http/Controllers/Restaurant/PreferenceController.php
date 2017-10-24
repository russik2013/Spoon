<?php

namespace App\Http\Controllers\Restaurant;

use App\RestaurantPreference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    public function index(){

        $restaurant_preference = RestaurantPreference::where('restaurants_id', '=', Auth::user()->id)->first();

        return view('restaurant.preference',compact('restaurant_preference'));

    }

    public function edit(){

        $restaurant_preference = RestaurantPreference::where('restaurants_id', '=', Auth::user()->id)->first();

        return view('restaurant.preference_edit',compact('restaurant_preference'));

    }

    public function update(Request $request){

        dd($request -> all());

    }
}
