<?php


namespace App\Models;


class UserModel implements \Serializable
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


    public function serialize()
    {
        return get_object_vars($this);
    }

    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }
}
