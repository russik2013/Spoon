<?php

namespace App\Http\Controllers\Restaurant;

use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(){


        $restaurant = Auth::user();

        return view('restaurant.home', compact('restaurant'));

    }

    public function edit(){

        $restaurant = Auth::user();

        return view('restaurant.edit', compact('restaurant'));

    }

    public function update(Request $request){

        dd($request -> all());

        $restaurant = Auth::user();

        return view('restaurant.edit', compact('restaurant'));

    }
}
