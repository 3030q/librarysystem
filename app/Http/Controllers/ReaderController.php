<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReaderController extends Controller
{
    public function ReaderView(){
        return view('reader');
    }
}
