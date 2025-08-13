<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Comic;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comics = Comic::all();
        return view('comics.index', compact('comics'));
    }


    public function indexADM()
    {
        $comics = Comic::paginate(10);

        return view('comics.indexADM', compact('comics'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> ['required'],
            'content'=> ['required'],
            'link' => ['required', 'url'],
            'coverImg' => ['required'],
            'releaseDate' => ['nullable'],
            'moviePoster' => ['required'],
        ]);

        $comic = new Comic();
        $comic->title = $request->title;
        $comic->content = $request->content;
        $comic->link = $request->link;
        $comic->coverImg = $request->coverImg;
        $comic->releaseDate = $request->releaseDate;
        $comic->moviePoster = $request->moviePoster;

        //upload coverImg
        if($request->hasFile('coverImg') && $request->file('coverImg')->isValid()) {
            $requestImg = $request->coverImg;
            $extension = $requestImg->extension();
            $imageName = md5($requestImg->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImg->move(public_path('assets/img/comicCovers'), $imageName);
            $comic->coverImg = $imageName;
        }

        //upload moviePoster
        if($request->hasFile('moviePoster') && $request->file('moviePoster')->isValid()) {
            $requestImg = $request->moviePoster;
            $extension = $requestImg->extension();
            $imageName = md5($requestImg->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImg->move(public_path('assets/img/moviePoster'), $imageName);
            $comic->moviePoster = $imageName;
        }

        //save
        $comic->save();

        //upload Pages
        if($request->hasFile('pages')) {
            for ($i = 0; $i < count($request->allFiles()['pages']); $i++) {
                $file = $request->allFiles()['pages'][$i];
                $extension = $file->extension();
                $imageName = md5($file->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $page = new Page();
                $page->comic_id = $comic->id;
                $file->move(public_path('assets/img/comicPages'), $imageName);
                $page->image = $imageName;
                $page->save();
            }
        }

        return redirect()->route('comic.indexADM')->with('success', 'Postagem Criada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comic $comic)
    {
        $post = Comic::findOrFail($comic->id);

        return view('comics.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comic $comic)
    {

        $post = Comic::findOrFail($comic->id);

        return view('comic.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comic $comic)
    {
        $data = $request->all();

        $request->validate([
            'title'=> ['required'],
            'content'=> ['required'],
            'link' => ['required', 'url', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be|vimeo\.com)\/.+$/'],
            'coverImg' => ['required'],
            'releaseDate' => ['nullable'],
            'moviePoster' => ['required'],
        ]);

        //update coverImg
        if($request->hasFile('coverImg') && $request->file('coverImg')->isValid()) {
            $requestImage = $request->coverImg;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/comicCovers'), $imageName);
            $data['coverImg'] = $imageName;

            if($comic->coverImg && file_exists(public_path('assets/img/comicCovers'. $comic->coverImg))) {
                unlink(public_path('assets/img/comicCovers' . $comic->coverImg));
            }
        } else {
            $data['coverImg'] = $comic->coverImg;
        }

        //update moviePoster
        if($request->hasFile('moviePoster') && $request->file('moviePoster')->isValid()) {
            $requestImage = $request->moviePoster;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/moviePoster'), $imageName);
            $data['moviePoster'] = $imageName;

            if($comic->moviePoster && fileExists(public_path('assets/img/moviePoster'. $comic->moviePoster))) {
                unlink(public_path('assets/img/moviePoster' . $comic->moviePoster));
            }
        } else {
            $data['moviePoster'] = $comic->moviePoster;
        }

        //update das paginas
        //rever esse codigo
        if($request->hasFile('pages')) {
            $pageImages = $request->allFiles()['pages'];
            $oldPageImages = $comic->pages->pluck('image')->all();

            foreach($pageImages as $i => $file) {
                $extension = $file->extension();
                $imageName = md5($file->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $file->move(public_path('assets/img/comicPages'), $imageName);

                $page = Page::firstOrNew(['comic_id' => $comic->id, 'image' =>$imageName]);
                $page->image = $imageName;
                $page->save();

                if(!in_array($imageName, $oldPageImages)) {
                    foreach($oldPageImages as $oldPage) {
                        if(file_exists(public_path('assets/img/comicPages' . $oldPage))) {
                            unlink(public_path('assets/img/comicPages' . $oldPage));
                        }
                    }
                }
            }
        }

        Comic::findOrFail($comic->id)->update($data);

        return redirect()->route('comic.indexADM')->with('success', 'Postagem alterada');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comic $comic)
    {
        Comic::findOrFail($comic->id)->delete();
        return redirect()->route('comics.index')->with('success', 'Postagem deletada');
    }
}
