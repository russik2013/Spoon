<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index($page){

        $clients = Client::all();
        $count =ceil($clients -> count() / 50) ;
        $clients = Client::skip(50*($page-1))->take(50)->get();
        return view ('admin.clients.index', compact('clients', 'count'));

    }


    public function edit($id){

        $client = Client::find($id);

        if ($client)
            return view('admin.clients.edit', compact('client'));
        else
            return  redirect('/404');

    }


    public function update($id, Request $request){
        $rules = [
            "email" => 'required|email|min:2',
            "firstName"=> 'required|regex:/^[\pL\s\-]+$/u|min:2|max:40',
            "lastName"=> 'required|regex:/^[\pL\s\-]+$/u|min:2|max:40',
            "middleName"=> 'nullable|regex:/^[\pL\s\-]+$/u|min:2|max:40',
            "nickName"=> 'nullable|regex:/^[\pL\s\-]+$/u|min:2|max:40',
            "sex" => 'required|in:MEN,WOMEN,ELSE',
            "age" => 'required|between:-1,300',
            "photo" => 'image',
            "rating" => 'required|between:0,100',
            "firebaseID" => "required",
            "token" => "required",
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();// $validator->errors()->all();;
        }

        $client = Client::find($id);

        $client -> fill($request -> all());

        if (isset($request -> changePreferences))
            $client -> changePreferences = 1;
        else
            $client -> changePreferences = 0;

        if (isset($request -> reviewer))
            $client -> reviewer = 1;
        else
            $client -> reviewer = 0;

        $client -> save();

        return  redirect('/admin/clients/1');
    }


    public function changeStatus(Request $request){

        $client = Client::find($request -> id);

        if ($client -> access == 1)
            $client -> access = 0;
        else $client -> access = 1;

        $client -> save();

    }
    public function changeReviewer(Request $request){

        $client = Client::find($request -> id);

        if ($client -> reviewer == 1)
            $client -> reviewer = 0;
        else $client -> reviewer = 1;

        $client -> save();

    }


}
