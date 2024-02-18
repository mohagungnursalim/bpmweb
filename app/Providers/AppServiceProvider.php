<?php

namespace App\Providers;

use App\Http\Controllers\TentangController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Post;
use App\Models\Tentang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Support\Facades\Gate;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // count
        View::share('counts', Contact::latest()->take(6)->get()->count() );

        //  mengambil 6 notif 
        View::share('notif', Contact::latest()->take(6)->get());
        // data tentang-bpm
        // View::share('tentangs', Tentang::latest()->take(1)->get());

        // View::share('isread', Contact::all());
        // // tier
        // View::share('tier',Post::where('user_id', auth()->user()->id)->count());
        View::composer('dashboard.layouts.navbar', function ($view) {
            $view->with('post', Post::where([['user_id','=',Auth::user()->id]])->count());
        });

        Paginator::useBootstrap();

        // Gate::define('update-post', function (User $user,Post $post) {
        //     return $user->id === $post->user_id;
        // });

        Gate::define('admin',function(User $user){

            return $user->is_admin;
        });

    }
}
