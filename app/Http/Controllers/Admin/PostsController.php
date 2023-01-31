<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\category;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// image storage
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::with('category')->paginate(5)
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
        $categories = Category::all();
        $tags = Tag::all();

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

        $request->validate(
            [
                'title' => 'required|max:30',
                'description' => 'required|max:250'
            ]
        );

        $new_record = new Post();

        if(array_key_exists('upload', $data)){
            $image_url= Storage::put('post_images', $data['upload']);
            $data['image'] = $image_url;
        }

        $new_record->fill($data);
        $new_record->save();


        if(array_key_exists('tags', $data)){
            $new_record->tags()->sync($data['tags']);
        }

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
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
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
        $tags = Tag::all();
        $categories = Category::all();

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
        $request->validate(
            [
                'title' => 'required|max:30',
                'description' => 'required|max:250'
            ]
        );

        $post = Post::findOrFail($id);

        if(array_key_exists('upload', $data)){
            $image_url= Storage::put('post_images', $data['upload']);
            $data['image'] = $image_url;
        }


        $post->update($data);
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::findOrFail($id);
        if($post->image){
            Storage::delete($post->image);
        }

        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', "$post->title é stato cancellato.");

    }
}
