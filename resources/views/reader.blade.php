@extends('layouts.header')

@section('main_content')
    <div class="container">
        <h1>All Reader</h1>
        <br>
        <h3>Search By Surname</h3>
        <form method="Post" class="form-inline my-2 my-lg-0" action={{"/readers/surnameFilter"}}>
            @CSRF
            <div class="form-group">
                <input class="form-control mr-sm-2" type="text" name="surname" id="surname"
                       placeholder="Surname for search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </div>
        </form>
        <br>
        <h3>Search By Email</h3>
        <form method="Post" class="form-inline my-2 my-lg-0" action={{"/readers/emailFilter"}}>
            @CSRF
            <div class="form-group">
                <input class="form-control mr-sm-2" type="text" name="email" id="email"
                       placeholder="Surname for search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </div>
        </form>
        <br><br>
    </div>
    <div class="container">
        <h1>Table of all readers in your organization</h1>
        <div class=" text-black-50">
            @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
                <table class="table table-light rounded">
                    <thead class="thead-dark">
                    <tr>
                        <th style="text-align:center">Name</th>
                        <th style="text-align:center">Surname</th>
                        <th style="text-align:center">Email</th>
                        <th style="text-align:center">Role</th>
                    </tr>
                    </thead>
                    @foreach($reader as $element)
                        <tr>
                            <td style="text-align:center">{{$element->first_name}}</td>
                            <td style="text-align:center">{{$element->last_name}}</td>
                            <td style="text-align:center">{{$element->email}}</td>
                            <td style="text-align:center">{{$element->role}}</td>
                        </tr>
                    @endforeach
                </table>
        </div>
    @endif
@endsection
