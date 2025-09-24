<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Movie;
use App\Models\FilmArea;
use Illuminate\Http\Request;

class TrabalhosController extends Controller
{
    public function __invoke(Request $request) {

        $query = Movie::query();

        if ($request->has('area_id') && !empty($request->area_id)) {
            $query->whereHas('filmAreas', function ($q) use ($request) {
                $q->where('film_area_id', $request->area_id);
            });
        }
        $query->orderBy('created_at', 'desc');

        $movies = $query->paginate(6);
        $filmAreas = FilmArea::all();
        $comics = Comic::orderBy('created_at', 'desc')->get();

        return view('trabalhos', compact('movies', 'comics', 'filmAreas'));
    }
}
