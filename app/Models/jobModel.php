<?php


namespace App\Models;


class jobModel implements \Serializable
{
    private  $id;
    private $company;
    private $title;


    private $location;
    private $salary;
    private $description;
    private $qualifications;

    //constructor
    function __construct($ID,$Company,$Title,$Location,$Salary,$Description,$Qualifications){
        $this->id = $ID;
        $this->company=$Company;
        $this->title=$Title;
        $this->location=$Location;
        $this->salary=$Salary;
        $this->description=$Description;
        $this->qualifications=$Qualifications;


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
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getQualifications()
    {
        return $this->qualifications;
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
