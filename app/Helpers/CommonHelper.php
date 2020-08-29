<?php 
namespace App\Helpers;

use App\Mail\PostApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommonHelper {
    /**
     * CommonHelper
     * ------------------
     * All the common functions and utilities are defined here which can used gloablly
     * throughout the project
     * @author Shubham Pawar
     */



     /**
      * Generates a Base64 random token
      * @param Integer $length
      * @return String
      */
    public static function generateB64Token($length) {
        $token = "";
        $sample = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $sample.= "abcdefghijklmnopqrstuvwxyz";
        $sample.= "0123456789";
        $sample.="_-";
        $max = strlen($sample);
    
        for ($i = 0; $i < $length; $i++) {
            $token .= $sample[random_int(0, $max-1)];
        }
    
        return $token;
    }

    /**
     * Check if the user is admin/superUser
     * @return Boolean
     */

     public static function checkAdmin() {
         if(Auth::user()->role == config('constants.user_roles.superUser')
         || Auth::user()->role == config('constants.user_roles.admin')) {
             return true;
         }
         return false;
     }

     
     public static function checkSU() {
        if(Auth::user()->role == config('constants.user_roles.superUser')) {
            return true;
        }
        return false;
    }

    /**
     * Check for XSS vulnerabilities
     */
    public static function checkXSS($content) {
        $xssTag = '/<[ ]*script/';
        if(preg_match($xssTag, $content)) {
            return true;
        }
        return false;
    }

    /**
     * Mail Utility
     */
    public static function sendMail() {
        // Mail::queue('emails.test', [], function ($message) {
        //     // $message->from('shubhampawarluk3@gmail.com', 'Shubham Pawar');
        //     // $message->sender('john@johndoe.com', 'John Doe');
        //     $message->to('shubhampawar16298@gmail.com', 'Shubham Pawar');
        //     $message->subject('just another Subject');
        // });

        Mail::to('shubhampawar16298@gmail.com')
            ->cc('shubhampawarluk3@gmail.com')
            ->queue(new PostApproval());
    }
     
}
?>