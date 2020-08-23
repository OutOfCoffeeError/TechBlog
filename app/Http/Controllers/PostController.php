<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\PostDetails;
use App\PostMaster;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PostDetail;

class PostController extends Controller
{

    public function __construct(PostDetails $postDetails, PostMaster $postMaster)
    {
        $this->middleware('auth');
        $this->middleware('checkXSS');

        $this->postDetails = $postDetails;
        $this->postMaster = $postMaster;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $post = PostDetail::all();
        //  return view('welcome')->with('posts', $post);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.createpost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input
        $this->validate($request, [
            'subject' => 'required',
            'title' => 'required',
            'ckcontentbody' => 'required',
            'tags' => 'required'
        ]);

        // Initiate a database transaction
        DB::transaction(function ()  use ($request) {
            // $postMaster = new PostMaster();
            // $postDetail = new PostDetails();
            $postId = null;
            // Create an unique post id after checking it against database post entries
            while (true) {
                $postId = CommonHelper::generateB64Token(config('constants.post_id_length'));
                if (PostMaster::where('pid', '=', $postId)->count() == 0) {
                    break;
                }
            }

            //Save post data to post detail table
            $postContents = $request->input('ckcontentbody');
            error_log($postContents);
            error_log( filter_var ( $postContents, FILTER_SANITIZE_STRING));
            $readTime = $this->getReadTime($postContents);
            $this->postDetails->pid = $postId;
            $this->postDetails->title = $request->input('title');
            $this->postDetails->content = $postContents;
            $this->postDetails->tags = $request->input('tags');
            $this->postDetails->subject = $request->input('subject');
            $this->postDetails->read_time = $readTime;
            $this->postDetails->save();

            //Save post data to post master table
            $this->postMaster->pid = $postId;
            $this->postMaster->author = Auth::user()->id;
            $this->postMaster->visible = config('constants.is_visible.visible');
            $this->postMaster->deleted = config('constants.is_deleted.not_deleted');
            $this->postMaster->is_approved = config('constants.is_approved.no');
            $this->postMaster->save();
        });
        return redirect('home')->with('success', 'New Post Published. Wait For The Approval');
    }

    private function getReadTime(String $content)
    {
        return strlen(strip_tags($content)) / config('constants.read_time');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pid)
    {
        $post = DB::select(config('query.get_author_post'), [$pid]);
        if (count($post) == 0) {
            return redirect()->back()->with('error', 'Invalid Post');
        }
        if (Auth::user()->id != $post[0]->author 
            && ( Auth::user()->role != config('constants.user_roles.superUser') 
            && Auth::user()->role != config('constants.user_roles.admin'))) {
            return redirect()->back()->with('error', 'Invalid user');
        }
        // return $post;
        return view('pages.postview')->with('post', $post[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($pid)
    {
        $post = PostDetails::find($pid);
        return view('pages.postedit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'subject' => 'required',
            'title' => 'required',
            'ckcontentbody' => 'required',
            'tags' => 'required'
        ]);

        if(CommonHelper::checkXSS($request->input('ckcontentbody'))) {
            return redirect()->back()->with('error', 'Invalid Content');
        }
        // Initiate a database transaction
        DB::transaction(function ()  use ($request, $id) {
            $postMaster = PostMaster::find($id);
            $postDetails = PostDetails::find($id);
            // $postMaster = PostMaster::where('pid', '=', $id)->first();
            // $postDetails = PostDetails::where('pid', '=', $id)->first();
            //Save post data to post detail table
            $postContents = $request->input('ckcontentbody');
            $readTime = $this->getReadTime($postContents);
            $postDetails->title = $request->input('title');
            $postDetails->content = $postContents;
            $postDetails->tags = $request->input('tags');
            $postDetails->subject = $request->input('subject');
            $postDetails->read_time = $readTime;
            $postDetails->save();

            //Save post data to post master table
            // $postMaster->visible = config('constants.is_visible.visible');
            // $postMaster->deleted = config('constants.is_deleted.not_deleted');
            $postMaster->is_approved = config('constants.is_approved.no');
            $postMaster->save();
        });
        return redirect('home')->with('success', 'Post Updated. Wait For The Approval');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $post = PostMaster::where('pid', $id)->get();

            if (count($post) < 1) {
                return redirect()->back()->with('error', 'Post does not exist.');
            }
            if ($post[0]->author != Auth::user()->id
                &&  Auth::user()->role != config('constants.user_roles.superUser')) {
                return redirect()->back()->with('error', 'You are not authorized!');
            }
            PostMaster::where('pid', $id)->update(['deleted' => config('constants.is_deleted.deleted')]);
            return redirect('home')->with('success', 'Post Deleted');
        });
    }

    public function toggleVisibility($pid, $author)
    {
        if (Auth::user()->id != $author) {
            return redirect()->back()->with('error', 'Invalid User');
        }
        return DB::transaction(function () use ($pid) {
            try {
                DB::update(config('query.hide_post'), ['PID' => $pid]);
                $post = DB::select(config('query.get_author_post'), [$pid]);
                if (count($post) == 0) {
                    return redirect()->back()->with('error', 'Invalid Post');
                }
                return redirect()->back()->with('post', $post[0])->with('success', 'Post Visibility Changed');
            } catch (Exception $e) {
                Log::error('PostController->' . $e);
                return redirect()->back()->with('error', 'Something went wrong');
            }
        });
    }
}
