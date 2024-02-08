<?php
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\TierController;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SendmailController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TentangController;
use App\Models\Tentang;
use GuzzleHttp\Middleware;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// php info

// Route::get('phpmyinfo', function () {
//     phpinfo(); 
// })->name('phpmyinfo');


Route::get('/template', [SendmailController::class, 'template']);




// ---------------------------------|| Sitemap Route || ------------------------------//

Route::get('sitemap',function(Request $request){
    $site = App::make('sitemap');
    $site->add(URL::to('/'),date("Y-m-d h:i:s"),1,'daily');
    $site->add(URL::to('/artikel'),date("Y-m-d h:i:s"),1,'daily');
    $site->add(URL::to('/topik'),date("Y-m-d h:i:s"),1,'daily');
    $site->add(URL::to('/kontak'),date("Y-m-d h:i:s"),1,'daily');
    $site->add(URL::to('/tentang-kami'),date("Y-m-d h:i:s"),1,'daily');
    $site->add(URL::to('/daftar-author'),date("Y-m-d h:i:s"),1,'daily');
    $site->add(URL::to('/privacy-policy'),date("Y-m-d h:i:s"),1,'daily');
    $site->add(URL::to('/terms'),date("Y-m-d h:i:s"),1,'daily');
    $posts = Post::all();
    foreach ($posts as $key => $post) {
        $site->add(URL::to('/artikel/'. $post->slug),$post->created_at,1,'daily');

    }
    foreach ($posts as $key => $post) {
        // searching navbar post
        $site->add(URL::to('/artikel?search='. $post->slug),$post->created_at,1,'daily');
    }
    $categories = Category::all();
    foreach ($categories as $key => $category) {
        // searching navbar category
        $site->add(URL::to('/artikel?category='. $category->slug),$category->created_at,1,'daily');
    }
    $tags = Tag::all();
    foreach ($tags as $key => $tag) {
        // searching navbar tag
        $site->add(URL::to('/artikel?tag='. $tag->slug),$tag->created_at,1,'daily');
    }
    // store to xml

    
    $site->store('xml','sitemap');
   
    return redirect('/dashboard/posts')->with('message', 'Request sitemap berhasil!');
});

// --------------------------------|| end Sitemap || ----------------------------------//

// ---------------------------|| file manager ||---------------------------------------//

// ---------------------------------filemanage laravel------------------------------------
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web','auth']], function () {
    UniSharp\LaravelFilemanager\Lfm::routes();
});

// ---------------------------end file manager---------------------------------------//



// --------------------------|| Navbar Frontend route ||-------------------------------//

// -------------------------------Subscriber footer CREATE-------------------------------
Route::post('/', [SubscriberController::class, 'store'])->name('subscriberfooter');
Route::post('/artikel', [SubscriberController::class, 'storepost'])->name('subscriberpost');
// --------------------------------------end subs------------------------------------------

// -----------------------categories-------------------------
Route::get('/topik', [PostController::class, 'category']);

// -----------------------end categories---------------------


// -----------------------home---------------------------
Route::get('/', [HomeController::class, 'index']);

// -----------------------end home-----------------------


// ----------------------donasi---------------------------
Route::get('/donasi', function () {
    return view('donasi', [
        "title" => "Donasi"
       
    ]);
});
// ----------------------end donasi------------------------


// ----------------------daftar author----------------------
Route::get('/daftar-author', function () {
    return view('daftarauthor', [
        "title" => "Pendaftaran Author"
       
    ]);
});
// ----------------------end daftar author------------------


// -------------------about----------------------------
Route::get('/tentang-kami',[AboutController::class,'index']);

// ------------------end about-------------------------


// -----------------------Kontak---------------------------
Route::get('/kontak', [ContactController::class,'index']);
Route::post('/kontak', [ContactController::class, 'store']);

// -------------------------end kontak---------------------


// ------------------------privacy Policy-------------------------------
Route::get('/privacy-policy', function () {
    return view('privacy', [
        "title" => "Privasi"
    ]);
});

// ---------------------end privacy Policy------------------------------


//------------------------terms-----------------------------
Route::get('/terms', function () {
    return view('terms', [
        "title" => "Ketentuan"
    ]);
});

// ------------------------end terms------------------------

// ------------------------event-----------------------------
Route::get('/event', [EventsController::class, 'frontevent']);
Route::get('/event/{event:slug}', [EventsController::class, 'fronteventdetail']);
// ----------------------end event---------------------------

// -----------------------blog-------------------------------
Route::get('/artikel', [PostController::class, 'index']);

