<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PostDetails;
use App\PostMaster;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class AdminController extends Controller
{
    public function __construct(PostDetails $postDetails, PostMaster $postMaster)
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
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
        try {
            $posts = PostMaster::select('post_master.pid', 'name', 'author', 'title', 'post_master.updated_at', 'subject')
                ->where([
                    ['is_approved', config('constants.is_approved.no')],
                    ['deleted', config('constants.is_deleted.not_deleted')]
                ])
                ->join('users', 'users.id', '=', 'post_master.author')
                ->join('post_detail', 'post_detail.pid', '=', 'post_master.pid')
                ->orderBy('post_master.updated_at', 'desc')
                ->paginate(10);

            // $users = User::select('id', 'name', 'role', 'created_at')->paginate(2)->setPageName('userPage');
            // return $users;
            return view('pages.manage')
                ->with('posts', $posts);
            // ->with('users', $users);
        } catch (Exception $e) {
            Log::error('AdminController->' . $e);
            return redirect('admin')->with('error', 'Something went wrong');
        }
    }

    public function approve(Request $request)
    {
        try {
            $this->validate($request, ['pid' => 'required']);
            $pid = $request->input('pid');

            return DB::transaction(function () use ($pid) {
                $post = $this->postMaster::find($pid);
                $post->is_approved = config('constants.is_approved.yes');
                $post->approved_by = Auth::user()->id;
                $post->save();
                return redirect()->back();
            });
        } catch (Exception $e) {
            Log::error('AdminController->' . $e);
            return redirect('admin')->with('error', 'Something went wrong');
        }
    }

    public function reject(Request $request)
    {
        $this->validate($request, ['pid' => 'required']);
        $pid = $request->input('pid');
        $remark = $request->input('remark');
        DB::transaction(function () use ($pid, $remark) {
            $this->postMaster::where('pid', $pid)->update(['is_approved' =>  config('constants.is_approved.rejected')]);
            //Reject remark code
            $this->postDetails::where('pid', $pid)->update(['remarks' => $remark]);
         });
        return redirect()->back();
    }
}
