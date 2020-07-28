@extends('layouts.app')

@section('content')
{{-- <head>
    <style>
        div {
            border: 1px solid rgb(67, 79, 255);
        }
    </style>
</head> --}}

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="profile foregrnd">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{asset('img/profile.jpg')}}" class="rounded-circle avatar" alt="noimg" width="60"
                            height="60">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <span> {{ Auth::user()->name }} </span>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <hr class="profile_sep">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 profile_desc">
                        <div class="col-md-12 text-center" style="line-height: 80%">
                            <span><small>About user</small></span>
                        </div>
                        <div class="col-md-12 mt-2">
                            <small><span>Joined On</span>:<span style="float: right">
                                    {{ Auth::user()->created_at->format('d M, Y') }} </span></small>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                    <hr class="profile_sep">
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 text-center" style="line-height: 100%">
                        <div><span class="h3"><b> {{count($posts) }}</b> </span></div>
                        <p> Posts </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="foregrnd">
                {{-- <div class="jumbotron welcometxt">
                    <h1>Welcome, {{ Auth::user()->name }}</h1> --}}
                {{-- Make the below text dynamic and add more creative phrases in DB --}}
                {{-- <p>Here you can see the catalogue of your posts and ideas. Be sure to share more them with us.</p>
                </div> --}}
                <div class="row justify-content-center pt-5 pb-5">
                    @if (count($posts) > 0)
                    @foreach ($posts as $post)
                    <div class="col-md-10 mt-3">
                        <div class="card post_card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="/post/{{$post->pid}}"> <img class="img-thumbnail"
                                                src="https://i.imgur.com/9wnioj4.jpg"></a>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title"><a href="/post/{{$post->pid}}">{{$post->title}}</a></h5>
                                        {{-- <p class="card-text">{{!! $post->shortdesc !!}}</p> --}}
                                        <span class="topic">{{$post->subject}}</span>&nbsp;
                                        <span class="separator">⁍</span>
                                        <span><small><em>{{$post->created_at}}</em></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div>
                Other things
            </div>
        </div>
    </div>
</div>

@endsection