<?php

class Connected extends User {
    
    function __construct() {
        parent::__construct();
    }


    protected function canDo() {

        $rep = false;
        if (isset($_GET) and $_GET['role'] === 0) {
            $rep = true;
        } 
        return $rep;

    }

}

?>