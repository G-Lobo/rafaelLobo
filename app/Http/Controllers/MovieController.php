<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();

        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $movie = new Movie();

        $movie->title = $request->title;
        $movie->releaseDate = $request->releaseDate;
        $movie->content = $request->content;
        $movie->coverArt = $request->coverArt;
        $movie->duration = $request->duration;
        // $movie->videoLink = $request->videoLink;

        //upload coverArt image
        if ($request->hasFile('coverArt') && $request->file('coverArt')->isValid()) {

            $requestImage = $request->coverArt;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/coverArts'), $imageName);

            $movie->coverArt = $imageName;
        }

        //upload Prizes images

        //link manipulation
        if ($request->has('videoLink') && !empty($request->input('videoLink'))) {
            $linkToManipulate = $request->videoLink;
            $embedLink = $this->videoEmbeder($linkToManipulate);
            $movie->videoLink = $embedLink;
        }

        //save
        $movie->save();

        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        $post = Movie::findOrFail($movie->id);

        return view('movies.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $post = Movie::findOrFail($movie->id);

        return view('movies.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $data = $request->all();

        //update de coverArt
        if ($request->hasFile('coverArt') && $request->file('coverArt')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/coverArts'));
            $data['coverArt'] = $imageName;
        }

        //update de link youtube
        if($request->has('videoLink') && !empty($request->input('videoLink'))){
            $toBeEmbed = $request->videoLink;
            $embedLink = $this->videoEmbeder($toBeEmbed);
            $data['videoLink'] = $embedLink;
        }

        Movie::findOrFail($movie->id)->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        Movie::findOrFail($movie->id)->delete();

        return redirect()->route('movies.index');
    }

    public function videoEmbeder(string $link)
    {
        $pos_vimeo = strpos($link, "vimeo");
        $pos_youtube = strpos($link, "youtube");

        switch (true) {
            case $pos_vimeo !== false:
                $embedLink = str_replace("vimeo.com", "player.vimeo.com/video", $link);
                return $embedLink;
                break;
            case $pos_youtube !== false:
                $embedLink = str_replace("watch?v=", "embed/", $link);
                return $embedLink;
                break;
            default:
                echo "Opa :(";
        }
    }
}
