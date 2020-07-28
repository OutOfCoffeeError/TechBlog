@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <div class="row">
            <div class="post-form col-md-12 col-xs-12">
                <h4> Create new post </h4>
                <form method="POST" action="{{route('post.store')}}">
                    <div class="form-group">
                        <label for="title">Subject:</label>
                        <input type="text" class="form-control" name="subject" placeholder="Java, WebAssembly etc." />
                    </div>
                    <div class="form-group">
                        @csrf
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" />
                    </div>
                    <div class="form-group">
                        <label for="body">Content:</label> 
                        <textarea rows="6" cols="6"  class="form-control" id="ckcontentbody" name="ckcontentbody" placeholder="Content"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags:</label>
                        <input type="text" class="form-control" name="tags" placeholder="eg. Java, Cloud, Blockchain">
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection