<?php

namespace App\Http\Controllers;
use App\Models\Subscriber;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SubscriberExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Alert;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriber= Subscriber::latest();

        if(request('search')){

            $subscriber->where('email', 'like', '%' . request('search'). '%');

        }
            return view('dashboard.subscriber.index',[
                'subscriber' =>$subscriber->paginate(10),
                'title' => 'User Subscriber'
            ]);
    }

    // export data subscriber Excel dashboard

    public function subscriberexport()
    {
        
        return Excel::download(new SubscriberExport,'subscriber.csv');
    }


    //  send Email Dashboard
     public function sendemail(Subscriber $subscriber,Request $request)
     {

       

         $request->validate([
             'email' => 'email',
             'name' => 'required',
             'body' => 'required'
         ]);
 
         $data = [
             'email' => $request->email,
             'subject' => $request->subject,
             'body' => $request->body
         ];
    
         Mail::send('email-template', $data, function($message) use ($data){
             $message->to($data['email'])->subject($data['subject']);
         });
 
       
        return back()->with(['message' => 'Email berhasil terkirim']);
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

    //  store from footer
    // public function store(Subscriber $subscriber,Request $request)
    // {
        
    //     $subscriber = new Subscriber; 
    //     $validatedData = $request->validate([

    //         'email' => 'email|unique:subscribers'
    //    ]);
       

    //   $subscriber::create($validatedData);
    //   return back()->with(['message' => 'Berhasil Subscribe']);
    // }
    // store from post
    public function storepost(Subscriber $subscriber,Request $request)
    {
        $messages = [
            'required' => ':attribute Wajib diisi!',
            'unique' => ':attribute Sudah pernah didaftarkan',
            'email' => ':attribute Harus menggunakan email asli misal emailmu@gmail.com'
        ];
        
        $subscriber = new Subscriber; 
        $validatedData = $request->validate([

            'email' => 'required|email|unique:subscribers'
       ],$messages);
       

      $subscriber::create($validatedData);
      return back()->with(['message' => 'Berhasil Subscribe']);
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
    public function destroy(Subscriber $subscriber, Request $request)
    {
        Subscriber::destroy($subscriber->id);
        $request->session(Alert::success('success', 'Unsubscribe berhasil!'));
        return redirect('/dashboard/subscriber');
    }

 
}
