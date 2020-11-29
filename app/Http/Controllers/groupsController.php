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

        $groupsList= GroupsService::getGroups();
        $data = ['groupsList'=>$groupsList];
        return view("groups")->with($data);


    }

    public function updateGroup(Request $request){
        $id=$request->input('id');
        $name=$request->input('name');
        $desc=$request->input('desc');

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

        $members = [];
        $group = new groupModel($id,$name,$desc,$members);

        GroupsService::updateGroup($group);

        $groupsList= GroupsService::getGroups();
        $data = ['groupsList'=>$groupsList];
        return view("groups")->with($data);

    }
    public function addGroup(Request $request){
        $id=$request->input('id');
        $name=$request->input('name');
        $desc=$request->input('desc');
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
        $members = [];
        $group = new groupModel($id,$name,$desc,$members);

        GroupsService::addGroup($group);

        $groupsList= GroupsService::getGroups();
        $data = ['groupsList'=>$groupsList];
        return view("groups")->with($data);




    }

    public function deleteGroup(Request $request)
    {
        $id=$request->input('id');
        $name=$request->input('name');
        $desc=$request->input('desc');

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



        GroupsService::deleteGroup($id);

        $groupsList= GroupsService::getGroups();
        $data = ['groupsList'=>$groupsList];
        return view("groups")->with($data);

    }

    public function  visitPage(Request $request){
        $id = $request->input('id');


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

        $group=GroupsService::getByID($id);
        $members = GroupsService::getMembers($id);
        $isMember= GroupsService::checkIfMember($email, $id);



        $data =['group'=>$group, 'members'=>$members, 'memberStatus'=>$isMember];
        return view("groupPage")->with($data);

    }

    public function  joinGroup(Request $request){
        $id = $request->input('id');


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



        GroupsService::joinGroup($email,$id);

        $group=GroupsService::getByID($id);
        $members = GroupsService::getMembers($id);
        $isMember= GroupsService::checkIfMember($email, $id);



        $data =['group'=>$group, 'members'=>$members, 'memberStatus'=>$isMember];
        return view("groupPage")->with($data);

    }

    public function  leaveGroup(Request $request){
        $id = $request->input('id');


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



        GroupsService::leaveGroup($email,$id);

        $group=GroupsService::getByID($id);
        $members = GroupsService::getMembers($id);
        $isMember= GroupsService::checkIfMember($email, $id);



        $data =['group'=>$group, 'members'=>$members, 'memberStatus'=>$isMember];
        return view("groupPage")->with($data);

    }



}


