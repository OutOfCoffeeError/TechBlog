<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->

</head>

<body>
    @extends('layouts.app')
    @section('content')
    <div class="content">
        <div class=" m-b-md">
            <div class="container-fluid">
                <div class="row">
                    <div class="welcome-img col-md-12">
                        <img src="{{asset('img/wlcm-bg-2.jpg')}}" alt="noimg" height="400">
                        <div class="overlay">
                            <div class="overlay-content container">
                                <div class="row">
                                    <div class="overlay-text">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h1 class="overlay-txt-1"> Oh, Hey You! </h1>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="col-md-12">
                                                <p style="font-size: 2vw; float: left">Welcome to the blog</p>
                                            </div>
                                        </div> --}}
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-8 overlay-txt-2">
                                                <p style="">Welcome to the blog. I see you have some skills you want to
                                                    exhibit, Why not share it with everyone?</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <form>
                                                <button class="btn btn-get-started"
                                                    formaction="{{ route('register') }}"> Get Started</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h2>Featured Articles</h2>
            {{-- <p>Image at the top (card-img-top):</p> --}}
            <div class="row">
                @if (count($posts) > 0)
                @foreach ($posts as $post)
                <div class="col-md-4 mt-3">
                    <div class="card pl-2 pr-2 h-100 featured-cards">
                        <img class="card-img-top" src="/img/featured2.jpg" alt="Card image" style="width:100%">
                        <div class="card-body d-flex flex-column ">
                            <h4 class="card-title">{{$post->title}}</h4>
                            <p class="card-text">Some example text some example text. John Doe is an architect and
                                engineer
                            </p>
                            <a href="#" class="btn btn-primary mt-auto">Learn More  <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    @endsection
</body>

</html>