<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tag = tag::latest();

        if(request('search')){

            $tag->where('name', 'like', '%' . request('search'). '%');

        }
            
            return view('dashboard.tags.index',[
                'tags' =>$tag->paginate(5),
                'title' => 'Tag | Dashboard'
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // menampilkan viewCreate
        return view('dashboard.tags.create',[
            'title'=> 'Add Tag'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Tag $tag,Request $request)
    {
        if (Auth::user()->is_banned == true) 
        {
           abort('404');
        }else{
                $tag = new Tag; 
                $tag->name = $request->name;
                $tag->slug = Str::slug($tag->name, '-'); 
            

                $validatedData = $request->validate([

                    'name' => 'required|max:255|unique:tags',
                    'slug' =>  $tag->slug,
            ]);
            
            Tag::create($validatedData);
            $request->session(Alert::success('Berhasil 👍😉', 'Tag berhasil ditambahkan!'));

            return redirect('/dashboard/tags/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag, Request $request)
    {
    
        if (Auth::user()->is_banned == true) 
        {
           abort('404');
        }else{
            if (Auth::user()->is_admin == true) {
                Tag::destroy($tag->id);

                $request->session(Alert::success('Berhasil 👍😉', 'Tag berhasil dihapus!'));
                return redirect('/dashboard/tags');
            }else{
                abort('404');
            }
            
        }
    }
}
