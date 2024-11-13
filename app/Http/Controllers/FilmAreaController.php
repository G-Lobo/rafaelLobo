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
        //
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
        $filmArea = new FilmArea();

        $request->validate([
            'area' => ['required'],
        ]);

        $filmArea->area = $request->area;

        $filmArea->save();

        return redirect()->back()->with('success', 'Categoria criada');
    }

    /**
     * Display the specified resource.
     */
    public function show(FilmArea $filmArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FilmArea $filmArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FilmArea $filmArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FilmArea $filmArea)
    {
        FilmArea::findOrFail($filmArea->id)->delete();
    
        return redirect()->back()->with('success', 'categoria deletada');
    }
}
