<?php


namespace App\Services\Data;


use App\Models\EmploymentModel;
use App\Models\jobModel;
use App\Models\MemberInfoModel;
use App\Models\MemberModel;
use App\Models\memberProfileModel;
use App\Models\SkillsModel;
use App\Models\UserModel;
use App\User;
use PDO;
use PDOException;

class JobsDAO
{
    //finds user by email

    public static function getAllJobs()
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT * FROM jobs";
            $result = $conn->query($stmt);
            $jobs=$result->fetchAll();

$jobsList=[];
                if ($result->rowCount() > 0) {
                    //jobs exist
                    for($i=0; $i<$result->rowCount();$i++){
                        $job=new jobModel($jobs[$i][0],$jobs[$i][1],$jobs[$i][2],$jobs[$i][3],$jobs[$i][4],$jobs[$i][5],$jobs[$i][6]);
                        $jobsList[$i]=$job;
                    }


                    return $jobsList;
                } else {
                    //echo "Wrong login data or there was an error";


                }




        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }


    public static function addJob(jobModel $job)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";


        //get job data
        $id = $job->getId();
        $company=$job->getCompany();
        $title=$job->getTitle();
        $salary=$job->getSalary();
        $location=$job->getLocation();
        $desc=$job->getDescription();
        $qualifications=$job->getQualifications();



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $insert = "INSERT INTO jobs( company, title, location,salary,description,qualifications) VALUES ('$company','$title','$location','$salary','$desc','$qualifications')";
            $conn->query($insert);
            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }



}


//updates job
    public static function updateJob(jobModel $job){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";

        //get job data
        $id=$job->getId();
        $company=$job->getCompany();
        $title=$job->getTitle();
        $salary=$job->getSalary();
        $location=$job->getLocation();
        $desc=$job->getDescription();
        $qualifications=$job->getQualifications();


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




            echo $id;
            $memberStmnt = "UPDATE `jobs` SET `company`='$company',`title`='$title',`location`='$location',`salary`='$salary' ,`description`='$desc',`qualifications`='$qualifications'WHERE `ID` LIKE '$id'";

            $conn->query($memberStmnt);
            return true;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }


    public static function deleteJob(int $id){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";





        //get member info



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $memberStmnt = "DELETE FROM `jobs` WHERE `ID` LIKE '$id'";

            $results1=$conn->query($memberStmnt);



            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }


}
