<?php

namespace App\Http\Controllers\Mobile;

use App\Client;
use App\Preference;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class ClientController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin';
    protected $redirectAfterLogout = '/admin';

    public function register(Request $request){
        //        DB::transaction(function() use ($request)
//        {
//            $client = new Client();
//            $client -> fill($request -> all());
//            $client -> save();
//            $preferences = new Preference();
//            $preferences -> client_id = $client->id;
//            $preferences -> save();
//        });

        $rules = [
            "email" => 'email|min:2|max:6',
            "password" => 'min:6|max:40',
            "firstName"=> 'alpha|min:2|max:40',
            "lastName"=> 'alpha|min:2|max:40',
            "middleName"=> 'alpha|min:2|max:40',
            "nickName"=> 'alpha_dash|min:2|max:40',
            "sex" => 'in:MEN,WOMEN,ELSE',
            "age" => 'between:3,300',
            "photo" => 'image',
            "rating" => 'between:0,100'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {

            return json_encode(["status" => "field error", "errors" => $validator -> messages() -> all(), "body" => null]);

        }

        DB::beginTransaction();
        try{
            $client = new Client();
            $client -> fill($request -> all());
            $client -> password = bcrypt($request -> password);
            $client -> token =  str_random(32);
            $client -> save();
            $preferences = new Preference();
            $preferences -> client_id = $client -> id;
            $preferences -> save();
        }
        catch(QueryException $e){
            DB::rollBack();
            return json_encode(["status" => "internal error", "errors" => "some problem", "body" => null]);
        }
        DB::commit();
        return json_encode(["status" => "success", "errors" => "", "body" => $client]);

    }

    public function authorization(Request $request){
        $rules = [
            'login' => 'required',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            return json_encode(["status" => "field error", "errors" => $validator -> messages() -> all(), "body" => null]);

        }
        $users_1 = Client::where("email", "=", $request -> login) ->get();
        if(!$users_1->isEmpty())
        foreach ($users_1 as $user){

          //  dd($user -> password);
            if(Hash::check($request -> password,$user -> password))
                return json_encode(["status" => "success", "errors" => "", "body" => $user]);

        }
        $users_2 = Client::where("nickName", "=", $request -> login) ->get();
        if(!$users_2->isEmpty())
        foreach ($users_2 as $user){

            if(Hash::check($request -> password,$user -> password))
                return json_encode(["status" => "success", "errors" => "", "body" => $user]);

        }
        if(!$users_1->isEmpty() || !$users_2->isEmpty())
            return json_encode(["status" => "field error", "errors" => "Invalid password field", "body" => null]);
        else
            return json_encode(["status" => "field error", "errors" => "Invalid login field", "body" => null]);

    }

    public function resetPassword(Request $request){

        $rules = [
            'login' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            return json_encode(["status" => "field error", "errors" => $validator -> messages() -> all(), "body" => null]);

        }

        $this -> sendMail(1);

    }


    public function sendMail($user){


        Mail::send('mailers', ["user" => $user], function ($message){


            $message->from('us@example.com', 'Laravel');
            $message->to('z.kon2009@gmail.com','Drugak')->subject('Welcome to Odessa');
            // $message->to('z.kon2009@gmail.com','Drugak')->subject('Welcome to Odessa');
        });

    }
}
