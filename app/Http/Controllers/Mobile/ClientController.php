<?php

namespace App\Http\Controllers\Mobile;

use App\Client;
use App\Preference;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function register(Request $request){

        DB::beginTransaction();
        try{
            $client = new Client();

            $client -> fill($request -> all());

            $client -> save();


            $preferences = new Preference();

            $preferences -> client_id = 'russik';

            $preferences -> save();
        }
        catch(QueryException $e){
            DB::rollBack();
        }
        DB::commit();

        dd($request -> all());

    }
}
