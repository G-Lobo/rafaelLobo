<?php

namespace App\Http\Controllers;

use App\Models\Institutional;
use Illuminate\Http\Request;


class InstitutionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Institutional::all();

        return view('Institutional.index', compact('works'));
    }

    public function indexADM()
    {
        $works = Institutional::all();

        return view('Institutional.indexADM', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Institutional.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'content' => ['required'],
            'link' => ['nullable'],
            'image' => ['nullable'],
        ]);

        $work = new Institutional();
        $work->name = $request->name;
        $work->content = $request->content;
        $work->link = $request->link;
        $work->image = $request->image;

        //upload image
        if($request->hasFile('image')&& $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/institucional'), $imageName);
            $work->image = $imageName;
        }

        $work->save();

        return redirect()->route('movies.index')->with('success', 'Filme institucional criado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Institutional $institutional)
    {
        $works = Institutional::findOrFail($institutional->id);

        return view('Institutional.show', compact('works'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institutional $institutional)
    {
        $post = Institutional::findOrFail($institutional->id);

        return view('Institutional.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institutional $institutional)
    {
        $data = $request->all();

        $request->validate([
            'name' => ['required'],
            'content' => ['required'],
            'link' => ['nullable'],
            'image' => ['nullable'],
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/institucional'), $imageName);
            $data['image'] = $imageName;
        }

        Institutional::findOrFail($institutional->id)->update($data);

        return redirect()->route('adm.pannel')->with('success', 'filme Institucional criado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institutional $institutional)
    {
        Institutional::findOrFail($institutional->id)->delete();

        return redirect()->route('adm.pannel')->with('success', 'filme institucional deleteado');
    }
}
