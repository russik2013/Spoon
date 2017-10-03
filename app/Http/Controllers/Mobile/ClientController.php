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
//    use AuthenticatesUsers;
 //   protected $redirectTo = '/admin';
   // protected $redirectAfterLogout = '/admin';

    public function register(Request $request){
        $rules = [
            "email" => 'email|min:2|max:6|valid_email',
            "password" => 'min:6|max:40',
            "firstName"=> 'alpha|min:2|max:40',
            "lastName"=> 'alpha|min:2|max:40',
            "middleName"=> 'alpha|min:2|max:40',
            "nickName"=> 'alpha_dash|min:2|max:40|valid_nickname',
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
            if( $request-> file) {
                $request->file->move('images', $request->file->getClientOriginalName() . $request->file->extension());
                $client->photo = 'images/' . $request->file->getClientOriginalName() . $request->file->extension();
            }
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
        $user_1 = Client::where("nickName", "=", $request -> login) ->
                            orWhere("email", "=", $request -> login) ->
                                first();
        if($user_1){
            $key =   rand(100000, 999999) ;
            if($key < 0)
                $key = $key * (-1);

            DB::table('client_password_resets')->insert(
                ['email' => $user_1 -> email, 'kod' => $key]
            );
            $this -> sendMail($user_1 -> email, $key);
            return json_encode(["status" => "success", "errors" => "", "body" => $user_1 -> email]);
        }else{
            return json_encode(["status" => "field error", "errors" => "Don't find user email", "body" => null]);
        }
    }


    protected function sendMail($mail, $kod){
        Mail::send('mailers', ["user" => $kod], function ($message) use ($mail){
            $message->from('us@example.com', 'Spoon');
            $message->to($mail,'Drugak')->subject('Password reset');
        });
    }

    public function checkKod(Request $request){
       $user = DB::table('client_password_resets')->where('kod', '=', $request -> kod) ->where('email', '=', $request -> email) -> get() -> first();
       if($user) {
            $client = Client::where('email', '=',$user -> email) ->first();
            if($client)
                return json_encode(["status" => "success", "errors" => "", "body" => $client]);
            else
                return json_encode(["status" => "internal error", "errors" => "not find user", "body" => null]);
       }else
           return json_encode(["status" => "field error", "errors" => "wrong kod", "body" => null]);
    }

    public function editUser(Request $request){
        $rules = [
            "email" => 'email|min:2|max:6|valid_email',
            "password" => 'min:6|max:40',
            "firstName"=> 'alpha|min:2|max:40',
            "lastName"=> 'alpha|min:2|max:40',
            "middleName"=> 'alpha|min:2|max:40',
            "nickName"=> 'alpha_dash|min:2|max:40|valid_nickname',
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
            $client = Client::find($request -> all());
            $client -> fill($request -> all());
            $client -> password = bcrypt($request -> password);
            if( $request-> file) {
                $request->file->move('images', $request->file->getClientOriginalName() . $request->file->extension());
                $client->photo = 'images/' . $request->file->getClientOriginalName() . $request->file->extension();
            }
            $client -> token =  str_random(32);
            $client -> save();
        }
        catch(QueryException $e){
            DB::rollBack();
            return json_encode(["status" => "internal error", "errors" => "some problem", "body" => null]);
        }
        DB::commit();
        return json_encode(["status" => "success", "errors" => "", "body" => $client]);
    }


}
