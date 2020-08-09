@extends('layouts.app')

@section('content')

<div id="mySidenav" class="sidenav">
    <div class="profile foregrnd profile_sidnav">
        <div class="row">
            <div class="col-md-12">
                <span style="cursor: pointer" class="closebtn" onclick="closeNav()"><i
                        class="fa fa-times-circle"></i></span>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <img src="{{asset('img/profile.jpg')}}" class="rounded-circle avatar" alt="noimg" width="60"
                    height="60">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <span style=""> <b>{{ Auth::user()->name }}</b> </span>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <hr class="profile_sep">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 profile_desc">
                <div class="col-md-12 text-center" style="line-height: 80%;">
                    <span><small>About User</small></span>
                </div>
                <div class="col-md-12 text-center mt-2" style="line-height: 80%;">
                    <span><small>{{ Auth::user()->created_at->format('d M, Y') }}</small></span>
                </div>
                {{-- <div class="col-md-12 mt-2" style="text-align: left">
                    <small><span class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ml-2">Joined On</span><span class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{ Auth::user()->created_at->format('d M, Y') }} </span></small>
            </div> --}}
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <hr class="profile_sep">
    </div>
    <div class="row mt-2">
        <div class="col-md-12 text-center" style="line-height: 100%">
            <div><span class="h3"><b> {{count($posts) }}</b> </span></div>
            <p> <b>Posts</b> </p>
        </div>
    </div>
</div>
</div>
<div id="overlay-home"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-0 profsec">
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
                        <div class="col-md-12 text-center" style="line-height: 80%;">
                            <span><small>About User</small></span>
                        </div>
                        <div class="col-md-12 text-center mt-2" style="line-height: 80%;">
                            <span><small>{{ Auth::user()->created_at->format('d M, Y') }}</small></span>
                        </div>
                        {{-- <div class="col-md-12 mt-2" style="text-align: left">
                            <small><span class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ml-2">Joined On</span><span class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    {{ Auth::user()->created_at->format('d M, Y') }} </span></small>
                    </div> --}}
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
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12" id="post_sec">
        <div class="">
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
                                    <h5 class="card-title"><a href="/post/{{$post->pid}}"
                                            >{{$post->title}}</a></h5>
                                    {{-- <p class="card-text">{{!! $post->shortdesc !!}}</p> --}}
                                    <span class="topic"><b>{{$post->subject}}</b></span>&nbsp;
                                    <span class="separator">⁍</span>
                                    <span><small>{{$post->created_at}}</small></span>
                                    <h5 class="mt-2">
                                        @if ($post->visible == config('constants.is_visible.hidden'))
                                        <span title="hidden"><i class="fa fa-eye-slash"></i></span>
                                        @else
                                        <span title="public"><i class="fa fa-eye"></i></span>
                                        @endif
                                    </h5>
                                    <h5>
                                        @if ($post->approved == config('constants.is_approved.yes'))
                                        <span class="badge badge-primary">Approved</span>
                                        @else
                                        <span class="badge badge-danger">Waiting For Approval</span>
                                        @endif 
                                    </h5>
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
    {{-- <div class="col-md-2">
            <div>
                Other things
            </div>
        </div> --}}
</div>
</div>

@endsection