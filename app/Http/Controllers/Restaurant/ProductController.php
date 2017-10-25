<?php

namespace App\Http\Controllers\Restaurant;

use App\Products;
use App\RestaurantPreference;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){

        $products = Products::where('restaurants_id', Auth::user()->id) -> get();

        return view('restaurant.products.index', compact('products'));

    }

    public function add(){

        return view('restaurant.products.add');

    }

    public function create(Request $request){

        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:40',
            'description' => 'required|min:2|max:512',
            'kitchen' => 'required|in:AMERICAN,ASIAN,BAR,BURGER,CAFE,CHINESE,DESSERT,ITALIAN,JAPANESE,MEXICAN,PIZZA,SEAFOOD,STEAKHOUSE,SUSHI,ELSE',
            'category' => 'required|in:BREAKFAST,DINNER,SUPPER,DRINKS,SWEET,ELSE',
            'prise' => 'required|numeric|min:1|max:99999',
            'weight' => 'required|numeric|min:0|max:999',
            'unit_of_measurement' => 'required|in:KILO,LITER,GRAMS,MILLILITER',
            'cooking_time' => 'required|numeric|min:0|max:999',
            'ingredients' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();// $validator->errors()->all();;
        }

        $this ->changePreferences(Auth::user()->id);

        dd($request -> all());


        $product = new Products();

        $product -> fill($request -> all());

        $product -> restaurants_id = Auth::user()->id;

        $product -> rating = 0;

        $product -> save();



    }

    private function changePreferences($id){

        dd(User::find($id) -> products() -> get());
           //->distinct()
        dd(User::find($id) -> preference() -> first());




    }

}
