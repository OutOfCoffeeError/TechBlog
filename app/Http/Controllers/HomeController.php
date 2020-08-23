<?php

namespace App\Http\Controllers;

use App\PostDetails;
use App\PostMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PostDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkXSS');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = DB::select(config('query.posts_by_user'), ['AUTHOR' => Auth::user()->id, 'DELETED' => config('constants.is_deleted.not_deleted')]);
        // return $posts;
        // error_log('Some message here.');
        return view('home')->with('posts', $posts);
    }
}
