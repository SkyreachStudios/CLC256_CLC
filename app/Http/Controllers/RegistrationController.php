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
        if(isset($_SESSION)){
            session_destroy();
        }

        $email = $request->input('email');
        $password = $request->input('password');
        $name = $request->input('name');

        $user = new MemberModel($password,$email,$name);
        session_start();


        $employmentList = [];

        $skills=[];

        $data = ['username' => $email, 'password' => $password, 'age'=> '0', 'gender'=>'N', 'education'=>'N/A', 'employer'=>'N/A', 'name'=>$name,'employmentList' => $employmentList, 'skillsList'=>$skills];

        if(SecurityService::register($user)){

            return view("home")->with($data);
        }
        else{
            return view("registerFailed");
        }


        //echo "Welcome back " . $username;
        //echo '<br>';




        //returns login view
        //return view('thatswhoiam')->with($data);

    }
}
