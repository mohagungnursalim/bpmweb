<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Alert;
class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/dashboard/changepassword',[
          
            "title" => "Change Password"
        ]);
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required', 'min:8',
            'new_confirm_password' => 'same:new_password','min:8'
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);


        $request->session(Alert::success('success', 'Password berhasil di perbarui!'));

        return redirect('/dashboard/changepassword');
    }
}