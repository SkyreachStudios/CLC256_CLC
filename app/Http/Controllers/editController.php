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
        (new \App\Services\Utility\Logger2)->info("Entering editCotnroller::index()");

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

        (new \App\Services\Utility\Logger2)->info("Populating data to edit...");
        $user = new UserModel($password,$email);

        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);





        $memberInfo = SecurityService::getMemberInfo($user);



        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);


    }

    public function editData(Request $request){
$inputValidate = request()->validate([
    'name'=>'required',
    'email'=>'required',
    'age'=>'required',
    'gender'=>'required|max:1',
    'education'=>'required',
    'employer'=>'required'
]);


        (new \App\Services\Utility\Logger2)->info("Editing data...");
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

        $validate = request()->validate([
            'company'=>'required',
            'position'=>'required',
            'start'=>'required',
            'end'=>'required',
            'description'=>'required'
        ]);
        (new \App\Services\Utility\Logger2)->info("Gathering data to update employment data...");
        $id=$request->input('id');
        $userID=$request->input('userid');
        $company=$request->input('company');
        $position=$request->input('position');
        $start=$request->input('start');
        $end=$request->input('end');
        $desc=$request->input('description');




        $employerData=new EmploymentModel($id,$userID,$company,$position,$start,$end,$desc);
        SecurityService::updateEmployment($employerData);

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


        (new \App\Services\Utility\Logger2)->info("Updating employment data...");
        $user = new UserModel($password,$email);

        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);





        $memberInfo = SecurityService::getMemberInfo($user);




        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);




    }

    //delete employment data
    public function deleteEmploymentData(Request $request)
    {
        (new \App\Services\Utility\Logger2)->info("Getting ID for employment to delete...");
        $id = $request->input('id');

        (new \App\Services\Utility\Logger2)->info("Deleteing employment");
        SecurityService::deleteEmployment($id);

        (new \App\Services\Utility\Logger2)->info("Gathing session info...");
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


//Add a new employer to data
    public function addEmploymentData(Request $request)
    {

        $validate = request()->validate([
            'company'=>'required',
            'position'=>'required',
            'start'=>'required',
            'end'=>'required',
            'description'=>'required'
        ]);
        (new \App\Services\Utility\Logger2)->info("Gathering session data");
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

        (new \App\Services\Utility\Logger2)->info("Gathering employer data to add...");
        $user = new UserModel($password, $email);
        $userID=SecurityService::getMemberID($user);


            $id=0;
            $company=$request->input('company');
            $position=$request->input('position');
            $start=$request->input('start');
            $end=$request->input('end');
            $desc=$request->input('description');

            $employerData=new EmploymentModel($id,$userID,$company,$position,$start,$end,$desc);

        (new \App\Services\Utility\Logger2)->info("Adding employer...");
            SecurityService::newEmployer($employerData);




        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);







        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);

    }

    //skill editing methods
//update a skill
    public function updateSkill(Request $request){
        $validate = request()->validate([
            'skillName'=>'required',
            'skillRating'=>'required',
        ]);

        (new \App\Services\Utility\Logger2)->info("Gathering data for skill to update...");
        $id=$request->input('id');
        $userID=$request->input('userid');
        $skillName=$request->input('skillName');
        $skillRating=$request->input('skillRating');

        (new \App\Services\Utility\Logger2)->info("Updating skill...");
        $skillData = new SkillsModel($id,$userID,$skillName,$skillRating);
        SecurityService::updateSkill($skillData);

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

        $user = new UserModel($password,$email);

        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);
        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);




    }

    //Delete a skill from list
    public function deleteSkill(Request $request)
    {
        (new \App\Services\Utility\Logger2)->info("Getting ID of skill to delete...");
        $id = $request->input('id');

        (new \App\Services\Utility\Logger2)->info("Deleting Skill...");
        SecurityService::deleteSkill($id);

        (new \App\Services\Utility\Logger2)->info("Gathering session data...");
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


//add a new skill to list
    public function addSkill(Request $request)
    {
        $validate = request()->validate([
            'skillName'=>'required',
            'skillRating'=>'required',
        ]);
        (new \App\Services\Utility\Logger2)->info("Gathering session data...");
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

        (new \App\Services\Utility\Logger2)->info("Gathering new skill data...");
        $id=0;
        $skillName=$request->input('skillName');
        $skillRating=$request->input('skillRating');

        $skillData = new SkillsModel($id,$userID,$skillName,$skillRating);

        (new \App\Services\Utility\Logger2)->info("Adding new skill...");
       SecurityService::newSkill($skillData);

        $employmentList = SecurityService::employment($user);
        $name = SecurityService::getMemberName($user);


        $skills=SecurityService::skills($user);
        $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
        return view("edit")->with($data);

    }


}


