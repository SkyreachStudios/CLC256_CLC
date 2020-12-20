<?php

namespace App\Http\Controllers;

use App\Models\EmploymentModel;
use App\Models\groupModel;
use App\Models\jobModel;
use App\Models\MemberInfoModel;
use App\Models\MemberModel;
use App\Models\SkillsModel;
use App\Services\Business\GroupsService;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class groupsController extends Controller
{
    public function index(Request $request)
    {
        (new \App\Services\Utility\Logger2)->info("Gathing session data...");
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

        (new \App\Services\Utility\Logger2)->info("Populating groups lists...");
        $groupsList= GroupsService::getGroups();
        $data = ['groupsList'=>$groupsList];
        return view("groups")->with($data);


    }
//update a group
    public function updateGroup(Request $request){
        (new \App\Services\Utility\Logger2)->info("Gathering data for group to update!");
        $id=$request->input('id');
        $name=$request->input('name');
        $desc=$request->input('desc');

        (new \App\Services\Utility\Logger2)->info("Gathering Session data...");
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

        (new \App\Services\Utility\Logger2)->info("Updating group...");
        $members = [];
        $group = new groupModel($id,$name,$desc,$members);

        GroupsService::updateGroup($group);

        $groupsList= GroupsService::getGroups();
        $data = ['groupsList'=>$groupsList];
        return view("groups")->with($data);

    }

    //add new group to database
    public function addGroup(Request $request){

        (new \App\Services\Utility\Logger2)->info("Gathering data for new group to add...");
        $id=$request->input('id');
        $name=$request->input('name');
        $desc=$request->input('desc');

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

        (new \App\Services\Utility\Logger2)->info("Adding new group...");
        $id=0;
        $members = [];
        $group = new groupModel($id,$name,$desc,$members);

        GroupsService::addGroup($group);

        $groupsList= GroupsService::getGroups();
        $data = ['groupsList'=>$groupsList];
        return view("groups")->with($data);




    }
//delete a group
    public function deleteGroup(Request $request)
    {
        (new \App\Services\Utility\Logger2)->info("Gathering data for group to delete...");
        $id=$request->input('id');
        $name=$request->input('name');
        $desc=$request->input('desc');

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


        (new \App\Services\Utility\Logger2)->info("Deleting group...");
        GroupsService::deleteGroup($id);

        $groupsList= GroupsService::getGroups();
        $data = ['groupsList'=>$groupsList];
        return view("groups")->with($data);

    }
//visit a groups page
    public function  visitPage(Request $request){
        (new \App\Services\Utility\Logger2)->info("Getting ID of the group page to visit...");
        $id = $request->input('id');

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

        (new \App\Services\Utility\Logger2)->info("Populating group page...");
        $group=GroupsService::getByID($id);
        $members = GroupsService::getMembers($id);
        $isMember= GroupsService::checkIfMember($email, $id);



        $data =['group'=>$group, 'members'=>$members, 'memberStatus'=>$isMember];
        return view("groupPage")->with($data);

    }
//join a group
    public function  joinGroup(Request $request){
        (new \App\Services\Utility\Logger2)->info("Getting ID for group to join...");
        $id = $request->input('id');

        (new \App\Services\Utility\Logger2)->info("Getting session variables...");
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


        (new \App\Services\Utility\Logger2)->info("Joining group...");
        GroupsService::joinGroup($email,$id);

        $group=GroupsService::getByID($id);
        $members = GroupsService::getMembers($id);
        $isMember= GroupsService::checkIfMember($email, $id);



        $data =['group'=>$group, 'members'=>$members, 'memberStatus'=>$isMember];
        return view("groupPage")->with($data);

    }
//leave a group
    public function  leaveGroup(Request $request){
        (new \App\Services\Utility\Logger2)->info("Getting ID for group to leave...");
        $id = $request->input('id');

        (new \App\Services\Utility\Logger2)->info("Getting session variables...");
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


        (new \App\Services\Utility\Logger2)->info("Leaving group...");
        GroupsService::leaveGroup($email,$id);

        $group=GroupsService::getByID($id);
        $members = GroupsService::getMembers($id);
        $isMember= GroupsService::checkIfMember($email, $id);



        $data =['group'=>$group, 'members'=>$members, 'memberStatus'=>$isMember];
        return view("groupPage")->with($data);

    }



}


