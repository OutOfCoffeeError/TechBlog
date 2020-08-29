<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PostDetails;
use App\PostMaster;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


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

            $postDetails = $this->postDetails::find($pid);
            $postMaster = $this->postMaster::find($pid);
            DB::transaction(function () use ($pid, $postMaster) {
                $postMaster->is_approved = config('constants.is_approved.yes');
                $postMaster->approved_by = Auth::user()->id;
                $postMaster->save();
            });
            try {
                $userData = DB::select(config('query.getUserData'), ['USERID' => $postMaster->author]);
                AdminController::buildMail($userData, $postDetails->title, config('constants.is_approved.yes'), $pid, null);
            } catch(Exception $ex) {
                Log::error('AdminController->Approve Mailer ' . $ex);
            }
            return redirect()->back();
        } catch (Exception $e) {
            Log::error('AdminController->Approve ' . $e);
            return redirect('admin')->with('error', 'Something went wrong');
        }
    }

    public function reject(Request $request)
    {
        try {
            $this->validate($request, ['pid' => 'required']);
            $pid = $request->input('pid');
            $remark = $request->input('remark');
            $postMaster =  $this->postMaster::where('pid', $pid);
            // return $postMaster->get();
            $postDetails = $this->postDetails::where('pid', $pid);
            DB::transaction(function () use ($remark, $postMaster, $postDetails) {
                $postMaster->update(['is_approved' =>  config('constants.is_approved.rejected')]);
                //Reject remark code
                $postDetails->update(['remarks' => $remark]);
             });
             try {
                 $userData = DB::select(config('query.getUserData'), ['USERID' => $postMaster->get()[0]->author]);
                 AdminController::buildMail($userData, $postDetails->get()[0]->title, config('constants.is_approved.rejected'), $pid, $remark);
             } catch(Exception $ex) {
                Log::error('AdminController->Reject Mailer ' . $ex);
             }
            return redirect()->back();
        } catch(Exception $e) {
            Log::error('AdminController->Reject ' . $e);
            return redirect('admin')->with('error', 'Something went wrong');
        }

    }

    private function buildMail($userData, $title, $status, $pid, $remark)
    {
        CommonHelper::sendMail($userData, $title, $status, $pid, $remark);
        
    }
}
