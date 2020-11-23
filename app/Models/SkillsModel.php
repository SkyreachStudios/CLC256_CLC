<?php


namespace App\Models;


class SkillsModel
{
    private  $id;
    private $userID;
    private $skillName;
    private $skillRating;

    //constructor
    function __construct($ID,$USERID,$SKILLNAME,$SKILLRATING){
        $this->id = $ID;
        $this->userID=$USERID;
        $this->skillName = $SKILLNAME;
        $this->skillRating=$SKILLRATING;




    }
    //getters
    function get_ID(){
        return $this->id;
    }
    function get_userID(){
        return $this->userID;
    }

function get_skillName(){
        return $this->skillName;
}
function get_skillRating(){
        return $this->skillRating;
}


}
