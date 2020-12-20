<?php

namespace App\Http\Controllers;

use App\Models\memberProfileModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class adminController extends Controller
{
    public function index()
    {
        (new \App\Services\Utility\Logger2)->info("Entering admin dashboard...");
            $membersList = SecurityService::getAllMembers();
            $memberProfileList = $this->createUsersList($membersList);
            $data = ['memberProfileList' => $memberProfileList];

            return view('admin')->with($data);






    }

//takes a list of data and creates users from it.
    public function createUsersList($list){
        $userList=[];

        for($i=0;$i<count($list);$i++){
            $user = new UserModel($list[$i][3],$list[$i][2]);
                $userList[$i]=new memberProfileModel($list[$i][0],$list[$i][3],$list[$i][2],$list[$i][1],$list[$i][4],$list[$i][5]);
        }
        return $userList;
    }

    //updates users
    public function update(Request $request){

        (new \App\Services\Utility\Logger2)->info("Gathering data to update");
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $admin = $request->input('admin');
        $suspended = $request->input('suspended');

        $memberToUpdate = new memberProfileModel($id,$password,$email,$name,$admin,$suspended);

        (new \App\Services\Utility\Logger2)->info("Updating user...");
        SecurityService::adminUpdate($memberToUpdate);

        $membersList = SecurityService::getAllMembers();


        $memberProfileList = $this->createUsersList($membersList);


        $data = ['memberProfileList' => $memberProfileList];

        return view('admin')->with($data);



        //echo "Criteria: <br>ID:". $id. "<br> Name: ". $name. "<br> Email: ". $email. "<br> Password: ". $password. "<br> Admin Status: ".$admin. "<br> Suspended?:" .$suspended;
    }

    //delete a user
    public function delete(Request $request){
        (new \App\Services\Utility\Logger2)->info("Gathering data for user to be updated!");
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $admin = $request->input('admin');
        $suspended = $request->input('suspended');

        $memberToDelete = new memberProfileModel($id,$password,$email,$name,$admin,$suspended);

        (new \App\Services\Utility\Logger2)->info("Deleting user...");
        SecurityService::adminDelete($memberToDelete);
        $membersList = SecurityService::getAllMembers();


        $memberProfileList = $this->createUsersList($membersList);


        $data = ['memberProfileList' => $memberProfileList];
        echo "User number: ".$id." was deleted!";

        return view('admin')->with($data);


    }

}
