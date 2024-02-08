<?php namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        if (Auth::user()->username=='Moh Agung N') {
            $users=User::select("*") ->whereNotNull('last_seen') ->orderBy('last_seen', 'DESC');

            if(request('search')) {
                $users->where('username', 'like', '%'. request('search'). '%')->orWhere('name', 'like', '%'. request('search'). '%')->orWhere('email', 'like', '%'. request('search'). '%');

            }

            $data=$users->paginate(10);
            return view('dashboard.userlist.index', compact('data'));



        }

        else {

            $request->session(Alert::error('error', 'Maaf anda tidak memiliki akses ke halaman tersebut'));

            return redirect('/dashboard');
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Validasi input
        $request->validate([ 
            'email'=> 'required|email|unique:users,email',
            'name'=> 'required|string|max:60',
            'username'=> 'required|string|max:60',
            'is_admin' => 'required|string'
            ]);

        // Jika validasi sukses, buat pengguna baru
        $user=new User;
        $user->email =$request->email;
        $user->name =$request->name;
        $user->username =$request->username;
        $user->password =Hash::make('12345678'); // Menggunakan bcrypt untuk menyimpan password yang di-hash
        $user->is_admin =$request->is_admin;
        // Simpan pengguna ke database
        $user->save();

        $request->session(Alert::success('Sukses👍', 'Akun berhasil dibuat!'));
        return redirect('/dashboard/manajemen-user');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {


        if (Auth::user()->username=='Moh Agung N') {
            $validatedData=$request->validate([ 'is_admin'=> 'required'
                ]);

            User::whereId($id)->update($validatedData);

            $request->session(Alert::success('Sukses👍', 'Akses telah diubah!'));
            return redirect('/dashboard/manajemen-user');
        }

        else {
            $request->session(Alert::error('error', 'Maaf anda tidak memiliki akses ke halaman tersebut'));

            return redirect('/dashboard');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {

        if (Auth::user()->username=='Moh Agung N') {
            User::destroy($id);

            $request->session(Alert::success('Sukses👍', 'Akun telah dihapus!'));
            return redirect('/dashboard/manajemen-user');
        }

        else {
            $request->session(Alert::error('error', 'Maaf anda tidak memiliki akses ke halaman tersebut'));

            return redirect('/dashboard');
        }
    }

    public function banned(Request $request, $id) {

        // $user =  User::whereId($id);

        if (Auth::user()->username=='Moh Agung N') {
            $validatedData=$request->validate([ 'is_banned'=> 'required'
                ]);

            User::whereId($id)->update($validatedData);

            
            $request->session(Alert::success('Sukses👍', 'Akun telah dibanned!'));
            return redirect('/dashboard/manajemen-user');
        }

        else {
            $request->session(Alert::error('Oops', 'Maaf anda tidak memiliki akses ke halaman tersebut'));

            return redirect('/dashboard');
        }

    }

    public function unbanned(Request $request, $id) 
    
    {


        if (Auth::user()->username=='Moh Agung N') {
            $validatedData=$request->validate([ 
                'is_banned'=> 'required'
                
                ]);

            User::whereId($id)->update($validatedData);

            
            $request->session(Alert::success('Sukses👍', 'Akun telah dipulihkan kembali!'));
            return redirect('/dashboard/manajemen-user');
        }

        else {
            $request->session(Alert::error('Oops', 'Maaf anda tidak memiliki akses ke halaman tersebut'));

            return redirect('/dashboard');
        }

    }
}
