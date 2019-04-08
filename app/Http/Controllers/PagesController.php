<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PagesController extends Controller


{
    public function index()
    {
        if(!Auth::check()){
            $title = 'Welcome to laravel';
            // return view('pages.index', compact('title'));  can be done like this
            return view('pages.index')->with('title', $title); // the other way
        }
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return redirect('/posts/')->with('posts', $posts);
    }

    public function about()
    {
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }

    public function services()
    {
        $data = array(
            'title' => 'Services',
            'services' => ['web design', 'programming', 'android development']
        );
        return view('pages.services')->with($data);
    }
    
}
