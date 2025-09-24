<?php

namespace App\Http\Controllers;

use App\Models\FilmArea;
use Illuminate\Http\Request;

class FilmAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filmAreas = FilmArea::all();
        return view('filmArea.index', compact('filmAreas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filmArea.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $area = new FilmArea();

        $area->area = $request->area;

        $area->save();

        return redirect()->route('area.index')->with('success');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FilmArea $filmArea)
    {
        FilmArea::findOrFail($filmArea->id)->delete();

        return redirect()->route('area.index')->with('success', 'Postagem deletada');
    }
}
