<?php

namespace App\Http\Controllers\Admin;

use App\RegisterKey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterKeyController extends Controller
{
    //

    public function index(){

        $keys = RegisterKey::all();

        return view('admin.keys.index', compact('keys'));

    }

    public function create(Request $request){
        $rules = [
            'restaurant_count' => 'required|min:1|max:999'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            return json_encode(['result' => "count error"]);
        }

        $keys = new RegisterKey();

        $keys -> key_text = str_random(200);

        $keys -> restaurant_count = $request -> restaurant_count;

        $keys -> save();

        return json_encode(['result' => "done"]);

    }
}
