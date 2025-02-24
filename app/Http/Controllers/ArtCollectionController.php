<?php

namespace App\Http\Controllers;

use App\Models\ArtCollection;
use Illuminate\Http\Request;

class ArtCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection = ArtCollection::all();

        return view('collection.index', 'collection');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ArtCollection $artCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArtCollection $artCollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArtCollection $artCollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArtCollection $artCollection)
    {
        //
    }


}
