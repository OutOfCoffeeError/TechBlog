<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostDetails;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $post = PostDetails::all();
        $posts = DB::select(config('query.public_posts'));
        // return $posts;
        // error_log('Some message here.');
        return view('welcome')->with('posts', $posts);
    }
}
