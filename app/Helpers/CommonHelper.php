<?php 
namespace App\Helpers;

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
}
?>