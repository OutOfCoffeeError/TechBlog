<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostDetails;


class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = PostDetails::all();
        return view('welcome')->with('posts', $post);
    }
}
