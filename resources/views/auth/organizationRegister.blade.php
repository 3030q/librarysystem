@extends('layouts.header')

@section('main_content')
    <div class="container text-black">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-black-50">
                <div class="card-header">{{ __('Register Your Organizations') }}</div>
                <div class="card-body text-black-50">
                    <form method="POST" action="/confirmorg">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name OrganizaZtion') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                 </span>
                                @enderror
                            </div>
                        </div>

                       {{-- <div class="form-group row">
                            <label for="key" class="col-md-4 col-form-label text-md-right">{{ __('Input Key') }}</label>

                            <div class="col-md-6">
                                <input id="key" type="password" class="form-control @error('key') is-invalid @enderror" name="key" required autocomplete="key">

                                @error('key')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="key-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Key') }}</label>
                            <div class="col-md-6">
                                <input id="key-confirm" type="password" class="form-control" name="key-confirm" required autocomplete="key">
                            </div>
                        </div>--}}


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
