<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AboutController extends Controller
{
    public function index()
    {

        $title = "Tentang Kami";

        $response = Http::get('https://api.github.com/users/mohagungnursalim/repos');
        $datas = $response->json();
        
        return view('/about',compact('datas','title'));
    }
}
