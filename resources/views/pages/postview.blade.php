@extends('layouts.app')

@section('content')

@include('inc.popup', ['data' => ['header' => 'Delete Post', 'text' => 'Are you sure you want to delete the post?',
'formmethod'=> 'DELETE',
'type' => 1, 'button'=>['route'=>'post.destroy', 'text'=>'Yes', 'req' => $post->pid]]])


{{-- Modal for rejecting posts --}}
<div class="modal fade" id="rejectModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Reject Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('admin.reject')}}" method="post">
                    <div class="form-group">
                        <label for="remark">Remark :</label>
                        @csrf
                        <textarea name="remark" class="form-control" id="remark" cols="50" rows="5"></textarea>
                        <input type="hidden" name="pid" value="{{$post->pid}}" />
                        <input type="submit" id="reject-form" style="display: none" />
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <label for="reject-form" class="btn btn-info" tabindex="0">Submit</label>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<div class="container-fluid mb-4 postcontent">
    @auth
    @if (Auth::user()->id == $post->author || Auth::user()->role == config('constants.user_roles.super_user'))
    <div class="row">
        <div class="col-md-12">
            <span class="float-right mt-2 settings dropdown-toggle" data-toggle="dropdown"> <i
                    class="fa fa-gears"></i>Settings </span>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/post/{{$post->pid}}/edit"><i class="fa fa-cog"
                        style="color: steelblue"></i> Edit</a>
                {{-- <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="/togglevisible/{{$post->pid}}/{{$post->author}}"><i
                        class="fa fa-eye-slash"></i>

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
        {{Auth::user()->role == config('constants.user_roles.super_user')}}
        <div class="col-md-12 mt-4">
            @if ((Auth::user()->role == config('constants.user_roles.superUser')
            || Auth::user()->role == config('constants.user_roles.admin'))
            && ($post->is_approved == config('constants.is_approved.no')))
            <div class="row">
                <div class="col-md-8 mx-auto col-sm-12 col-xs-12">
                    <div class="pull-right">
                        <form action="{{route('admin.approve')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$post->pid}}" name="pid">
                            <button type="submit" class="btn btn-outline-success"> Approve </button>
                            <a href="" class="btn btn-outline-danger ml-2" data-toggle="modal"
                                data-target="#rejectModal">Reject</a>
                        </form>
                    </div>

                </div>
            </div>
            @endif
            <div class="col-md-8 mx-auto col-sm-12 col-xs-12">
                <h1> {{$post->title}} </h1>
                <small>
                    <p style="color: gray">{{date('d M, Y', strtotime($post->created_at))}}
                        <span class="separator">&nbsp; • &nbsp;</span>
                        <i class="fa fa-clock-o"></i> {{$post->read_time}} min read</p>
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