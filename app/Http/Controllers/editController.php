<?php

namespace App\Http\Controllers;

use App\Models\EmploymentModel;
use App\Models\MemberInfoModel;
use App\Models\MemberModel;
use App\Models\SkillsModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class editController extends Controller
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

        $user = new UserModel($password,$email);

        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);





        $memberInfo = SecurityService::getMemberInfo($user);



        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);


    }

    public function editData(Request $request){
        //create memeber model using input credentials
        $email = $request->input('email');
        session_start();
        $password="";
        if(isset($_SESSION)){
            $password = $_SESSION['password'];
        }
        $name = $request->input('name');
        $member = new MemberModel($password,$email,$name);

        //create member info model using input credentials
        $age = $request->input('age');
        $gender = $request->input('gender');
        $education = $request->input('education');
        $employer = $request->input('employer');
        $user = new UserModel($password, $email);
        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);
        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];

        $memberInfo = new MemberInfoModel($age,$gender,$education,$employer);

        if(SecurityService::updateInfo($memberInfo,$member)){
            echo "data updated";
            return view('home')->with($data);
        }
    }
//updates the employement data of the selected entry
    public function updateEmploymentData(Request $request){
        $id=$request->input('id');
        $userID=$request->input('userid');
        $company=$request->input('company');
        $position=$request->input('position');
        $start=$request->input('start');
        $end=$request->input('end');
        $desc=$request->input('description');

        echo "updating employmentData with employment record: ".$id. " ".$userID." ".$company;


        $employerData=new EmploymentModel($id,$userID,$company,$position,$start,$end,$desc);
        SecurityService::updateEmployment($employerData);

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

        $user = new UserModel($password,$email);

        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);





        $memberInfo = SecurityService::getMemberInfo($user);




        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);




    }

    public function deleteEmploymentData(Request $request)
    {
        $id = $request->input('id');

        SecurityService::deleteEmployment($id);

        $email = "";
        $password = "";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if (isset($_SESSION)) {
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }

        $user = new UserModel($password, $email);

        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);


        $memberInfo = SecurityService::getMemberInfo($user);

        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);

    }



    public function addEmploymentData(Request $request)
    {
        $email = "";
        $password = "";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if (isset($_SESSION)) {
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }

        $user = new UserModel($password, $email);
        $userID=SecurityService::getMemberID($user);


            $id=0;

            $company=$request->input('company');
            $position=$request->input('position');
            $start=$request->input('start');
            $end=$request->input('end');
            $desc=$request->input('description');

            $employerData=new EmploymentModel($id,$userID,$company,$position,$start,$end,$desc);

            SecurityService::newEmployer($employerData);




        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);







        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);

    }

    //skill editing methods

    public function updateSkill(Request $request){
        $id=$request->input('id');
        $userID=$request->input('userid');
        $skillName=$request->input('skillName');
        $skillRating=$request->input('skillRating');


        $skillData = new SkillsModel($id,$userID,$skillName,$skillRating);
        SecurityService::updateSkill($skillData);

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

        $user = new UserModel($password,$email);

        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);
        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);




    }

    public function deleteSkill(Request $request)
    {
        $id = $request->input('id');

        SecurityService::deleteSkill($id);

        $email = "";
        $password = "";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if (isset($_SESSION)) {
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }

        $user = new UserModel($password, $email);

        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);





        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);

    }



    public function addSkill(Request $request)
    {
        $email = "";
        $password = "";
        $age = "";
        $gender = "";
        $education = "";
        $employer = "";
        session_start();
        if (isset($_SESSION)) {
            $email = $_SESSION['username'];
            $password = $_SESSION['password'];
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $education = $_SESSION['education'];
            $employer = $_SESSION['employer'];
        }

        $user = new UserModel($password, $email);
        $userID=SecurityService::getMemberID($user);


        $id=0;

        $skillName=$request->input('skillName');
        $skillRating=$request->input('skillRating');

        $skillData = new SkillsModel($id,$userID,$skillName,$skillRating);

       SecurityService::newSkill($skillData);




        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);







        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);

    }


}


