<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostDetails;
use Exception;
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

    public function getPost($pid)
    {
        try {
            $post = DB::select(config('query.getpost'), ['PID' => $pid, 'APPRV' => 1, 'DEL' => 0]);
            if (count($post) == 0) {
                return redirect()->back()->with('error', 'Invaid post');
             }
            // return $post;
            return view('pages.postview')->with('post', $post[0]);
        } catch (Exception $e) {
            Log::error('CommonController->' . $e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
