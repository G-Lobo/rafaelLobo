<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Prize;
use App\Models\FilmType; // Import FilmType model
use App\Models\FilmArea; // Import FilmArea model
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
        $filmTypes = FilmType::all(); // Fetch film types
        $filmAreas = FilmArea::all();
        return view('movies.create', compact('filmTypes', 'filmAreas'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'releaseDate' => ['required'],
            'content' => ['required'],
            'coverArt' => ['required'],
            'duration'  => ['required'],
            'link' => ['nullable','url','regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|vimeo\.com)\/.+$/'],

        ]);

        $movie = new Movie();
        $movie->title = $request->title;
        $movie->releaseDate = $request->releaseDate;
        $movie->content = $request->content;
        $movie->coverArt = $request->coverArt;
        $movie->duration = $request->duration;
        $movie->link = $request->link;
        $movie->typeId = $request->typeId; // Assign typeId


        //upload coverArt image
        if ($request->hasFile('coverArt') && $request->file('coverArt')->isValid()) {
            $requestImage = $request->coverArt;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/coverArts'), $imageName);
            $movie->coverArt = $imageName;
        }

        //link manipulation
        if ($request->has('link') && !empty($request->input('link'))) {
            $linkToManipulate = $request->link;
            $embedLink = $this->videoEmbeder($linkToManipulate);
            $movie->videoLink = $embedLink;
        }

        //save
        $movie->save();

        if ($request->has('film_areas')) {
            $movie->filmAreas()->sync($request->input('film_areas'));
        }

        //upload Prizes images
        if ($request->hasFile('prizes')) {
            for ($i = 0; $i < count($request->allFiles()['prizes']); $i++) {
                $file = $request->allFiles()['prizes'][$i];
                $extension = $file->extension();
                $imageName = md5($file->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $prize = new Prize();
                $prize->movie_id = $movie->id;
                $file->move(public_path('assets/img/prizes'), $imageName);
                $prize->image = $imageName;
                $prize->save();
            }
        }

        return redirect()->route('movies.index')->with('success', 'Postagem criada');
    }

    // Other methods remain unchanged...

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        $post = Movie::findOrFail($movie->id);
        $type = FilmType::findOrFail($movie->typeId);

        return view('movies.show', compact('post', 'type'));
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

        $request->validate([
            'title' => ['required'],
            'releaseDate' => ['required'],
            'content' => ['required'],
            'coverArt' => ['required'],
            'duration'  => ['required'],
            'link' => ['nullable','url','regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|vimeo\.com)\/.+$/'],
        ]);

        //update de coverArt
        if ($request->hasFile('coverArt') && $request->file('coverArt')->isValid()) {
            $requestImage = $request->coverArt;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/coverArts'), $imageName);
            $data['coverArt'] = $imageName;
        }

        //update de video
        if ($request->has('link') && !empty($request->input('link'))) {
            $toBeEmbed = $request->link;
            $embedLink = $this->videoEmbeder($toBeEmbed);
            $data['videoLink'] = $embedLink;
        }

        //update dos premios

        if ($request->hasFile('prizes')) {
            $prizeImages = $request->allFiles()['prizes'];
            $oldPrizeImages = $movie->prizes->pluck('image')->all();

            foreach ($prizeImages as $i => $file) {
                $extension = $file->extension();
                $imageName = md5($file->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $file->move(public_path('assets/img/prizes'), $imageName);

                // Update or create a new Prize model
                $prize = Prize::firstOrNew(['movie_id' => $movie->id, 'image' => $imageName]);
                $prize->image = $imageName;
                $prize->save();

                // Remove old images that are no longer used
                if (!in_array($imageName, $oldPrizeImages)) {
                    foreach ($oldPrizeImages as $oldImage) {
                        if (file_exists(public_path('assets/img/prizes/' . $oldImage))) {
                            unlink(public_path('assets/img/prizes/' . $oldImage));
                        }
                    }
                }
            }
        }

        Movie::findOrFail($movie->id)->update($data);

        return redirect()->route('movies.index')->with('success', 'Postagem alterada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        Movie::findOrFail($movie->id)->delete();

        return redirect()->route('movies.index')->with('success', 'Postagem deletada');
    }
}
