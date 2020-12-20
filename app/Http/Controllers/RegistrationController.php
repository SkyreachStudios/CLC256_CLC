<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\MemberModel;
use App\Services\Business\SecurityService;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $inputs = request()->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'password-confirm'=>'required'
        ]);


        (new \App\Services\Utility\Logger2)->info("Entering RegistrationController::index()");
        if(isset($_SESSION)){
            session_destroy();
        }

        $email = $request->input('email');
        $password = $request->input('password');
        $name = $request->input('name');

        $user = new MemberModel($password,$email,$name);


        $employmentList = [];

        $skills=[];

        $data = ['username' => $email, 'password' => $password, 'age'=> 'N/A', 'gender'=>'N', 'education'=>'N/A', 'employer'=>'N/A', 'name'=>$name,'employmentList' => $employmentList, 'skillsList'=>$skills];

        if(SecurityService::register($user)){
            (new \App\Services\Utility\Logger2)->info("Opening Session:Setting session variables");
            session_start();
            unset($_SESSION['admin']);
            $_SESSION['username'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['loggedIn'] = 1;
            $_SESSION['age']="N/A";
            $_SESSION['gender']="N/A";
            $_SESSION['education']="N/A";
            $_SESSION['employer']="N/A";


            (new \App\Services\Utility\Logger2)->info("User registration successful. Navigated to new user home page.");
            return view("home")->with($data);
        }
        else{
            (new \App\Services\Utility\Logger2)->info("New user registration failed.");
            return view("registerFailed");
        }

    }
}