// -----------------------end blog---------------------------


// -----------------------halaman single post----------------------
Route::get('artikel/{post:slug}', [PostController::class, 'show']);

// --------------------------end single post-----------------------



// --------------------------|| end Navbar Frontend route ||-------------------------------//



// ------------------------------------------------|| Dashboard route ||------------------------------------------------------//

// -----------------------------------------------Kirim Email----------------------------------------------------
Route::get('/dashboard/balas-pesan', [SendmailController::class,'index'])->middleware('auth','admin');
Route::post('/dashboard/balas-pesan', [SendmailController::class,'sendemail'])->name('send.email')->middleware('auth','admin');

// -----------------------------------------------end Kirim Email----------------------------------------------------

// -----------------------------------------------Manajemen user---------------------------------------------------
Route::resource('/dashboard/manajemen-user', UserController::class)->except('show')->middleware(['auth','admin']);
Route::put('dashboard/manajemen-user/banned/{user:id}', [UserController::class,'banned'])->middleware(['auth','admin'])->name('banned');
Route::put('dashboard/manajemen-user/unbanned/{user:id}', [UserController::class,'unbanned'])->middleware(['auth','admin'])->name('unbanned');
// -----------------------------------------------end Manajemen user------------------------------------------------



// -----------------------------------------------subcscriber-----------------------------------------------------------
Route::resource('/dashboard/subscriber', SubscriberController::class)->except('show')->middleware('auth','admin');

Route::get('/dashboard/exportsubscriber', [SubscriberController::class,'subscriberexport'])->name('export.subscriber');
// ------------------------------------------------end subscriber-------------------------------------------------------

// ----------------------------------------------Event-----------------------------------------------------------------
Route::resource('/dashboard/manajemen-event', EventsController::class)->middleware('auth','admin');
// ----------------------------------------------end event------------------------------------------------------------

// -------------------------------------------Tentang BPM-------------------------------------------------------------
Route::resource('/dashboard/tentang-bpm', TentangController::class)->middleware('auth','admin');
// ----------------------------------------------End--------------------------------------------------------------
// ------------------------------------------------Dashboard Pesan Masuk----------------------------------------------
Route::get('/dashboard/pesanmasuk', [ContactController::class,'show'])->middleware('auth','admin');
Route::delete('/dashboard/pesanmasuk/{contact:id}',[ContactController::class,'destroy'] )->middleware('auth','admin');
Route::put('/dashboard/pesanmasuk/isread/{contact:id}', [ContactController::class,'update'])->middleware('auth','admin');
// -------------------------------------------------------end---------------------------------------------------------

// -----------------------------------------------auto input slug----------------------------------------------------
// Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// ----------------------------------------------- end auto input slug----------------------------------------------------
Route::resource('/dashboard/tentang-bpm' , TentangController::class)->middleware('auth','admin');
// ----------------------------------------------Tag resource route---------------------------------------------------
Route::resource('/dashboard/tags', TagsController::class,)->except('show','update','edit','create')->middleware(['auth']);;
// ----------------------------------------------End resource route---------------------------------------------------
//  -----------------------------------------------categories---------------------------------------------------------
Route::resource('/dashboard/categories', AdminCategoryController::class,)->except('show','update','edit')->middleware(['auth','admin']);
//  -----------------------------------------------end categories---------------------------------------------------------
// -----------------------------------------------resource route mypost--------------------------------------------
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware(['auth'])->except('show');
// ----------------------------------------------update post published------------------------------------------
Route::put('/dashboard/posts/publish/{post:id}' ,[DashboardPostController::class,'published'])->middleware('auth')->name('published');
// update moderasi
Route::put('/dashboard/posts/moderasi/{post:id}' ,[DashboardPostController::class,'moderasi'])->middleware('admin','auth')->name('moderasi');

//  profile update
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard/profile', [ProfileController::class,'index']);
    Route::post('/dashboard/profile', [ProfileController::class,'update'])->name('profile.update');
   
});

//  dashboard
Route::get('/dashboard', [DashboardPostController::class, 'count'])->middleware('auth');
// ubah profile image
Route::post('/change-picture', [ProfileController::class,'updateAvatar'])->name('change.picture')->middleware('auth');

// ubah password from dashboard
Route::post('/change-password', [ChangePasswordController::class,'store'])->name('change.password')->middleware('auth');

Route::get('/dashboard/changepassword', [ChangePasswordController::class ,'index'])->middleware('auth');
// _______________________________//



require __DIR__.'/auth.php';
