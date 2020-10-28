@extends('layouts.header')

@section('main_content')
    @if(Auth::user()->role === 'admin')
    <h1>Все записи</h1>
    @foreach(\App\Models\Record::where('organization_id', Auth::user()->organization_id)->get() as $element)
        <div class="alert alert-warning">
            <h2>Title of book</h2>
            <h3>{{\App\Models\Book::where('id', $element->book_id)->first('title')['title']}}</h3>
            <h2>Date of take</h2>
            <h3>{{$element->date_take}}</h3>
            @if($element->date_returned === null)
            <form method="post" action="/records/returnbook?id={{$element->id}}">
                @csrf
                <input type="date" name="date_returned" id="date_returned" >
                <button type="submit" class="btn btn-danger">Returned book</button>
            </form>
            @else
                <h3>Дата возврата</h3>
                <p>{{ $element->date_returned}}</p>
            @endif
            <form method="post" action="/records/delete?id={{$element->id}}">
                @csrf
                <button type="submit" class="btn btn-danger">Delete record</button>
            </form>
        </div>
        {{--<b>{{ $el->last_name}}</b>
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
        @endif--}}
    @endforeach
    @else
        <h1>Взять книгу</h1>
        <form method="post" action="/records/addrecord">
        @csrf
        <input type="text" name="book" id="book" placeholder="Введите название книги" class="form-control"><br>
        <input type="date" name="date_take" id="date_take"  placeholder="Дата"><br>
        <button type="submit" class="btn btn-success">Отправить</button>
        </form>
        <br>
        <br>
        <br>
        <h1>Взятые книги</h1>
        @foreach(\App\Models\Record::where('user_id', Auth::user()->id)->get() as $element)
        <div class="alert alert-warning">
            <h2>Title of book</h2>
            <h3>{{\App\Models\Book::where('id', $element->book_id)->first('title')['title']}}</h3>
            <h2>Date of take</h2>
            <h3>{{$element->date_take}}</h3>

            @if($element->date_returned != null)
                <h3>Дата возврата</h3>
                <p>{{ $element->date_returned}}</p>
            @endif
        </div>
        @endforeach
    @endif




@endsection