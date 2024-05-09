<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogPosts = BlogPost::paginate(6);
        return view('blogPosts.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogPosts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new BlogPost();


        $request->validate([
            'title' => 'required',

        ]);


        //$post->id = $request->id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $request->image;
        $post->link = $request->link;

        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/blogImages'), $imageName);
            $post->image = $imageName;
        }


        if ($request->has('link') && !empty($request->input('link'))) {
            $linkToManipulate = $request->link;
            $embedLink = $this->videoEmbeder($linkToManipulate);
            $post->video = $embedLink;
        }


        $post->save();

        return redirect()->route('blog.index')->with('success', 'Postagem criada');
    }


    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost)
    {
        $post = BlogPost::findOrFail($blogPost->id);

        return view('blogPosts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        $post = BlogPost::findOrFail($blogPost->id);

        return view('blogPosts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $data = $request->all();

        //update img
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/blogImages'), $imageName);
            $data['image'] = $imageName;
        }

        //update video
        if ($request->has('link') && !empty($request->input('link'))) {
            $toBeEmbed = $request->link;
            $embedLink = $this->videoEmbeder($toBeEmbed);
            $data['video'] = $embedLink;
        }

        BlogPost::findOrFail($blogPost->id)->update($data);

        return redirect()->route('blog.index')->with('success', 'Postagem Alterada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        BlogPost::findOrFail($blogPost->id)->delete();

        return redirect()->route('blog.index')->with('success', 'Postagem deletada');
    }
}
