<?php


namespace App\Models;


class groupModel
{
    private  $id;
    private $name;
    private $desc;
    private $members;

    //constructor
    function __construct($ID,$Name,$Desc,$Members){
        $this->id = $ID;
        $this->name = $Name;
        $this->desc= $Desc;
        $this->members = $Members;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @return mixed
     */
    public function getMembers()
    {
        return $this->members;
    }


}
