<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
        $category = Category::latest();

        if(request('search')){

            $category->where('name', 'like', '%' . request('search'). '%');

        }
            
            return view('dashboard.categories.index',[
                'categories' =>$category->paginate(5),
                'title' => 'Topik | Dashboard'
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
       return view('dashboard.categories.create',[
           'title'=> 'ATambah Topik | Dashboard'
       ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([

            'name' => 'required|unique:categories|max:255',
            'slug' => Str::slug($request->name, '-'),
            'image' => 'image|file',
            'color' => 'required'
            
       ]);

       if($request->file('image')){
        $validatedData['image'] = $request->file('image')->store('categories-images');
    }

       $validatedData['user_id'] = auth()->user()->id;

       Category::create($validatedData);
       
       $request->session(Alert::success('success', 'Kategori berhasil ditambahkan!'));

       return redirect('/dashboard/categories/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        
        if($category->image){

            Storage::delete($category->image);
        }

        Category::destroy($category->id);

        $request->session(Alert::success('success', 'Kategori berhasil dihapus!'));
        return redirect('/dashboard/categories');
    }
}
