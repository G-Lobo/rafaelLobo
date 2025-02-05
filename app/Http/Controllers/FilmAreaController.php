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
        $area = new FilmArea();

        $area->area = $request->area;

        $area->save();
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
        //
    }
}
