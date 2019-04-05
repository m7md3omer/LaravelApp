<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller


{
    public function index()
    {
        $title = 'Welcome to laravel';
        // return view('pages.index', compact('title'));  can be done like this
        return view('pages.index')->with('title', $title); // the other way
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
