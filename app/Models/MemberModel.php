<?php


namespace App\Models;


class MemberModel
{
    private  $email;
    private $password;
    private $name;
    //constructor
    function __construct($Password,$Email, $Name){
        $this->email = $Email;
        $this->password = $Password;
        $this->name = $Name;
    }
    //getters
    function get_email(){
        return $this->email;
    }
    function get_password(){
        return $this->password;
    }

    function get_name(){
        return $this->name;
    }


}
