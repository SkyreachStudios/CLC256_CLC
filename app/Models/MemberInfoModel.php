<?php


namespace App\Models;


class MemberInfoModel
{
    private  $age;
    private $gender;
    private $education;
    private $employer;
    //constructor
    function __construct($Age,$Gender, $Education, $Employer){
        $this->age = $Age;
        $this->gender = $Gender;
        $this->education = $Education;
        $this->employer = $Employer;


    }
    //getters
    function get_age(){
        return $this->age;
    }
    function get_gender(){
        return $this->gender;
    }

    function get_education(){
        return $this->education;
    }

    function get_employer(){
        return $this->employer;
    }


}
