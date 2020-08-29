<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;

class PostApproval extends Mailable
{
    use Queueable, SerializesModels;

    protected $author;
    protected $title;
    protected $status;
    protected $pid;
    protected $remark;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($author, $title, $status, $pid, $remark)
    {
        error_log("IN CONSTRUCT ON MAILABALE".  $author);
        $this->author = $author;       
        $this->title = $title;
        $this->status = $status;
        $this->pid = $pid;
        $this->remark = $remark;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        error_log("".url('/view'));
        return $this->view('emails.approval')
                    ->subject('Your post has been reviewed')
                    ->with("data", ['author'=> $this->author,
                            'title'=> $this->title,
                            'pid'=> url('/post/'.$this->pid),
                            'status'=> $this->status,
                            'remark'=> $this->remark]);
    }
}
