<?php

namespace App\Http\Controllers;

use App\Models\DTO;
use App\Services\Business\JobsService;
use App\Services\Business\SecurityService;
use Illuminate\Http\Request;

class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SecurityService::getAllMembers();
        $errorCode = 100;
        $errorMessage = " Error 100, no users";
        $data = SecurityService::getAllMembers();
        $dto=new DTO($errorCode,$errorMessage,$data);
        echo json_encode($dto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $errorCode = 101;
        $errorMessage = " Error 101, user does not exist";
        $user = SecurityService::findUserByID($id);
        $data = $user->serialize();
        $dto=new DTO($errorCode,$errorMessage,$data);
        echo "User data:<br>";
        echo "-----------------------------------<br>";
        echo json_encode($dto);

        $errorCode = 102;
        $errorMessage = " Error 102, No jobs currently in the database";
        $jobs= JobsService::getJobs();
        for($i = 0; $i<sizeof($jobs); $i++){
            $data[$i]= $jobs[$i]->serialize();
        }
        $dto2=new DTO($errorCode,$errorMessage,$data);
        echo "<br></br>All Jobs:<br>";
        echo "-----------------------------------<br>";
        echo json_encode($dto2);


        $errorCode = 103;
        $errorMessage = " Error 103, job does not exist";
        $job= JobsService::findJobByID($id);
        $data= $job->serialize();
        $dto3=new DTO($errorCode,$errorMessage,$data);
        echo "<br></br>Job:<br>";
        echo "-----------------------------------<br>";
        echo json_encode($dto3);




    }
}
