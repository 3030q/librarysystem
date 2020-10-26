@extends('layouts.header')


@section('main_content')
    <div class="alert alert-warning">
        <h2 class="text-center">Name:</h2>
        <h1 class="text-center font-weight-bold">{{Auth::user()->first_name}}</h1>
        <h2 class="text-center">Surname:</h2>
        <h1 class="text-center text-center font-weight-bold">{{Auth::user()->last_name}}</h1>
        <h2 class="text-center">Phone Number</h2>
        <h1 class="text-center font-weight-bold">{{Auth::user()->phone_number}}</h1>
        @if(Auth::user()->organization_id != null)
            <div>
                <h2 class="text-center">Organization name</h2>
                <h1 class="text-center font-weight-bold">
                    {{\App\Models\Organization::query()
                                                ->where('id', Auth::user()
                                                ->organization_id)->firstOrFail('name')['name']
                    }}
                </h1>
            </div>
        @endif
        <div class="font-size text-md-center te">
            <a href="/adminconfirm">You admin your organization?</a>
        </div>
    </div>

@endsection

