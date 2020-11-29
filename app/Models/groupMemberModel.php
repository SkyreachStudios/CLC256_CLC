<?php


namespace App\Models;


class groupMemberModel
{
    private  $id;


    private $group_ID;
    private $user_ID;
    private $user_email;

    //constructor
    function __construct($ID,$GID,$UID,$Email){
        $this->id = $ID;
        $this->group_ID = $GID;
        $this->user_ID = $UID;
        $this->user_email=$Email;
    }


    //getters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getGroupID()
    {
        return $this->group_ID;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->user_ID;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }


}
