<?php


namespace App\Models;


class EmploymentModel
{
    private  $id;
    private $userID;
    private $company;
    private $position;
    private $start_date;
    private $end_date;
    private $description;

    //constructor
    function __construct($ID,$USERID,$COMPANY,$POSITION,$START,$END,$DESC){
        $this->id = $ID;
        $this->userID=$USERID;
        $this->company = $COMPANY;
        $this->position=$POSITION;
        $this->start_date=$START;
        $this->end_date=$END;
        $this->description=$DESC;



    }
    //getters
    function get_ID(){
        return $this->id;
    }
    function get_userID(){
        return $this->userID;
    }

    function get_company(){
        return $this->company;
    }

    function get_position(){
        return $this->position;
    }

    function get_startDate(){
        return $this->start_date;
    }

    function get_endDate(){
        return $this->end_date;
    }

    function get_description(){
        return $this->description;
    }


}
