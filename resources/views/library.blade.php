@extends('layouts.header')

@section('main_content')

    <h1>Add book to library</h1>

    <form method="POST" action="/addbook">
        @csrf
        <input type="text" name="title" id="title" placeholder="Title of the book" class="form-control"><br>
        <input type="text" name="author" id="author" placeholder="Author" class="form-control"><br>
        <input type="text" name="publisher" id="publisher" placeholder="Publisher" class="form-control"><br>
        <label for="pub_date"> Pub date </label>
        <input type="date" name="pub_date" id="pub_date"  placeholder="Pub date"><br>
        <label for="count_in_organization"> Count </label>
        <input type="text" name="count_in_organization" id="count_in_organization"><br>
        <button type="submit" class="btn btn-success">submit</button>
    </form>
    <br>
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
