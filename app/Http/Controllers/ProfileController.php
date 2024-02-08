<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Alert;
use Image;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        return view('profile', [
            'user' => $request->user(),
            'title'=> 'My Profile'
        ]);
    }


    /**
     * Show the update profile page.
     * 
     * @param  Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
    //  UPDATE PROFILE  
    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update(
            $request->all()
        );
    
        $request->session(Alert::success('success', 'Profil berhasil diperbarui!'));
        return redirect()->route('profile.update');
    }
    public function updateAvatar(Request $request)
    {
        // handle user upload profile image
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' .$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(640,640)->save(public_path('/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        $request->session(Alert::success('success', 'Foto Profil berhasil di perbarui!'));
        return view('profile',array('user' => Auth::user()));
    }
 
}
