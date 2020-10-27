<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function RecordView(){
        return view('record');
    }

    public function AddRecord(Request $request){
        $request ->validate([
            'book'=>['string', 'required'],
            'date_take'=>['required']
        ]);
        $record = new Record();
        $record -> date_take = $request->date_take;
        $record -> user_id = Auth::user()->id;
        $record -> book_id = Book::where('organization_id', Auth::user()->organization_id)->where('title', $request->book)->first('id')['id'];
        $record -> organization_id = Auth::user()->organization_id;
        $record ->save();

        //Этот функционал пока не до конца продуман
        /*$var = Book::where('organization_id', Auth::user()->organization_id)
            ->where('title', $request->book)
            ->first('count_in_organization')['count_in_organization'];
        if($var != 1){
            Book::where('organization_id', Auth::user()->organization_id)->where('title', $request->book)
                ->update(['count_in_organization'=>$var-1]);
        }else{
            Book::where('organization_id', Auth::user()->organization_id)->where('title', $request->book)->delete();
        }*/

        return redirect()->route('record');
    }

    public function ReturnBook(Request $request){
        $request->validate([
            'date_returned'=>['required']
        ]);
        Record::where('id', $request->id)->update(['date_returned'=>$request->date_returned]);
        return redirect()->route('record');
    }

    public function Delete(Request $request){
        Record::where('id', $request->id)->delete();
        return redirect()->route('record');
    }
}
