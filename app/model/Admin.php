

<?php


require_once('Users.php');



class Admin extends Connected {

    function __construct() {
        parent::__construct();
    }


    private function canDo() {
        $rep = false;
        if (isset($_GET)) {
            $rep = true;
        }
        return $rep;

    }
}



?>