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
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class=" foregrnd">
                <div class="row justify-content-center pt-5 pb-5">
                    @if (count($posts) > 0)
                    @foreach ($posts as $post)
                    <div class="col-md-8 mt-3">
                        <div class="card">

                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                                {{$post->title}}
                            </div>
                            <div class="card-footer bg-dark text-white">{{$post->created_at}}</div>
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