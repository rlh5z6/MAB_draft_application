<?php namespace models;

class Password extends \core\model{

    public function __construct(){
        parent::__construct();
    }

    public function get_hash($pass, $salt){
        $passhash = '';
        $passchars = array_reverse(str_split($pass));
        foreach($passchars as $char){
            $passhash = sha1($passhash.$char.$salt);
        }
        return $passhash;
    }

    public function generate_salt(){
        return sha1(rand());
    }

    public function get_random_password($valid_chars, $length) {
        
        // start with an empty random string
        $random_string = "";

        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);

        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++)
        {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);

            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick-1];

            // add the randomly-chosen char onto the end of our string so far
            $random_string .= $random_char;
        }

        // return our finished random string
        return $random_string;
    }
    
    
    
}