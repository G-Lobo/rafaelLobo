<?php

namespace App\Http\Controllers;

use App\Models\Collage;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collages = Collage::all();
        return view('collages.index', compact('collages'));
    }

    public function indexADM()
    {
        $collages = Collage::all();
        return view('collages.indexADM', compact('collages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('collages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title',
            'content',
            'releaseDate',
        ]);

        $collage = new Collage();
        $collage->title = $request->title;
        $collage->content = $request->content;
        $collage->releaseDate = $request->releaseDate;

        $collage->save();

        if ($request->hasFile('collection')) {
            for ($i = 0; $i < count($request->allFiles()['collection']); $i++) {
                $file = $request->allFiles()['collection'][$i];
                $extension = $file->extension();
                $imageName = md5($file->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $collection = new Collection();
                $collection->collage_id = $collage->id;
                $file->move(public_path('assets/img/collages'), $imageName);
                $collection->image = $imageName;
                $collection->save();
            }
        }

        return redirect()->route('collages.indexADM')->with('success', 'Postagem Criada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collage $collage)
    {
        $post = Collage::findOrFail($collage->id);

        return view('collages.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collage $collage)
    {
        $post = Collage::findOrFail($collage->id);
        return view('collages.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collage $collage)
    {
        $data = $request->all();

        $request->validate([
            'title',
            'content',
            'releaseDate',
        ]);

        if ($request->hasFile('collection')) {
            $collectionImages = $request->allFiles()['collection'];
            $oldCollectionImages = $collage->collection->pluck('image')->all();

            foreach ($collectionImages as $i => $file) {
                $extension = $file->extension();
                $imageName = md5($file->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $file->move(public_path('assets/img/collages'), $imageName);

                $collection = Collection::firstOrNew(['collage_id' => $collage->id, 'image' => $imageName]);
                $collection->image = $imageName;
                $collection->save();

                if (!in_array($imageName, $oldCollectionImages)) {
                    foreach ($oldCollectionImages as $oldCollection) {
                        if (file_exists(public_path('assets/img/collages' . $oldCollection))) {
                            unlink(public_path('assets/img/collages' . $oldCollection));
                        }
                    }
                }
            }
        }

        Collage::findOrFail($collage->id)->update($data);

        return redirect()->route('collages.indexADM')->with('success', 'Postagem Alterada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collage $collage)
    {
        Collage::findOrFail($collage->id)->delete();
        return redirect()->route('collages.indexADM')->with('success', 'Postagem Criada');
    }
}
