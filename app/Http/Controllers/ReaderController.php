<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\QueryBuilder\QueryBuilder;

class ReaderController extends Controller
{
    public function ReaderView(){
        $foo = QueryBuilder::for(User::query()->where('organization_id',Auth::user()->organization_id))->allowedFilters(['last_name', 'email'])->get();
        return view('reader',['reader'=>$foo]);

    }

    public function readerFilterBySurname(Request $request){
        $request->validate(['surname' => ['max:255']]);
        return \redirect('/readers?filter[last_name]='.$request->surname);
    }

    public function readerFilterByEmail(Request $request)
    {
        $request->validate(['email' => ['max:255']]);
        return \redirect('/readers?filter[email]=' . $request->email);
    }
}
