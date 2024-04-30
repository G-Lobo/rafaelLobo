<?php

use App\Models\BlogPost;

test('should return all posts', function () {
    $post = new BlogPost();

    $post->title = 'John Doe';
    $post->content = 'Lorem ipsum';

    $posts = BlogPost::create($post);

    dd($posts);
    //echo ($posts); die()
    // $response = $this
    //     ->actingAs($user)
    //     ->get('/profile');

    // $response->assertOk();
});

// Route::get('/blog', [BlogPostsController::class, 'index'])->name('blog.index');
// Route::get('/blog/create', [BlogPostsController::class, 'create'])->name('blog.create');

test('', function () {

    // expect()->toBe
});
