<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tentang;
use Illuminate\Support\Facades\Http;

class AboutController extends Controller
{
    public function index()
    {
        $tentangs = Tentang::latest()->take(1)->get();
        $title = "Tentang Kami";
        return view('about',compact('title','tentangs'));
    }
}
