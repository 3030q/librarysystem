@extends('layouts.header')

@section('main_content')
    <h1>Taken Book</h1>
    @foreach(\App\Models\Record::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('date_returned',null)->get()->chunk(3) as $element)
        <div class="row text-black-50">
            @foreach($element as $e)
                <div class="col-md-4">
                    @php($book = \App\Models\Book::where('id', $e->book_id)->first())
                    <div class="card mx-auto" style="width: 18rem;">
                        <img class="card-img-top" width="350" height="300" src="{{$book->book_image}}"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold font-italic">{{$book->title}}</h5>
                            <h5>Author:</h5>
                            <h5 class="card-text">{{$book->author}}</h5>
                            <h5>Book description:</h5>
                            <p class="card-text">{{mb_strimwidth($book->book_description,0,40).'...'}}</p>
                            <h5>Date of take</h5>
                            <h5 class="card-text font-weight-bold">{{$e->date_take}}</h5>
                            <h5>Date of returned</h5>
                            <h5 class="card-text font-weight-bold">
                                @if($e->date_returned == null)
                                    {{"Not returned"}}
                                @else
                                    {{$e->date_returned}}
                                @endif
                            </h5>
                            <a href="{{"/library/book/".$e->id}}" class="btn btn-primary">Go to Book</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <br><br>
    @endforeach
@endsection
