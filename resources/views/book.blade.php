@extends('layouts.header')

@section('main_content')
    <div class="container bg-light text-black-50 p-3 rounded">
        <div class="row">
            <div class="col-md-8">
                <h3 class="font-weight-bold">Title:</h3>
                <h3 class="font-italic">{{$book->title}}</h3>
                <h3 class="font-weight-bold">Author:</h3>
                <h3 class="font-italic">{{$book->author}}</h3>
                <h3 class="font-weight-bold">Description:</h3>
                <h4 style="word-wrap:break-word";>{{$book->book_description}}</h4>
                <h3 class="font-weight-bold">Count in organization:</h3>
                <h4>{{$book->count_in_organization}}</h4>
                @if(Auth::user()->role === 'admin')
                <h3>Add book</h3>
                <form method="Post" class="form-inline my-2 my-lg-0" action={{"/library/book/".$book->id."/addbook"}}>
                    @CSRF
                    <div class="form-group">
                        <input class="form-control mr-sm-2" type="text" name="count_for_add" id="count_for_add"
                               placeholder="Count for add">
                        <button class="btn btn-success my-2 my-sm-0" type="submit">Add</button>
                    </div>
                </form>
                <h3>Delete Book</h3>
                <form method="Post" class="form-inline my-2 my-lg-0" action={{"/library/book/".$book->id."/deletebook"}}>
                    @CSRF
                    <div class="form-group">
                        <input class="form-control mr-sm-2" type="text" name="count_for_delete" id="count_for_delete"
                               placeholder="Count for delete">
                        <button class="btn btn-danger my-2 my-sm-0" type="submit">Delete</button>
                    </div>
                </form>
                @else
                    <br>
                    <a href="{{"/library/takebook/".$book->id}}"><button type="button" class="btn btn-success pl-5 pr-5 text-center">Take book</button></a>
                @endif
            </div>

            <div class="col-md-4 p-5">
                <img width="300" height="400" src="{{$book->book_image}}">
            </div>
            <br><br>
        </div>
    </div>
@endsection
