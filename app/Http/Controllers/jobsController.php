<?php

namespace App\Http\Controllers;

use App\Models\EmploymentModel;
use App\Models\jobModel;
use App\Models\MemberInfoModel;
use App\Models\MemberModel;
use App\Models\SkillsModel;
use App\Services\Business\JobsService;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class jobsController extends Controller
{
    public function index(Request $request)
    {
        $email = "";
        $password="";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if(isset($_SESSION)){
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }

        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);


    }

    public function updateJob(Request $request){
        $id=$request->input('id');
        $company=$request->input('company');
        $title=$request->input('title');
        $location=$request->input('location');
        $salary=$request->input('salary');
        $description=$request->input('description');
        $qualifications=$request->input('qualifications');
        $email = "";
        $password="";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if(isset($_SESSION)){
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }

        echo "calling update job!!!";


        $job=new jobModel($id,$company,$title,$location,$salary,$description,$qualifications);

        JobsService::updateJob($job);

        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);

    }
//updates the employement data of the selected entry
    public function addJob(Request $request){
        $company=$request->input('title');
        $title=$request->input('title');
        $location=$request->input('location');
        $salary=$request->input('salary');
        $description=$request->input('description');
        $qualifications=$request->input('qualifications');
        $email = "";
        $password="";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if(isset($_SESSION)){
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }

        $id=0;

        $job=new jobModel($id,$company,$title,$location,$salary,$description,$qualifications);

        JobsService::addJob($job);

        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);




    }

    public function deleteJob(Request $request)
    {
        $id=$request->input('id');
        $company=$request->input('company');
        $title=$request->input('title');
        $location=$request->input('location');
        $salary=$request->input('salary');
        $description=$request->input('description');
        $qualifications=$request->input('qualifications');
        $email = "";
        $password="";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if(isset($_SESSION)){
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }



        $job=new jobModel($id,$company,$title,$location,$salary,$description,$qualifications);

        JobsService::deleteJob($id);

        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);

    }

    public function searchJob(Request $request){
        $searchTerm=$request->input('jobsearch');

        //tracking session variables for login
        $email = "";
        $password="";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if(isset($_SESSION)){
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }

        $jobsList=JobsService::searchJobs($searchTerm);
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);



    }

    public function apply(Request $request){
        $id=$request->input('id');
        $company=$request->input('company');
        $title=$request->input('title');
        $location=$request->input('location');
        $salary=$request->input('salary');
        $description=$request->input('description');
        $qualifications=$request->input('qualifications');
        $email = "";
        $password="";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if(isset($_SESSION)){
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }

        $data=['id'=>$id,'company'=>$company,'title'=>$title,'location'=>$location, 'salary'=>$salary,'description'=>$description,'qualifications'=>$qualifications];
        return view("apply")->with($data);
    }

    public function submitApply(Request $request){
        $fname=$request->input('First_Name');
        $lname=$request->input('Last_Name');
        $apemail=$request->input('Email_Address');
        $position=$request->input('Position');
        $salary=$request->input('Salary');
        $start=$request->input('StartDate');
        $phone=$request->input('Phone');
        $fax=$request->input('Fax');
        $organization=$request->input('Organization');
        $reference=$request->input('Reference');


        $email = "";
        $password="";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if(isset($_SESSION)){
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }


        $msg="You have a new job candidate!\n Name:".$fname." ".$lname.
            "\n Email:".$apemail.
            "\n Position Applying for: ".$position.
            "\n Desired Salary: ".$salary.
            "\n Available Start Date: ".$start.
            "\n Phone Number: ".$phone.
            "\n Fax Number: ".$fax.
            "\n Last Employer: ". $organization.
            "\n Reference: ".$reference;
        $msg=wordwrap($msg, 90);

        echo $msg;
        //mail("CSciarrino@my.gcu.edu", "New Applicant!", $msg);

        echo "Applied!";
        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);

    }



}


