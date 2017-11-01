<?php

namespace App\Http\Controllers\Restaurant;

use App\Preference;
use App\Products;
use App\RestaurantPreference;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'image' => 'image'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();// $validator->errors()->all();;
        }

        $product = new Products();

        $product -> fill($request -> all());

        $product -> restaurants_id = Auth::user()->id;

        $product -> rating = 0;

        $product -> save();

        $newPreferences =  $this ->getNewPreferences(Auth::user()->id);

        $this ->changePreferences(Auth::user()->id, $newPreferences);

        return redirect('/restaurant/products');

    }

    private function getNewPreferences($id){

        $alls = User::find($id) -> products()  -> get() -> groupBy('kitchen');

        foreach ($alls as $key => $value){

            $dataAboutCounts[$key] = $value -> count();

        }

        return $dataAboutCounts;


        // $mostPriorityKitchen = max($dataAboutCounts);
    }

    private function changePreferences($id, $preferences){

        $alls = User::find($id)  -> preference() -> first();

        $alls -> getDefaults($alls -> id);

        $mostPriorityKitchen = max($preferences);

        foreach ($preferences as $key => $preference){
            $preferences[$key] = ($preference / $mostPriorityKitchen) * 100;
        }

        $alls -> fill($preferences);

        $alls -> save();

    }

    public function edit($id){

        $product = Products::find($id);

        $kitchens = DB::table('kitchen_types')->get();

        if ($product -> restaurants_id != Auth::user() -> id)
            return redirect('/restaurant/products');


        return view('restaurant.products.edit', compact('product', 'kitchens'));

    }

    public function update($id, Request $request){

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
            'image' => 'image'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();// $validator->errors()->all();;
        }

        $product = Products::find($id);

        if ($product -> restaurants_id != Auth::user() -> id)
            return json_encode(['status' => 'error', 'message' => "you can't edit this product"]);

        $product -> fill($request -> all());

        $product -> save();

        $newPreferences =  $this ->getNewPreferences(Auth::user()->id);

        $this ->changePreferences(Auth::user()->id, $newPreferences);

        return redirect('/restaurant/products');


    }

    public function delete($id){

        Products::find($id) -> delete();

        $newPreferences =  $this ->getNewPreferences(Auth::user()->id);

        $this ->changePreferences(Auth::user()->id, $newPreferences);

        return redirect('/restaurant/products');

    }


}
