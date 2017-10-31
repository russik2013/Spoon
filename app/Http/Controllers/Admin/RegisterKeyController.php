<?php

namespace App\Http\Controllers\Admin;

use App\RegisterKey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterKeyController extends Controller
{
    public function index(){

        $keys = RegisterKey::orderBy('id')->get();

        return view('admin.keys.index', compact('keys'));

    }

    public function create(Request $request){
        $rules = [
            'restaurant_count' => 'required|min:1|max:999',
            'user_email' => 'required|email'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            return json_encode(['result' => "count error"]);
        }

        $keys = new RegisterKey();

        $keys -> key_text = str_random(200);

        $keys -> restaurant_count = $request -> restaurant_count;

        $keys -> save();

        $this->sendMail($keys -> id, $request -> user_email);

        return json_encode(['result' => "done"]);

    }

    public function getAllKeys(){

        return RegisterKey::orderBy('id')->get();

    }

    public function delete(Request $request){

        RegisterKey::find($request -> key_id) -> delete();

    }

    public function getKey(Request $request ){

        return RegisterKey::find($request->key_id);

    }

    protected function sendMail($key_id, $email){

        $key = RegisterKey::find($key_id);


        if($key) {

            Mail::send('admin.keys.key_info_mail', ["key" => $key], function ($message) use ($email) {
                $message->from('us@example.com', 'Spoon');
                $message->to($email, 'Drugak')->subject('Password reset');

            });
            return json_encode(['result' => 'done']);
        }else return json_encode(['result' => 'wrong email']);


    }


}
