<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Movie;
use App\Models\FilmArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bio = About::all();
        $movies = Movie::latest()->take(4)->get();
        $filmAreas = FilmArea::all();

        return view('about.index', compact('movies', 'filmAreas', 'bio'));
    }

    public function indexADM()
    {
        $bio = About::all();

        return view('about.indexADM', compact('bio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string'],
            'profilePic' => ['required', 'file'],
            'pdf' => ['required', 'file'],
        ]);

        $bio = new About();
        $bio->content = $request->content;
        $bio->profilePic = $request->profilePic;
        $bio->pdf = $request->pdf;

        //upload profilePic
        if ($request->hasFile('profilePic') && $request->file('profilePic')->isValid()) {
            $requestImage = $request->profilePic;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;
            $requestImage->move(public_path('assets/img/profPic'), $imageName);
            $bio->profilePic = $imageName;
        }

        //upload PDF
        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $requestPDF = $request->file('pdf');
            $extension = $requestPDF->getClientOriginalExtension();
            $pdfName = md5($request->pdf->getClientOriginalName() . strtotime('now')) . '.' . $extension;
            $requestPDF->move(public_path('assets/pdf/bio'), $pdfName);
            $bio->pdf = $pdfName;
        }

        $bio->save();

        return redirect()->route('about.index')->with('success', 'Bio Criada');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        $bio = About::findOrFail($about->id);

        return view('about.edit', compact('bio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $data = $request->all();

        $request->validate([
            'content' => ['nullable'],
            'profilePic' => ['nullable'],
            'pdf' => ['nullable'],
        ]);

        //update img
        if($request->hasFile('profilePic') && $request->file('profilePic')->isValid()) {
            $requestImage = $request->profilePic;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/profPic'), $imageName);
            $data['profilePic'] = $requestImage;
        }

        //update pdf
        if($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $requestPDF = $request->file('pdf');
            $extension = $requestPDF->getClientOriginalExtension();
            $pdfName = md5($requestPDF->getClientOriginalName() . strtotime('now')) . "." . $extension;

            $requestPDF->move(public_path('assets/pdf/bio'), $pdfName);
            $data['pdf'] = $pdfName;
        }

        About::findOrFail($about->id)->update($data);

        return redirect()->route('adm.pannel')->with('success', 'Bio Alterada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        About::findOrFail($about->id)->delete();

        return redirect()->route('adm.pannel')->with('success', 'Bio deletada');
    }
}
