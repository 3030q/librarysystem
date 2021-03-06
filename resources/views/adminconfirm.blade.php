@extends('layouts.header')

@section('main_content')

    <div class="container text-black">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-black-50">
                    <div class="card-header">{{ __('Register Your Organizations') }}</div>
                    <div class="card-body text-black-50">
                        <form method="POST" action="/adminconfirmreq">
                            @csrf
                            <div class="form-group row">
                                <label for="admin_password" class="col-md-4 col-form-label text-md-right">{{ __('Admin Password*') }}</label>

                                <div class="col-md-6">
                                    <input id="admin_password" type="password" class="form-control @error('admin_password') is-invalid @enderror" name="admin_password" required autocomplete="admin_password">

                                    @error('admin_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
