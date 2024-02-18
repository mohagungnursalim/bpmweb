<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Foreach_;
use Alert;
use Illuminate\Support\Facades\DB;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  index contact Frontend
    public function index()
    {
        
        return view('contact',[
            "title" => "Kontak Kami",
        ]);
    }

   
   
    // store data from front kontak
    public function store(Contact $contact,Request $request)
    {
         
        $validatedData = $request->validate([

            'nama' => 'required',
            'email' => 'required|email',
            'subyek'=> 'required|max:255',
            'body' => 'required'
       ]);
       

      $contact::create($validatedData);
       $request->session(Alert::success('success', 'Pesan berhasil terkirim,kami akan membalas pesan anda dalam beberapa saat.'));
       return redirect('/kontak');
    }

    
    // get semua data kontak tampilkan ke halaman kontak/index    
    public function show( Contact $contacts)
    {
        $contacts = Contact::latest()->paginate(10);
        
        if(request('search')){

            $contacts->where('email', 'like', '%' . request('search'). '%');

        }

        
        // pasing data
            return view('dashboard.kontak.index',[
                'contacts' =>$contacts,
                'total' => $contacts->count(),
                'count_dibaca' => Contact::where('is_read', true)->count(),
                'count_belumdibaca' => Contact::where('is_read', null)->count()
            ]);
    }

    // update isread
    public function update(Request $request, Contact $contact)
    {
        $rules = [
            'is_read' => 'required|max:1'
        ];
    
        $validatedData = $request->validate($rules);
    
        Contact::where('id', $contact->id)
            ->update($validatedData);
    
        // Tambahkan pesan sukses ke sesi
        $request->session()->flash('success', 'Pesan ditandai telah terbaca!');
    
        return redirect('/dashboard/pesanmasuk');
    }



    // hapus pesan masuk berdasarkan id
    public function destroy(Contact $contact, Request $request)
    {
        Contact::destroy($contact->id);

        $request->session(Alert::success('success', 'Pesan berhasil dihapus'));
        return redirect('/dashboard/pesanmasuk');
    }
    
}
