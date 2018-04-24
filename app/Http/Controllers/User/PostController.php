<?php

namespace App\Http\Controllers\User;

use App\Model\user\post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function index(){

        $models = post::where('is_published', 1)->orderBy('created_at', 'DESC')->paginate(9);
        return view('user.post.index', compact('models'));
    }

    public function view(post $model){

        return view('user.post.view', compact('model'));
    }
}
