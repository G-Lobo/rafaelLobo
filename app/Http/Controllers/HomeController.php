<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() {

        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        $movies = Movie::orderBy('created_at', 'desc')->get();


        return view('home', compact('posts', 'movies'));
    }
}
