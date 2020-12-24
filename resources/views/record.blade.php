@extends('layouts.header')

@section('main_content')
    @if(Auth::user()->role === 'admin')

        <div class="container">
            <h2>Search By Record Number</h2><br>
            <form method="Post" class="form-inline my-2 my-lg-0" action={{"/records/idfilter"}}>
                @CSRF
                <div class="form-group">
                    <input class="form-control mr-sm-2" type="text" name="id" id="id"
                           placeholder="Record № for search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                </div>
            </form>
            <br>
            <h2>Filter Record</h2>
            <div class="container">
                <div class="row">
                    <a href="/records"><button type="button" class="btn btn-dark mt-3 ml-0 ">Show all</button></a>
                    <a href="/records?filter[not_returned]=false"><button type="button" class="btn btn-dark mt-3 ml-2 ">Show non-active record</button></a>
                    <br>
                    <a href="/records?filter[not_returned]=true"><button type="button" class="btn btn-dark mt-3 ml-2 ">Show active record</button></a>
                </div>
            </div>
            <br>
            <h1>Table of record</h1>
            <div class=" text-black-50">
                @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
                    <table class="table table-light rounded">
                        <thead class="thead-dark">
                        <tr>
                            <th style="text-align:center">#</th>
                            <th style="text-align:center">User surname</th>
                            <th style="text-align:center">Book title</th>
                            <th style="text-align:center">Date of take</th>
                            <th style="text-align:center">Date of returned</th>
                        </tr>
                        </thead>
                        @foreach($record as $element)
                            <tr>
                                <td style="text-align:center">{{$element->id}}</td>
                                <td style="text-align:center">{{\App\Models\User::query()->where('id',$element->user_id)->firstOrFail('last_name')['last_name']}}</td>
                                <td style="text-align:center">{{\App\Models\Book::query()->where('id', $element->book_id)->firstOrFail('title')['title']}}</td>
                                <td style="text-align:center">{{$element->date_take}}</td>
                                <td style="text-align:center" class="align-items-center">
                                    @if($element->date_returned == null)
                                        <a methods="POSTS" href={{"/records/return/".$element->id}}><button type="button" class="btn btn-dark pr-3 pl-3 pb-0 pt-0">Return</button></a>
                                    @else
                                        {{$element->date_returned}}
                                    @endif</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
    @endif




@endsection
