<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() {



        return view('home');
    }
}
