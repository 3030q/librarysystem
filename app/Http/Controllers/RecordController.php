<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RecordController extends Controller
{
    public function RecordView()
    {
        $foo = QueryBuilder::for(Record::where('organization_id', Auth::user()->organization_id))->
        allowedFilters([AllowedFilter::scope('id'), AllowedFilter::scope('not_returned')])->get();
        return view('record', ['record' => $foo]);
    }

    public function idFilter(Request $request)
    {
        return \redirect('/records?filter[id]=' . $request->id);
    }

    public function AddRecord(Request $request)
    {
        $request->validate([
            'book' => ['string', 'required'],
            'date_take' => ['required']
        ]);
        $record = new Record();
        $record->date_take = $request->date_take;
        $record->user_id = Auth::user()->id;
        $record->book_id = Book::where('organization_id', Auth::user()->organization_id)->where('title', $request->book)->first('id')['id'];
        $record->organization_id = Auth::user()->organization_id;
        $record->save();

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

    public function takeBook($id)
    {
        $book = Book::where('id', $id);
        if ($book->first("count_in_organization")["count_in_organization"] > 1) {
            $record = new Record();
            $record->date_take = date('Y-m-d');
            $record->user_id = Auth::user()->id;
            $record->book_id = $id;
            $record->organization_id = Auth::user()->organization_id;
            $record->save();
            $book->update(['count_in_organization'=> $book->first('count_in_organization')['count_in_organization'] - 1]);
        }
        return redirect('/library');
    }
    public function takenBookView(){
        return view('userrecord');
    }

    public function returnBook($id)
    {
        $book = Book::where('id', Record::where('id', $id)->first('book_id')['book_id']);
        Record::where('id', $id)->update(['date_returned' => date('Y-m-d')]);
        $book->update(['count_in_organization' => $book->first('count_in_organization')['count_in_organization'] + 1]);
        return redirect()->route('record');
    }

    public function Delete(Request $request)
    {
        Record::where('id', $request->id)->delete();
        return redirect()->route('record');
    }
}
