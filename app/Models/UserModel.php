<?php


namespace App\Models;


class UserModel
{
    private  $email;
    private $password;
    private $name;
    //constructor
    function __construct($Password,$Email){
        $this->email = $Email;
        $this->password = $Password;



    }
    //getters
    function get_email(){
        return $this->email;
    }
    function get_password(){
        return $this->password;
    }



}
