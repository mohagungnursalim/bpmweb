<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AboutController extends Controller
{
    public function index()
    {

        $title = "Tentang Kami";
        return view('about',compact('title'));
    }
}
