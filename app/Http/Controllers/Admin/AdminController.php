<?php

namespace App\Http\Controllers\Admin;

use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index(){

        return view('admin.login');

    }

    public function auth(Request $request){

        //dd($request ->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(array('login_error' => 'Не верные данные'));
    }

    public function register(){

        return view('admin.register');

    }

    public function createRestaurant(Request $request){

        //dd($request -> all());
        $rules = [
            'email' =>'email|required|valid_restaurant_email',
            'password' => 'min:2|max:40',
            'name' => 'alpha_dash|min:2|max:40',
            'nets' => 'alpha_dash|min:2|max:40',
            'category' => 'alpha_dash|min:2|max:40',
            'description' => 'min:2|max:512',
            'phone' => 'numeric',
            'average_check' => 'numeric|min:1|max:99999',
            'photos' => 'image'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();// $validator->errors()->all();;
        }
        $restaurant = new Restaurant();

        $restaurant -> fill($request -> all());
        if($request -> monday)
            $restaurant -> specify_time = true;
        else
            $restaurant -> specify_time = false;
        $restaurant -> location = 'russik';

        $restaurant -> password = bcrypt($request -> password);

        $restaurant -> save();

        return redirect()->route('login');

    }

    public function reset(){

        return view('admin.password_reset');

    }

    public function sendMail(Request $request){

        $restaurant = Restaurant::where('email', '=', $request->email)->first();


        if($restaurant) {

            $kod =  str_random(32);
            $restaurant_password_reset = DB::table('restaurant_password_reset') ->insert(['email' => $request -> email,
                                                                                          'kod' => $kod,
                                                                                          'restaurants_id' => $restaurant -> id]);
            Mail::send('admin.password_reset_mail', ["user" => $restaurant, "kod" => $kod], function ($message) use ($request) {
                $message->from('us@example.com', 'Spoon');
                $message->to($request->email, 'Drugak')->subject('Password reset');
                // $message->to('z.kon2009@gmail.com','Drugak')->subject('Welcome to Odessa');

            });
            return json_encode(['result' => 'done']);
        }else return json_encode(['result' => 'wrong email']);


    }

    public function changePassword(){

        return view('admin.change_password');

    }

    public function setNewPassword(Request $request){

        dd($request -> all());

    }
}
