<?php

namespace App\Http\Controllers;

use App\Models\libraryModel;
use App\Models\OhShitItsBrokeModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
       return view('homesus');
    }



/*    public function logs(){
       $allLogs=OhShitItsBrokeModel::all();
       var_dump($allLogs);
           $record = new OhShitItsBrokeModel();
       $record->name = 'C';
       $record->save();*/



    public function allogs() {
        $record = new OhShitItsBrokeModel();
        return view('reviews', ['record' => $record->all()]);
    }


    public function allogs_check(Request $request){
        $valid = $request->validate([
            'book'=>'required|min:2|max:45',
            'first_name'=>'required|min:2|max:45',
            'last_name'=>'required|min:2|max:45'
        ]);
        $record = new OhShitItsBrokeModel();
        $record->book = $request->input('book');
        $record->first_name = $request->input('first_name');
        $record->last_name = $request->input('last_name');
        $record->dateOfTake = $request->input('dateOfTake');
        $record->save();

        return redirect()->route('logs');

    }


    public function takeDateReturn(Request $request){
        $valid = $request->validate([
            'returned_at'=>'required'
        ]);
        $record =OhShitItsBrokeModel::query()->where('id', $request->id)->firstOrFail();
        $record->returned_at = $request->returned_at;
        $record->save();

        return redirect()->route('logs');
    }


    public function delete(Request $request){
        $record =OhShitItsBrokeModel::query()->where('id', $request->id)->delete();
        return redirect()->route('logs');
    }
}
