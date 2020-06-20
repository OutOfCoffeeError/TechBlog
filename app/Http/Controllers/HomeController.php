<?php

namespace App\Http\Controllers;

use App\PostDetails;
use App\PostMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = DB::select('select a.* from post_detail a, post_master b where a.pid = b.pid and b.author = ? ', [Auth::user()->id]);
        // return $posts;
        return view('home')->with('posts', $posts);
    }
}
