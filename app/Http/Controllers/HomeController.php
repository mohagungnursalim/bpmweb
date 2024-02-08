<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
class HomeController extends Controller
{
    public function index(Post $post)

    {
       
        $populer = Post::with('author')->where('id', '!=', $post->id)->where('moderasi', 'Setujui')->latest('total_views')->take(3)->get();
    
        return view('home', [
            "title" => "Home",  
            "posts" => $populer        
        ]);
    }

    
}
