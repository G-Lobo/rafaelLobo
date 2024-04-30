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
        $blogPosts = BlogPost::all();
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

        //$post->id = $request->id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $request->image;
        $post->video = $request->video;

        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/blogImages'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->route('blog.index');
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

        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('assets/img/blogImages'), $imageName);
            $data['image'] = $imageName;
        }

        BlogPost::findOrFail($blogPost->id)->update($data);

        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        BlogPost::findOrFail($blogPost->id)->delete();

        return redirect()->route('blog.index');
    }
}
