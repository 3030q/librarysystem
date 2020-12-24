@extends('layouts.header')

@section('main_content')

    @if(Auth::user()->role === 'admin')
        <h1>Add book to library</h1>
        <div class="container bg-light p-3 text-black-50 rounded">
            <form method="POST" action="/library/addbook" enctype="multipart/form-data">
                @CSRF
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Title</label>
                        <input type="text" name="title" id="title" placeholder="Title of the book" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Author</label>
                        <input type="text" name="author" id="author" placeholder="Author" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description Book</label>
                    <textarea class="form-control" name="description" id="description" rows="3"
                              placeholder="Description"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPublisher">Publisher</label>
                        <input type="text" name="publisher" id="publisher" placeholder="Publisher" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPubDate">Count in organization</label>
                        <input type="text" name="count_in_organization" id="count_in_organization" class="form-control"
                               placeholder="Count">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputState">Pub date</label>
                        <input type="date" name="pub_date" id="pub_date" placeholder="Pub date"
                               class="form-control"><br>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Image Book</label>
                        <input type="file" name="image" id="image">
                    </div>
                </div>

                <br><br>
                <button type="submit" class="btn btn-success">Add to library</button>
            </form>
        </div>
        <br>
        <br>
        <br>
    @endif
    <h1>Search on Library</h1>
    <label for="search">Search by title</label>
    <form method="Post" class="form-inline my-2 my-lg-0" action="/library/libraryTitleFilter">
        @CSRF
        <div class="form-group">
            <input class="form-control mr-sm-2" type="text" name="title" id="title" placeholder="Title">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </div>
    </form>
    <br><br>
    <label for="search">Search by author</label>
    <form method="Post" class="form-inline my-2 my-lg-0" action="/library/libraryAuthorFilter">
        @CSRF
        <div class="form-group">
            <input class="form-control mr-sm-2" type="text" name="author" id="author" placeholder="Author">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </div>
    </form>
    <br>
    <br>
    <br>
    <div class="text-black-50">
        <br><br><br>
        @foreach($books->chunk(3) as $element)
            <div class="row">
                @foreach($element as $e)
                    <div class="col-md-4">
                        <div class="card mx-auto" style="width: 18rem;">
                            <img class="card-img-top" width="350" height="300" src="{{$e->book_image}}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold font-italic">{{$e->title}}</h5>
                                <h5>Author:</h5>
                                <h5 class="card-text">{{$e->author}}</h5>
                                <h5>Book description:</h5>
                                <p class="card-text">{{mb_strimwidth($e->book_description,0,40).'...'}}</p>
                                <h5>Count in organization</h5>
                                <h5 class="card-text font-weight-bold">{{$e->count_in_organization}}</h5>
                                <a href="{{"/library/book/".$e->id}}" class="btn btn-primary">Go to Book</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <br><br>
        @endforeach
        <table class="table table-light">
            <tr>
                <th style="text-align:center">Title</th>
                <th style="text-align:center">Author</th>
                <th style="text-align:center">Publisher</th>
                <th style="text-align:center">Pub Date</th>
                <th style="text-align:center">Count in Library</th>
            </tr>
            @foreach(\App\Models\Book::where('organization_id',Auth::user()->organization_id)->get() as $element)
                <tr>
                    <td style="text-align:center">{{$element->title}}</td>
                    <td style="text-align:center">{{$element->author}}</td>
                    <td style="text-align:center">{{$element->publisher}}</td>
                    <td style="text-align:center">{{$element->pub_date}}</td>
                    <td style="text-align:center">{{$element->count_in_organization}}</td>
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
