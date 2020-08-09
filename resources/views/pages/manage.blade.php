@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Waiting For Approval</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Manage Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">Deleted Posts</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <h3>These posts need your approval</h3>
            <div class="row">
                <div class="col-md-12">
                    @if (count($posts))
                    @foreach ($posts as $post)
                    <div class="col-md-12 mt-3">
                        <div class="card post_card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="/post/{{$post->pid}}"> <img class="img-thumbnail"
                                                src="https://i.imgur.com/9wnioj4.jpg"></a>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title"><a href="/post/{{$post->pid}}">{{$post->title}}</a></h5>
                                        <h6 class="mt-2">Author: {{$post->name}}</h6>
                                        {{-- <p class="card-text">{{!! $post->shortdesc !!}}</p> --}}
                                        <span class="topic"><b><small>{{$post->subject}}</small></b></span>&nbsp;
                                        <span class="separator">•</span>
                                        <span><small>{{$post->updated_at->format('d M, Y')}}</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- {{$posts->setPageName('postPage')}} --}}
                    {{-- {{$posts->appends(array_except(Request::query(), 'postPage'))->links()}} --}}
                    {{-- {{$posts->appends('userPage', Request::get('userPage',1))->links()}} --}}
                    <div class="row mt-5 ml-2">
                        <div class="col-md-10">
                            {{$posts->links()}}
                        </div>
                    </div>
                    
                    {{-- {{$posts->appends(Request::except('token'))->links()}} --}}
                    @endif
                </div>
            </div>
        </div>
        <div id="menu1" class="container tab-pane fade"><br>
            <h3>Manage Users</h3>
            {{-- <div class="row">
                <div class="col-md-12">
                    @if(count($users) > 0)
                    @foreach ($users as $user)
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header"><a href="/user/{{$user->id}}"> {{$user->name}} </a></div>
                            <div class="card-body">{{$user->role}}</div>
                            <div class="card-footer">Joined On: {{$user->created_at->format('d M, y')}}</div>
                        </div>
                    </div>
                    @endforeach
                    {{$users->appends('userPage', Request::get('userPage',1))->links()}}
                    @endif
                </div>
            </div> --}}
        </div>
        <div id="menu2" class="container tab-pane fade"><br>
            <h3>Menu 2</h3>
            {{-- <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
                rem aperiam.</p> --}}
        </div>
    </div>
</div>
@endsection