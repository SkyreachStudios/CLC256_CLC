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

        (new \App\Services\Utility\Logger2)->info("Gathering Session information...");
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
        (new \App\Services\Utility\Logger2)->info("Generating Jobs list...");
        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);


    }

    public function updateJob(Request $request){

        (new \App\Services\Utility\Logger2)->info("Gathering job update data from form...");
        $id=$request->input('id');
        $company=$request->input('company');
        $title=$request->input('title');
        $location=$request->input('location');
        $salary=$request->input('salary');
        $description=$request->input('description');
        $qualifications=$request->input('qualifications');

        (new \App\Services\Utility\Logger2)->info("Gathering Session variable data...");
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



        (new \App\Services\Utility\Logger2)->info("Updating job...");
        $job=new jobModel($id,$company,$title,$location,$salary,$description,$qualifications);

        JobsService::updateJob($job);

        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);

    }
//add a new job listing to the jobs list
    public function addJob(Request $request){
        (new \App\Services\Utility\Logger2)->info("Gathering new job data from form...");
        $company=$request->input('title');
        $title=$request->input('title');
        $location=$request->input('location');
        $salary=$request->input('salary');
        $description=$request->input('description');
        $qualifications=$request->input('qualifications');

        (new \App\Services\Utility\Logger2)->info("Getting session data variables...");
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

        (new \App\Services\Utility\Logger2)->info("Adding new job to database...");
        $job=new jobModel($id,$company,$title,$location,$salary,$description,$qualifications);

        JobsService::addJob($job);

        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);




    }
//delete a job
    public function deleteJob(Request $request)
    {
        (new \App\Services\Utility\Logger2)->info("Gathering data from job to delete...");
        $id=$request->input('id');
        $company=$request->input('company');
        $title=$request->input('title');
        $location=$request->input('location');
        $salary=$request->input('salary');
        $description=$request->input('description');
        $qualifications=$request->input('qualifications');

        (new \App\Services\Utility\Logger2)->info("Gathering session data...");
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


        (new \App\Services\Utility\Logger2)->info("Deleting job from database...");
        $job=new jobModel($id,$company,$title,$location,$salary,$description,$qualifications);

        JobsService::deleteJob($id);

        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);

    }

    //search for job using keyword
    public function searchJob(Request $request){
        (new \App\Services\Utility\Logger2)->info("Retrieving search keyword...");
        $searchTerm=$request->input('jobsearch');

        (new \App\Services\Utility\Logger2)->info("Gathering session variables...");
        //tracking session variables for header
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
        (new \App\Services\Utility\Logger2)->info("Searching jobs...");
        $jobsList=JobsService::searchJobs($searchTerm);
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);



    }
    //allows a user to apply
    public function apply(Request $request){
        (new \App\Services\Utility\Logger2)->info("Getting information for the job this user wants to apply to...");
        $id=$request->input('id');
        $company=$request->input('company');
        $title=$request->input('title');
        $location=$request->input('location');
        $salary=$request->input('salary');
        $description=$request->input('description');
        $qualifications=$request->input('qualifications');

        (new \App\Services\Utility\Logger2)->info("Gathering session variables...");
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

        (new \App\Services\Utility\Logger2)->info("navigating to application page.");
        $data=['id'=>$id,'company'=>$company,'title'=>$title,'location'=>$location, 'salary'=>$salary,'description'=>$description,'qualifications'=>$qualifications];
        return view("apply")->with($data);
    }

    public function submitApply(Request $request){

        (new \App\Services\Utility\Logger2)->info("Gathing application data...");
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

        (new \App\Services\Utility\Logger2)->info("Gathering session data...");
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

        (new \App\Services\Utility\Logger2)->info("Sending application...NOTE APPLICATIONS ARE UNDER CONSTRUCTION AND WILL NOT ACTUALLY BE SENT AT THIS TIME!!!");
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
        $jobsList=JobsService::getJobs();
        $data = ['jobsList'=>$jobsList];
        return view("jobs")->with($data);

    }



}


