<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       
        $event = Event::latest();
   
        if(request('search')){

            $event->where('nama', 'like', '%' . request('search'). '%');

        }
            return view('dashboard.events.index',[
                'data' =>$event->paginate(5),
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

       $validatedData = $request->validate([   
                'nama'=> 'required|string|min:5',
                'deskripsi'=> 'required|string|min:5',
                'tanggal_mulai' => 'required|date',
                'link' => 'string|min:5'
                
            ]);
 
     
            // Simpan event ke database
        try {
            Event::create($validatedData);
            $request->session(Alert::success('Berhasil 👍😉', 'Event berhasil ditambahkan!'));
            return redirect('/dashboard/manajemen-event/');
        } catch (\Exception $e) {
            // Handle the exception
            $request->session(Alert::error('Gagal 😢', 'Terjadi kesalahan saat menambahkan event.'));
            return redirect()->back();
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
    public function update(Request $request,Event $event, $id)
    {
    
            $validatedData = $request->validate([   
                'nama'=> 'required|string|min:5',
                'deskripsi'=> 'required|string|min:5',
                'tanggal_mulai' => 'required|date',
                'link' => 'string|min:5'
                
            ]);

        try {
            // Temukan event berdasarkan ID
             $event = Event::findOrFail($id);
            // Perbarui data event
            $event->update($validatedData);

            $request->session(Alert::success('Berhasil 👍😉', 'Event berhasil diperbarui!'));
            return redirect('/dashboard/manajemen-event/');
        } catch (\Exception $e) {
            // Handle the exception
            $request->session(Alert::error('Gagal 😢', 'Terjadi kesalahan saat memperbarui event.'));
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $event = Event::find($id);
        if (!$event) {
            abort(404);
        }

        $event->delete();

        $request->session(Alert::success('Berhasil 👍😉', 'Event berhasil dihapus!'));
        return redirect('/dashboard/manajemen-event');
    }

    public function frontevent()
    {
        $event = Event::latest()->paginate(10);
   
        return view('event',[
            'events' =>$event,
            'title' => 'Event'
        ]);
    }

    public function fronteventdetail(Event $event)
    {
        $event = Event::where('slug', '=', $event->slug)->firstOrFail();


        return view('event-detail',[

            'event' => $event,
            'title' => $event->nama
        ]);
    }
}
