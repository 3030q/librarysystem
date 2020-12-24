<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class LibraryController extends Controller
{
    public function libraryView()
    {
        $foo = QueryBuilder::for(Book::query()->where('organization_id', Auth::user()->organization_id))->allowedFilters(['title', 'author'])->get();
        return view('library', ['books' => $foo]);
    }

    public function addToLibrary(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
            'pub_date' => ['required', 'min:8'],
            'count_in_organization' => ['required'],
            'description' => ['required'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);
        $variable = Book::query()->where('organization_id', (Auth::user()->organization_id))
            ->where('title', ($request->title))
            ->first('count_in_organization');
        if ($variable != null) {
            Book::where('organization_id', (Auth::user()->organization_id))
                ->where('title', ($request->title))
                ->update(['count_in_organization' => ($variable['count_in_organization'] + $request->count_in_organization)]);
        } else {
            $book = new Book();
            $book->organization_id = Auth::user()->organization_id;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $nameImg = $request->title . $image->getClientOriginalName();
                $image->move(public_path('/uploads'), $nameImg);
                $book->book_image = '/uploads/' . $nameImg;
            }
            $book->book_description = $request->description;
            $book->title = $request->title;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->pub_date = $request->pub_date;
            $book->count_in_organization = $request->count_in_organization;
            $book->save();
        }

        return redirect()->route('library');
    }

    public function takeBook($id){
        $book = Book::where('id', $id)->firstOrFail();
        return view('book',['book'=>$book]);
    }

    public function libraryTitleFilter(Request $request)
    {
        $request->validate(['title' => ['max:255']]);
        return redirect("/library?filter[title]=".$request->title);
    }

    public function libraryAuthorFilter(Request $request)
    {
        $request->validate(['author' => ['max:255']]);
        return redirect("/library?filter[author]=" . $request->author);
    }

    public function deleteBook(Request $request, $bookId)
    {
        $request->validate([
            'count_for_delete' => ['required', 'int']
        ]);
        $var = Book::where('id', $bookId)->firstOrFail('count_in_organization');
        if ($var['count_in_organization'] > $request->count_for_delete) {
            Book::where('id', $bookId)
                ->update(['count_in_organization' => $var['count_in_organization'] - $request->count_for_delete]);
            return redirect('/library/book/'.$bookId);
        } else {
            Book::where('id', $bookId)->delete();
        }
        return redirect('/library');
    }

    public function addBook(Request $request, $bookId)
    {
        $request->validate([
            'count_for_add' => ['required', 'int']
        ]);
        $var = Book::where('id', $bookId)->firstOrFail('count_in_organization');
            Book::where('id', $bookId)
                ->update(['count_in_organization' => $var['count_in_organization'] + $request->count_for_add]);
            return redirect('/library/book/' . $bookId);
    }
}
