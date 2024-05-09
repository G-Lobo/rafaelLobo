<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Movie;
use Illuminate\Http\Request;

class ADMPannelController extends Controller
{

    public function __invoke() {

        $posts = BlogPost::orderBy('created_at', 'desc')->paginate(5);
        $movies = Movie::orderBy('created_at', 'desc')->paginate(5);






        return view('ADMPannel', compact('posts', 'movies'));
    }
}
