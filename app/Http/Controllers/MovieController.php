<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Prize;
use App\Models\FilmType; // Import FilmType model
use App\Models\FilmArea; // Import FilmArea model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Import File facade for robust file operations

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Movie::query();

        if ($request->has('area_id') && !empty($request->area_id)) {
            $query->whereHas('filmAreas', function ($q) use ($request) {
                $q->where('film_area_id', $request->area_id);
            });
        }
        $query->orderBy('created_at', 'desc');

        $movies = $query->paginate(6);
        $filmAreas = FilmArea::all();

        return view('movies.index', compact('movies', 'filmAreas'));
    }

    public function indexADM()
    {
        $movies = Movie::paginate(10);

        return view('movies.indexADM', compact('movies'));
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
        // VALIDAÇÃO ATUALIZADA
        $request->validate([
            'title' => ['required'],
            'releaseDate' => ['nullable'],
            'content' => ['required'],
            'coverArt' => ['required', 'image'],
            'duration'  => ['required'],
            'link' => ['nullable', 'url', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|vimeo\.com)\/.+$/'],
            'typeId' => ['required'],
            // Validação para a colagem
            'collage_images' => ['nullable', 'array', 'max:6'],
            'collage_images.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $movie = new Movie();
        $movie->title = $request->title;
        $movie->releaseDate = $request->releaseDate;
        $movie->content = $request->content;
        $movie->duration = $request->duration;
        $movie->link = $request->link;
        $movie->typeId = $request->typeId;

        //upload coverArt image
        if ($request->hasFile('coverArt') && $request->file('coverArt')->isValid()) {
            $requestImage = $request->coverArt;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/coverArts'), $imageName);
            $movie->coverArt = $imageName;
        }

        // LÓGICA PARA AS IMAGENS DA COLAGEM
        $collageImagePaths = [];
        if ($request->hasFile('collage_images')) {
            foreach ($request->file('collage_images') as $imageFile) {
                if ($imageFile->isValid()) {
                    $extension = $imageFile->extension();
                    $imageName = md5($imageFile->getClientOriginalName() . strtotime('now')) . "." . $extension;
                    $imageFile->move(public_path('assets/img/collages'), $imageName);
                    $collageImagePaths[] = $imageName;
                }
            }
        }
        $movie->collage_images = $collageImagePaths;


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

        return redirect()->route('movies.indexADM')->with('success', 'Postagem criada');
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
        $filmTypes = FilmType::all(); // Fetch film types
        $filmAreas = FilmArea::all();

        return view('movies.edit', compact('post', 'filmTypes', 'filmAreas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $data = $request->except(['_token', '_method', 'collage_images']); // Exclui o campo da colagem do update em massa

        $request->validate([
            'title' => ['required'],
            'releaseDate' => ['required'],
            'content' => ['required'],
            'coverArt' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'duration'  => ['required'],
            'link' => ['nullable', 'url', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|vimeo\.com)\/.+$/'],
            'typeId' => ['required'],
            'collage_images' => ['nullable', 'array', 'max:6'],
            'collage_images.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        //update de coverArt
        if ($request->hasFile('coverArt') && $request->file('coverArt')->isValid()) {
            // Deleta a imagem antiga
            if ($movie->coverArt && File::exists(public_path('assets/img/coverArts/' . $movie->coverArt))) {
                File::delete(public_path('assets/img/coverArts/' . $movie->coverArt));
            }
            // Salva a nova
            $requestImage = $request->coverArt;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/coverArts'), $imageName);
            $data['coverArt'] = $imageName;
        }

        // LÓGICA DE UPDATE DA COLAGEM CORRIGIDA
        if ($request->hasFile('collage_images')) {
            // Deleta as imagens antigas do disco
            if ($movie->collage_images) {
                foreach ($movie->collage_images as $oldImage) {
                    if (File::exists(public_path('assets/img/collages/' . $oldImage))) {
                        File::delete(public_path('assets/img/collages/' . $oldImage));
                    }
                }
            }
            // Salva as novas imagens e coleta os nomes
            $newCollageImagePaths = [];
            foreach ($request->file('collage_images') as $imageFile) {
                if ($imageFile->isValid()) {
                    $extension = $imageFile->extension();
                    $imageName = md5($imageFile->getClientOriginalName() . strtotime('now')) . "." . $extension;
                    $imageFile->move(public_path('assets/img/collages'), $imageName);
                    $newCollageImagePaths[] = $imageName;
                }
            }
            // Atualiza a coluna no banco de dados
            $movie->collage_images = $newCollageImagePaths;
        }


        //update de video
        if ($request->has('link') && !empty($request->input('link'))) {
            $toBeEmbed = $request->link;
            $embedLink = $this->videoEmbeder($toBeEmbed);
            $data['videoLink'] = $embedLink;
        }

        //update dos premios
        if ($request->hasFile('prizes')) {
            // ... (sua lógica de update de prêmios)
        }

        if ($request->has('film_areas')) {
            $movie->filmAreas()->sync($request->input('film_areas'));
        }

        // Atualiza os dados simples e a coluna da colagem
        $movie->update($data);

        return redirect()->route('movies.indexADM')->with('success', 'Postagem alterada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        // ... (seu código de delete)
    }
}
