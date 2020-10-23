@extends('header')

@section('title')Взятые книги@endsection

@section('main_content')
    <h1>Форма добавления записи</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/allogs/check">
        @csrf
        <input type="text" name="book" id="book" placeholder="Введите название книги" class="form-control"><br>
        <input type="text" name="first_name" id="first_name" placeholder="Введите имя того читателя, кто взял книгу" class="form-control"><br>
        <input type="text" name="last_name" id="last_name" placeholder="Введите фамилию того читателя, кто взял книгу" class="form-control"><br>
        <input type="date" name="dateOfTake" id="takeDate"  placeholder="Дата"></input><br>
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>
    <br>
    <h1>Взятые книжки</h1>
    @foreach($record as $el)
        <div class="alert alert-warning">
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
    @endforeach
@endsection
