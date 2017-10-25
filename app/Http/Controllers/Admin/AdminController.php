<?php

namespace App\Http\Controllers\Admin;

use App\Restaurant;
use App\RestaurantPreference;
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
            return redirect()->intended('restaurant');
        }

        return back()->withErrors(array('login_error' => 'Не верные данные'));
    }

    public function register(){

        return view('admin.register');

    }

    public function createRestaurant(Request $request){


        $rules = [
            'email' =>'required|email|required|valid_restaurant_email',
            'password' => 'required|min:2|max:40',
            'name' => 'required|alpha_dash|min:2|max:40',
            'nets' => 'required|alpha_dash|min:2|max:40',
            'category' => 'required|alpha_dash|min:2|max:40',
            'description' => 'required|min:2|max:512',
            'phone' => 'required|numeric',
            'average_check' => 'required|numeric|min:1|max:99999',
            'photos' => 'required|image',
            "monday_from" => "required_if:specify_time,==,on",
            "monday_to" => "required_if:specify_time,==,on",
            "tuesday_from" => "required_if:specify_time,==,on",
            "tuesday_to" => "required_if:specify_time,==,on",
            "wednesday_from" => "required_if:specify_time,==,on",
            "wednesday_to" => "required_if:specify_time,==,on",
            "thursday_from" => "required_if:specify_time,==,on",
            "thursday_to" => "required_if:specify_time,==,on",
            "friday_from" => "required_if:specify_time,==,on",
            "friday_to" => "required_if:specify_time,==,on",
            "saturday_from" => "required_if:specify_time,==,on",
            "saturday_to" => "required_if:specify_time,==,on",
            "sunday_from" => "required_if:specify_time,==,on",
            "sunday_to" => "required_if:specify_time,==,on",

        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();// $validator->errors()->all();;
        }

        DB::beginTransaction();
        try{
            $restaurant = new Restaurant();

            $restaurant -> fill($request -> all());
            if($request -> monday_to) {
                $restaurant->specify_time = true;
                $restaurant->monday = $request -> monday_from.'-'.$request -> monday_to;
                $restaurant->tuesday = $request -> tuesday_from.'-'.$request -> tuesday_to;
                $restaurant->wednesday = $request -> wednesday_from.'-'.$request -> wednesday_to;
                $restaurant->thursday = $request -> thursday_from.'-'.$request -> thursday_to;
                $restaurant->friday = $request -> friday_from.'-'.$request -> friday_to;
                $restaurant->saturday = $request -> saturday_from.'-'.$request -> saturday_to;
                $restaurant->sunday = $request -> sunday_from.'-'.$request -> sunday_to;
            }
            else
                $restaurant -> specify_time = false;

            $restaurant -> location = 'russik';

            $restaurant -> password = bcrypt($request -> password);

            $restaurant -> save();

            $restaurant_preference = new RestaurantPreference();

            $restaurant_preference -> restaurants_id = $restaurant -> id;

            $restaurant_preference -> save();
        }
        catch(QueryException $e){
            DB::rollBack();
            return json_encode(["status" => "internal error", "errors" => "some problem", "body" => null]);
        }
        DB::commit();


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

        $changePassword= DB::table('restaurant_password_reset') -> where(['email' => $request -> email]) -> first();

        if($changePassword){

            $newPassword = DB::table('restaurant_password_reset') -> where(['email' => $request -> email])
                -> where(['kod' => $request -> kod]) -> first();

            if($newPassword){

                $restaurant = Restaurant::find($newPassword -> restaurants_id);

                $restaurant -> password = bcrypt($request -> password);

                $restaurant -> save();

                DB::table('restaurant_password_reset') -> where(['email' => $request -> email]) -> delete();

                return json_encode(['result' => 'done']);

            }else
                return json_encode(['result' => 'kod error']);
            ///dd($newPassword);

        }else
            return json_encode(['result' => 'email error']);
    }
}
