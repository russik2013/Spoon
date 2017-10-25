<?php

namespace App\Http\Controllers\Mobile;

use App\Client;
use App\Preference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PreferenceController extends Controller
{
    public function get(Request $request){
        if(Client::find($request -> client_id))
         if(Client::find($request -> client_id)->preference)
            return json_encode(["status" => "success", "errors" => [], "body" => Client::find($request -> client_id)->preference]);
        else return json_encode(["status" => "internal error", "errors" => ["not find preference"], "body" => null]);
        else return json_encode(["status" => "internal error", "errors" => ["not find user"], "body" => null]);
    }

    public function edit(Request $request){
        $rules = [
            'AMERICAN' => 'numeric|between:0,100',
            'ASIAN' => 'numeric|between:0,100',
            'BAR' => 'numeric|between:0,100',
            'BURGER' => 'numeric|between:0,100',
            'CAFE' => 'numeric|between:0,100',
            'CHINESE' => 'numeric|between:0,100',
            'DESSERT' => 'numeric|between:0,100',
            'ITALIAN' => 'numeric|between:0,100',
            'JAPANESE' => 'numeric|between:0,100',
            'MEXICAN' => 'numeric|between:0,100',
            'PIZZA' => 'numeric|between:0,100',
            'SEAFOOD' => 'numeric|between:0,100',
            'STEAKHOUSE' => 'numeric|between:0,100',
            'SUSHI' => 'numeric|between:0,100',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return json_encode(["status" => "field error", "errors" => $validator -> messages() -> all(), "body" => null]);
        }
       // dd(Client::with('preference')->get());
        if(Client::find($request -> client_id))
            if(Client::find($request -> client_id)->preference){
                    $preference = Client::find($request -> client_id)->preference;
                    $preference -> fill($request -> all());
                    $preference -> save();
                return json_encode(["status" => "success", "errors" => [], "body" => $preference]);
            }
            else return json_encode(["status" => "internal error", "errors" => ["not find preference"], "body" => null]);
        else return json_encode(["status" => "internal error", "errors" => ["not find user"], "body" => null]);
    }

}
