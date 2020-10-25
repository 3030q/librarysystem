@extends('layouts.header')

@section('title')Главная страница@endsection

@section('main_content')
    <main role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="btn btn-info">
            <div class="container">
                <span class="display-3">Librasystem is powerfull service for library!</span>
                <p>Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Aspernatur at commodi ea
                    impedit itaque labore perspiciatis provident
                    quasi reiciendis voluptatibus. Aut eius eum
                    nam nisi nobis provident quas sint, voluptatem.
                </p>
                <p><a class="btn btn-success" href="/registerorganization" role="button">Register Organization»</a></p>
            </div>
        </div>

    </main>

@endsection
