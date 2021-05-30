<?php

require('app/db.php');

class User
{
    
    private $name;
    private $email;
    private $password;
    private $id;
    private $role;

    function __construct($newname, $newemail, $newpassword, $newid, $newrole) {
        $this->$name = $newname;
        $this->$email = $newemail;
        $this->$password = $newpassword;
        $this->$id = $newid;
        $this->$role = $newrole;
    }

}



class Admin extends Connected {

    function __construct() {
        parent::__construct();
    }


    private function canDo() {
        $rep = false;
        if (isset($_GET) and $_GET['role'] === 1)) {
            $rep = true;
        }
        return $rep;

    }
}


?>