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
            "email" => 'required|email|valid_email',
            "password" => 'required|min:6|max:40',
            "firstName"=> 'required|alpha|min:2|max:40',
            "lastName"=> 'required|alpha|min:2|max:40',
            "firebaseID" => 'required'

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
            return json_encode(["status" => "internal error", "errors" => ["some problem"], "body" => null]);
        }
        DB::commit();

        return json_encode(["status" => "success", "errors" => [],"body" => $this -> getClient('id', $client -> id)]);

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

        if($request -> firebaseID) {

            $client = Client::where('firebaseID', '=', $request->firebaseID) -> first();

            if($client) {
                $client->firebaseID = '';

                $client->save();
            }
        }

        $client_id = 0;
        $users_1 = Client::where("email", "=", $request -> login) ->get();
        if(!$users_1->isEmpty())
        foreach ($users_1 as $user){

          //  dd($user -> password);
            if(Hash::check($request -> password,$user -> password)) {
                $user -> firebaseID = $request -> firebaseID;
                $user -> save();

                $client_id = $user -> id;
            }

        }
        $users_2 = Client::where("nickName", "=", $request -> login) ->get();
        if(!$users_2->isEmpty())
        foreach ($users_2 as $user){

            if(Hash::check($request -> password,$user -> password)) {

                $user -> firebaseID = $request -> firebaseID;
                $user -> save();

                $client_id = $user -> id;
            }

        }

        if($client_id != 0){

            return json_encode(["status" => "success", "errors" => [], "body" => $this -> getClient('id', $client_id)]);
        }

        if(!$users_1->isEmpty() || !$users_2->isEmpty())
            return json_encode(["status" => "field error", "errors" => ["Invalid password field"], "body" => null]);
        else
            return json_encode(["status" => "field error", "errors" => ["Invalid login field"], "body" => null]);

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
            return json_encode(["status" => "success", "errors" => [], "body" => $user_1 -> email]);
        }else{
            return json_encode(["status" => "field error", "errors" => ["Don't find user email"], "body" => null]);
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

            DB::table('client_password_resets') ->where('email', '=', $request -> email) -> delete();

            if( $this -> getClient('email', $user -> email))
                return json_encode(["status" => "success", "errors" => [], "body" =>  $this -> getClient('email', $user -> email)]);
            else
                return json_encode(["status" => "internal error", "errors" => "not find user", "body" => null]);
       }else
           return json_encode(["status" => "field error", "errors" => "wrong kod", "body" => null]);
    }

    public function editUser(Request $request){
        $rules = [
            "email" => 'email|min:2',
            "password" => 'min:6|max:40',
            "firstName"=> 'alpha_dash|min:2|max:40',
            "lastName"=> 'alpha_dash|min:2|max:40',
            "middleName"=> 'alpha_dash|min:2|max:40',
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
            $client = Client::find($request -> id);
            $client -> fill($request -> all());
            if($request -> password)
            $client -> password = bcrypt($request -> password);
            if( $request-> file) {
                $request->file->move('images', $request->file->getClientOriginalName() . $request->file->extension());
                $client->photo = 'images/' . $request->file->getClientOriginalName() . $request->file->extension();
            }
            //$client -> token =  str_random(32);
            $client -> save();
        }
        catch(QueryException $e){
            DB::rollBack();
            return json_encode(["status" => "internal error", "errors" => "some problem", "body" => null]);
        }
        DB::commit();

        return json_encode(["status" => "success", "errors" => [], "body" => $this -> getClient('id', $client -> id)]);
    }

    public function get(Request $request){
        $client = Client::find($request -> client_id);
        if($client)
            return json_encode(["status" => "success", "errors" => "", "body" => $client->get(['email','firstName','lastName','middleName',
                'nickName','sex','age','photo','reviewer','rating','changePreferences'])]);
        else return json_encode(["status" => "internal error", "errors" => "not find client", "body" => null]);
    }

    private function getClient($field, $value){

        $client = Client::where($field, '=',$value)->get(['id', 'token','email','firstName','lastName','middleName',
            'nickName','sex','age','photo','reviewer','rating','changePreferences']) -> first();

        $client -> pref = Preference::where('client_id', '=', $client -> id)->get(['AMERICAN','ASIAN',
            'BAR','BURGER','CAFE','CHINESE','DESSERT','ITALIAN','JAPANESE','MEXICAN','PIZZA','SEAFOOD',
            'STEAKHOUSE','SUSHI'])->first();

        return $client;

    }

}
