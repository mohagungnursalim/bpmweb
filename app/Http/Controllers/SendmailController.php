<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Alert;


class SendmailController extends Controller
{

    public function index(Contact $contact , Request $request)
    {

        $pesan = DB::table('contacts')->orderBy('id','ASC')->get();

    return view('dashboard.sendmail.index', [
    'title'=> 'Balas Pesan | Dashboard',
    'pesans' => $pesan
        ]);
    }
    

    // send email to author
    public function sendemail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subyek' => 'required',
            'body' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subyek' => $request->subyek,
            'body' => $request->body
        ];

        Mail::send('email-template', $data, function($message) use ($data){
            $message->to($data['email'])->subject($data['subyek']);
        });

      
       
        return back()->with(['message' => 'Email berhasil terkirim!']);
    }


    // public function template()
    // {

    //     return view('email-template', [
    //         'title'=> 'Template',
    //         'subyek' => 'Terima kasih telah menghubungi kami.',
    //         'name' => 'Yongki',
    //         'email' => 'yongki@gmail.com',
    //         'body' => 'Terkait permasalahan tersebut,kami sangat menyesali nya dan akan segera kami tindak lanjuti.Terima kasih atas masukannya.'

    //     ]);
            
    // }


}
