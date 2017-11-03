<?php

namespace App\Http\Controllers\Admin;

use App\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index($id){

        $comments = Comments::where('restaurants_id', '=', $id) -> get();
       // Comments::with('comm');

        return view('admin.restaurant.comments', compact('comments'));
    }
}
