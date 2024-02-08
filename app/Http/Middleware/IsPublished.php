<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardPostController;
use App\Models\Post;
use Alert;
class IsPublished
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)

    {

    $posts = Post::all();

    foreach ($posts as $post) {
        
        if($post->is_published == 1){
            return $next($request);
        }
    
        abort(404);   
        }


        }

   


}
