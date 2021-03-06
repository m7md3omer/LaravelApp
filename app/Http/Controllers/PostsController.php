<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //use Eloquent ORM to fetch data rather than using plain sql

        // adding pagination
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        // $posts = Post::orderBy('title', 'desc')->take(1)->get(); // limit the number of posts
        // $post = Post::where('title', 'Title of the first post');  
        // this is to order post by a specific field 
        // $posts = Post::orderBy('title', 'desc')->get();
        // we can use simple sql queries like this
        // $posts = DB::select('SELECT * FROM posts where title = "Title of the first post"');

        // $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        // handle file uplaod
        if($request->hasFile('cover_image')){
            // get file name with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }
        // create and save the post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // check if the user is authorized to edit the post
        if(auth()->user()->id !== $post->user_id){
            return redirect('posts/')->with('error', 'Unauthorized page');
        }
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        // handle file uplaod
        if($request->hasFile('cover_image')){
            // get file name with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        // create and save the post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts/'. $post->id)->with('post', $post)->with('success', 'post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // check if the user is authorized to edit the post
        if(auth()->user()->id !== $post->user_id){
            return redirect('posts/')->with('error', 'Unauthorized page');
        }
        // if the image is not the default one delete the image of this post first
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/' . $post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted Successfully!');
    }
}
