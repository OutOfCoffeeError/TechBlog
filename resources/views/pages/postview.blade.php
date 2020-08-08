@extends('layouts.app')

@section('content')

@include('inc.popup', ['data' => ['header' => 'Delete Post', 'text' => 'Are you sure you want to delete the post?',
'formmethod'=> 'DELETE',
'type' => 1, 'button'=>['route'=>'post.destroy', 'text'=>'Yes', 'req' => $post->pid]]])
<div class="container-fluid mb-4 postcontent">
    @auth
    @if (Auth::user()->id == $post->author)
    <div class="row">
        <div class="col-md-12">
            <span class="float-right mt-2 settings dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-gears"></i>Settings </span>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/post/{{$post->pid}}/edit"><i class="fa fa-cog"
                        style="color: steelblue"></i> Edit</a>
                {{-- <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="/togglevisible/{{$post->pid}}/{{$post->author}}"><i class="fa fa-eye-slash"></i>
                    
                    @if ($post->visible == config('constants.is_visible.visible'))
                        Hide
                    @else
                        Unhide
                    @endif 
                </a>
                <a class="dropdown-item" href="/" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"
                        style="color: red"></i> Delete</a>
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