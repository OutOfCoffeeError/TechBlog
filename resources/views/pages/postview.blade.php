@extends('layouts.app')

@section('content')

<div class="container-fluid mb-4 postcontent">
    <div class="row">
        <div class="col-md-12 foregrnd">
            <span class="float-right mt-2 settings dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-gears"></i> Settings </span>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/post/{{$post->pid}}/edit"><i class="fa fa-cog" style="color: steelblue"></i> Edit</a>
                {{-- <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="#"><i class="fa fa-eye-slash"></i> Hide</a>
                <a class="dropdown-item" href="/"><i class="fa fa-trash" style="color: red"></i> Delete</a>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12 foregrnd">
            <div class="col-md-8 mx-auto col-sm-12 col-xs-12">
                <h1> {{$post->title}} </h1>
                <small>
                    <p>Created On: {{$post->created_at}}</p>
                    </small>
                    <span>
                        <p>Edit On: {{$post->updated_at}}
                    </span>
                    <p style="font-size:10vw;"> {!! $post->content !!} </p>
            </div>
        </div>
    </div>
</div>
@endsection