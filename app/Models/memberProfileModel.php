<?php


namespace App\Models;


class memberProfileModel
{
    private $id;
    private  $email;
    private $password;
    private $name;
    private $admin;
    private $suspended;
    //constructor
    function __construct($ID,$Password,$Email, $Name, $Admin,$Suspended){
        $this->id=$ID;
        $this->email = $Email;
        $this->password = $Password;
        $this->name = $Name;
        $this->admin = $Admin;
        $this->suspended = $Suspended;
    }
    //getters
    function get_id(){
        return $this->id;
    }

    function get_email(){
        return $this->email;
    }
    function get_password(){
        return $this->password;
    }

    function get_name(){
        return $this->name;
    }

    function get_Admin(){
        return $this->admin;
    }

    function get_Suspended(){
        return $this->suspended;
    }

}
