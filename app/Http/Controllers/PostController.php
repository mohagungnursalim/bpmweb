<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\True_;


class PostController extends Controller
{

 
    public function index()
    {
        $post = Post::with('author')->where('moderasi', 'Setujui')->filter(request(['search']))->latest()->paginate(16);
        
        $title = '';
        if(request('category'))
        {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' Topik : ' . $category->name;
            $post = Post::where('category_id','LIKE','%'. $category->id.'%')->with('author')->where('moderasi', 'Setujui')->simplepaginate(18)->withQueryString();
        }
        if(request('tag'))
        {
            $tag = Tag::firstWhere('slug', request('tag'));
            $title = '  Tag : ' . $tag->name;
            $post = Post::where('tag_id','LIKE','%'. $tag->id.'%')->with('author')->where('moderasi', 'Setujui')->simplepaginate(18)->withQueryString();
        }
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = $author->username . '  ' ;
            $post = Post::where('user_id',$author->id)->with('author')->where('moderasi', 'Setujui')->simplepaginate(18)->withQueryString();
        }

        
        return view('posts', [

            "title" => "Artikel" . $title,
           
            "posts" => $post,
        ]);

        // return response()->json($post);
    }

    public function show(Post $post)
    {
        $post = Post::where('slug', '=', $post->slug)->with('author')->firstOrFail();
        
        // cek jika status moderasi null maka tampilkan 404 code
        if ($post->moderasi == null) {
           
            abort(404);
        }

        $post;
        // menampilkan semua post terkait kecuali yang sedang terbuka
        // $related= Post::where('category_id', '=', $post->category_id)
        //     ->where('id', '!=', $post->id)
        //     ->get();

        //    $related = Post::where('category_id', $post->category_id)->where('id', '!=', $post->id)->paginate(4);
        $latest = Post::with('author')->where('id', '!=', $post->id)->where('moderasi', 'Setujui')->latest()->simplepaginate(3);
            
        //    $populer = Post::with('author')->where('id', '!=', $post->id)->latest('total_views')->simplepaginate(5);
        $populer = Post::with('author')->where('id', '!=', $post->id)->where('moderasi', 'Setujui')->latest('total_views')->simplepaginate(3);
        
           Post::where('id', $post->id)

            ->update([
                "total_views" => $post->total_views + 1
            ]);


        return view('post', [
            "post" => $post,
            "title" => $post['title'],
            "twitter" =>  DB::table('users')->where('twitter', TRUE)->first(),
            "latest" => $latest,
            "populer" => $populer
            // "related" => $related
        ]);
        
    }

    public function category(Category $category,Post $post)
    {

  
        $category = Category::latest()->paginate(16);
    //    dd($category);
   
        
        return view('categories',[

            "title" => "Topik",
            "categories" => $category,
            "posts" => $post
        ]);
    }
    public function iklan()
    {

    }

    
}
