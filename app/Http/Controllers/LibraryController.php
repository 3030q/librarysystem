<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function libraryView(){
        return view('library');
    }

    public function addToLibrary(Request $request){
        $request->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required',  'max:255'],
            'publisher' => ['required', 'max:255'],
            'pub_date' => ['required', 'min:8'],
            'count_in_organization'=>['required']
        ]);
        $variable = Book::query()->where('organization_id', (Auth::user()->organization_id))
            ->where('title',($request->title))
            ->first('count_in_organization');
        if($variable !=null){
            Book::where('organization_id', (Auth::user()->organization_id))
                ->where('title',($request->title))
                ->update(['count_in_organization'=>($variable['count_in_organization']+$request->count_in_organization)]);
        }else{
            $book = new Book();
            $book->organization_id = Auth::user()->organization_id;
            $book->title = $request->title;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->pub_date = $request->pub_date;
            $book->count_in_organization = $request->count_in_organization;
            $book->save();
        }

        return redirect()->route('library');
    }

    public function DeleteBook(Request $request){
        $request->validate([
            'titlefordelete' => ['required', 'string'],
            'count_for_delete' => ['required', 'int']
        ]);
        $var = Book::where('organization_id', Auth::user()->organization_id)->where('title', $request->titlefordelete)
            ->first('count_in_organization');
        echo $var;
        if($var['count_in_organization'] > $request->count_for_delete){
            Book::where('organization_id', (Auth::user()->organization_id))->where('title', $request->titlefordelete)
                ->update(['count_in_organization'=>$var['count_in_organization']-$request->count_for_delete]);
        }else{
            Book::where('organization_id', Auth::user()->organization_id)->where('title', $request->titlefordelete)->delete();
        }
        return redirect()->route('library');



    }
}
