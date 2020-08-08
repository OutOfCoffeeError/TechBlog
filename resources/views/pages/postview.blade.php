@extends('layouts.app')

@section('content')

<div class="container-fluid mb-4 postcontent">
    @auth
    @if (Auth::user()->id == $post->author)
    <div class="row">
        <div class="col-md-12">
            <span class="float-right mt-2 settings dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-gears"></i>
                Settings </span>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/post/{{$post->pid}}/edit"><i class="fa fa-cog"
                        style="color: steelblue"></i> Edit</a>
                {{-- <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="#"><i class="fa fa-eye-slash"></i> Hide/Unhide</a>
                <a class="dropdown-item" href="/"><i class="fa fa-trash" style="color: red"></i> Delete</a>
            </div>
        </div>
    </div>
    @endif
    @endauth
    <div class="row">

        <div class="col-md-12 mt-4">
            <div class="col-md-8 mx-auto col-sm-12 col-xs-12">
                <h1> {{$post->title}} </h1>
                <small>
                    <p style="color: gray">{{date('d M, Y', strtotime($post->created_at))}}
                        <span class="separator">&nbsp; • &nbsp;</span>
                        {{$post->read_time}} min read</p>
                </small>
                <small>
                    <p style="color: gray">Updated: {{$post->updated_at}}
                </small>
                <p> {!! $post->content !!} </p>
            </div>
        </div>
    </div>
</div>
@endsection