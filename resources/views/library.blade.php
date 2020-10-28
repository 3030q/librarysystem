@extends('layouts.header')

@section('main_content')

    <h1>Add book to library</h1>

    <form method="POST" action="/library/add">
        @csrf
        <input type="text" name="title" id="title" placeholder="Title of the book" class="form-control"><br>
        <input type="text" name="author" id="author" placeholder="Author" class="form-control"><br>
        <input type="text" name="publisher" id="publisher" placeholder="Publisher" class="form-control"><br>
        <label for="pub_date"> Pub date </label>
        <input type="date" name="pub_date" id="pub_date"  placeholder="Pub date"><br>
        <label for="count_in_organization"> Count </label>
        <input type="text" name="count_in_organization" id="count_in_organization"><br>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
    <br>
    <br>
    <h1>Delete book from library</h1>
    <form method="post" action="/library/deletebook">
        @csrf
        <input type="text" name="titlefordelete" id="titlefordelete" placeholder="Name of delete book">
        <input type="text" name="count_for_delete" id="count_for_delete" placeholder="Count for delete">
        <button type="submit" class="badge-danger">
            Remove
        </button>
    </form>
    <br>
    <br>
    <br>
    <h1>Table of all books in library</h1>
    <div class=" text-black-50">
    <table bgcolor="#ffebcd" border="1">
        <tr>
            <th style="text-align:center">Title</th>
            <th style="text-align:center">Author</th>
            <th style="text-align:center">Publisher</th>
            <th style="text-align:center">Pub Date</th>
            <th style="text-align:center">Count in Library</th>
        </tr>
    @foreach(\App\Models\Book::where('organization_id',Auth::user()->organization_id)->get() as $element)
        <tr>
            <th style="text-align:center">{{$element->title}}</th>
            <th style="text-align:center">{{$element->author}}</th>
            <th style="text-align:center">{{$element->publisher}}</th>
            <th style="text-align:center">{{$element->pub_date}}</th>
            <th style="text-align:center">{{$element->count_in_organization}}</th>
        </tr>

    @endforeach
    </table>
    </div>

    {{--<h1>Взятые книжки</h1>
    @foreach($record as $el)

        <h3>{{ $el->book}}</h3>
        <b>{{ $el->last_name}}</b>
        <p>{{ $el->first_name}}</p>
        <h3>Дата выдачи</h3>
        <p>{{ $el->dateOfTake}}</p>
        <form method="post" action="/allogs/takeDateReturn?id={{$el->id}}">
            @csrf
            <input type="date" name="returned_at" id="returned_at" class="">
            <button type="submit" class="btn btn-danger">Вернуть книгу</button>
        </form>
        <form method="post" action="/allogs/delete?id={{$el->id}}">
            @csrf
            <button type="submit" class="btn btn-danger">Удалить в БД</button>
        </form>
        @if($el->returned_at != null)
            <h3>Дата возврата</h3>
            <p>{{ $el->returned_at}}</p>
            @endif

            </div>
            @endforeach--}}
@endsection
