@extends('layouts.header')

@section('main_content')

    <h1>Table of all readers in your organization</h1>
    <div class=" text-black-50">
        @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
        <table bgcolor="#ffebcd" border="1">
            <tr>
                <th style="text-align:center">Name</th>
                <th style="text-align:center">Surname</th>
                <th style="text-align:center">Email</th>
                <th style="text-align:center">Phone number</th>
                <th style="text-align:center">Role</th>
            </tr>
            @foreach(\App\Models\User::where('organization_id',Auth::user()->organization_id)->get() as $element)
                <tr>
                    <th style="text-align:center">{{$element->first_name}}</th>
                    <th style="text-align:center">{{$element->last_name}}</th>
                    <th style="text-align:center">{{$element->email}}</th>
                    <th style="text-align:center">{{$element->phone_number}}</th>
                    <th style="text-align:center">{{$element->role}}</th>
                </tr>

            @endforeach
        </table>
    @endif
@endsection
