<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\PostDetails;
use App\PostMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

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
            'title' => 'required',
            'body' => 'required',
            'tags' => 'required'
        ]);

        // Initiate a database transaction
        DB::transaction(function()  use ($request) {
            $postMaster = new PostMaster();
            $postDetail = new PostDetails();
            $postId = null;
            // Create an unique post id after checking it against database post entries
            while(true) {
                $postId = CommonHelper::generateB64Token(config('constants.post_id_length'));
                if(PostMaster::where('pid', '=', $postId)->count() == 0) {
                    break;
                }
            }
            //Save post data to post detail table
            $postDetail->pid = $postId;
            $postDetail->title = $request->input('title');
            $postDetail->content = $request->input('body');
            $postDetail->tags = $request->input('tags');
            $postDetail->save();
            
            //Save post data to post master table
            $postMaster->pid = $postId;
            $postMaster->author = Auth::user()->id;
            $postMaster->visible = config('constants.is_visible.hidden');
            $postMaster->deleted = config('constants.is_deleted.not_deleted');
            $postMaster->save();
        });
        return redirect('home')->with('success', 'New Post Published. Wait for the approval');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
