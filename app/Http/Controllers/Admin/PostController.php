<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreatePostMail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::with('category', 'tags')->paginate(10)
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::All();
        $tags = Tag::All();


        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        //dd($data);

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $newpost = new Post();

        if (array_key_exists('image', $data)) {

            $cover_url = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_url;
        };



        $newpost->fill($data);
        $newpost->save();



        if (array_key_exists('tags', $data)) {

            $newpost->tags()->sync($data['tags']);
        };


        $mail = new CreatePostMail($newpost);
        $email_utente = Auth::user()->email;
        Mail::to($email_utente )->send($mail);



        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singolo_post = Post::findOrFail($id);

        return view('admin.posts.show', compact('singolo_post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $categories = Category::All();

        $tags = Tag::All();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $singolo_post = Post::findOrFail($id);

        $singolo_post->update($data);

        if (array_key_exists('tags', $data)) {

            $singolo_post->tags()->sync($data['tags']);
        } else {
            $singolo_post->tags()->sync([]);
        };

        return redirect()->route('admin.posts.index', $singolo_post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singolo_post = Post::findOrFail($id);

        if ($singolo_post->cover) {
            Storage::delete($singolo_post->cover);
        };

        $singolo_post->tags()->sync([]);

        $singolo_post->delete();

        return redirect()->route('admin.posts.index');
    }
}
