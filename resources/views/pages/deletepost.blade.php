@extends('layouts.app')

@section('content')
<div class="container-fluid mb-4 postcontent">
    <div class="row">
        <div class="col-md-12">
            <label>Are your sure you want to delete this post? </label>
            <form method="POST" action="{{route('post.destroy', $post->pid)}}">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" value="Yes" class="btn btn-danger">
                <a href="#" class="btn btn-primary">Go Back</a>
            </form>
        </div>
    </div>
</div>
@endsection