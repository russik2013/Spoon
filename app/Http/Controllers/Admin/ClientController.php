<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::all();

        return view ('admin.clients.index', compact('clients'));

    }
}
