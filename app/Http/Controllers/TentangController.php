<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Auth;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tentangs = Tentang::latest()->take(1)->get();

        return view('dashboard.tentang-bpm.index',compact('tentangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tentang  $tentang
     * @return \Illuminate\Http\Response
     */
    public function show(Tentang $tentang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tentang  $tentang
     * @return \Illuminate\Http\Response
     */
    public function edit(Tentang $tentang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tentang  $tentang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->username=='Moh Agung N') {
            $validatedData=$request->validate([ 'body'=> 'required'
                ]);

            Tentang::whereId($id)->update($validatedData);

            $request->session(Alert::success('Sukses👍', ' Berhasil tersimpan!'));
            return redirect('/dashboard/tentang-bpm');
        }

        else {
            $request->session(Alert::error('error', 'Maaf anda tidak memiliki akses ke halaman tersebut'));

            return redirect('/dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tentang  $tentang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tentang $tentang)
    {
        //
    }
}
