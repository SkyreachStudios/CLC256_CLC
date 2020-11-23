<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class LoginController extends Controller
{
    public function index(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $user = new UserModel($password,$email);

        if(isset($_SESSION)){
            if($_SESSION['login']==true) {
                session_destroy();
                session_start();
                $_SESSION['username'] = "";
                $_SESSION['password'] = "";
                $_SESSION['loggedIn'] = false;
                $_SESSION['age'] = '0';
                $_SESSION['gender'] = "";
                $_SESSION['education'] = "";
                $_SESSION['employer'] = "";
                $_SESSION['admin'] = "false";
                $_SESSION['suspended']="false";
            }
        }
        else{
            if(SecurityService::login($user)){


                session_start();
                $_SESSION['username'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['loggedIn'] = true;
                $memberInfo = SecurityService::getMemberInfo($user);
                $age = $memberInfo->get_age();
                $gender = $memberInfo->get_gender();
                $education = $memberInfo->get_education();
                $employer = $memberInfo->get_employer();
                $_SESSION['age']=$age;
                $_SESSION['gender']=$gender;
                $_SESSION['education']=$education;
                $_SESSION['employer']=$employer;

                if( SecurityService::checkAdmin($user)){
                    $_SESSION['admin']=true;
                }
                else{
                    $_SESSION['admin']=false;
                }
                $employmentList = SecurityService::employment($user);

                $skills=SecurityService::skills($user);
                $name=SecurityService::getMemberName($user);
                $data = ['username' => $email, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];
                return view("home")->with($data);
            }
            else{
                return view("loginFailed");
            }

        }









    }

    public function home(){
        session_start();
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $gender = $_SESSION['gender'];

            $education = $_SESSION['education'];
            $age = $_SESSION['age'];
            $employer = $_SESSION['employer'];
        $user = new UserModel($password,$username);
        $name=SecurityService::getMemberName($user);

        $employmentList = SecurityService::employment($user);

        $skills=SecurityService::skills($user);
        $data = ['username' => $username, 'password' => $password, 'age' => $age, 'gender' => $gender, 'education' => $education, 'employer' => $employer, 'name' => $name, 'employmentList' => $employmentList, 'skillsList'=>$skills];



            return view("home")->with($data);


    }
}
