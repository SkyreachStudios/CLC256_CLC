<?php


namespace App\Services\Data;


use App\Models\EmploymentModel;
use App\Models\groupMemberModel;
use App\Models\groupModel;
use App\Models\jobModel;
use App\Models\MemberInfoModel;
use App\Models\MemberModel;
use App\Models\memberProfileModel;
use App\Models\SkillsModel;
use App\Models\UserModel;
use App\Services\Business\SecurityService;
use App\User;
use PDO;
use PDOException;

class groupsDAO
{


    public static function getAllGroups()
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT * FROM groups";
            $result = $conn->query($stmt);
            $groups=$result->fetchAll();

$groupsList=[];
                if ($result->rowCount() > 0) {
                    //jobs exist
                    for($i=0; $i<$result->rowCount();$i++){
                        $members = self::getGroupMembers($groups[$i][0]);
                        $group=new groupModel($groups[$i][0], $groups[$i][1],$groups[$i][2], $members);
                        $groupsList[$i]=$group;
                    }


                    return $groupsList;
                } else {
                    //no groups
                    return $groupsList;


                }




        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }

    public static function getGroupByID(int $id)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";




        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT * FROM groups WHERE ID LIKE '$id'";
            $result = $conn->query($stmt);
            $groups=$result->fetchAll();


            if ($result->rowCount() > 0) {

                    $members=[];
                    $group=new groupModel($groups[0][0], $groups[0][1],$groups[0][2], $members);
                    return $group;

            } else {
                //no groups
                echo "No groups found matching those credentials";



            }




        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }



    public static function getGroupMembers(int $groupID)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT * FROM groupmembers WHERE group_ID LIKE '$groupID'";
            $result = $conn->query($stmt);
            $groupMembers=$result->fetchAll();

            $groupMemberList=[];
            if ($result->rowCount() > 0) {
                //jobs exist
                for($i=0; $i<$result->rowCount();$i++){
                    $member = new groupMemberModel($groupMembers[$i][0],$groupMembers[$i][1],$groupMembers[$i][2],$groupMembers[$i][3]);
                    $groupMemberList[$i]=$member;
                }


                return $groupMemberList;
            } else {
                //echo "Wrong login data or there was an error";
                return $groupMemberList;

            }




        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }

    public static function addGroup(groupModel $group)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";


        //get group data
        $groupID="0";
        $gName = $group->getName();
        $gDesc=$group->getDesc();





        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $insert = "INSERT INTO groups( groupName, groupDesc) VALUES ('$gName','$gDesc')";
            $conn->query($insert);
            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }



}

    public static function updateGroup(groupModel $group){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";

        //get group data
        $groupID=$group->getId();
        $gName = $group->getName();
        $gDesc=$group->getDesc();


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





            $memberStmnt = "UPDATE `groups` SET `groupName`='$gName',`groupDesc`='$gDesc'WHERE `ID` LIKE '$groupID'";

            $conn->query($memberStmnt);
            return true;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }

    public static function deleteGroup(int $id){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";





        //get member info



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $memberStmnt = "DELETE FROM `groups` WHERE `ID` LIKE '$id'";

            $results1=$conn->query($memberStmnt);



            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }

    public static function checkMemberStatus($email, $groupID){

        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT * FROM groupmembers WHERE user_email LIKE '$email' AND group_ID LIKE '$groupID'";
            $result = $conn->query($stmt);

            if($result->rowCount()>0){
                //is a member of this group

                return 1;
            }
            else{

                //not a member
                return 0;
            }




        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }

    public static function joinGroup($email,$groupID){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id=self::getMemberID($email);

            $insert = "INSERT INTO groupmembers( group_ID, user_ID, user_email) VALUES ('$groupID','$id','$email')";
            $conn->query($insert);
            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }

    public static function getMemberID($email){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port = "3306";



        $userID = 0;


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



            //echo "Connected successfully";
            $stmt = "SELECT ID FROM users WHERE email LIKE '$email'";
            $result = $conn->query($stmt);


            if ($result->rowCount() > 0) {
                $userID = $result->fetch();

                return $userID[0];
            } else {
                echo "the given email was: " .$email;
                echo "did not find a matching user id";


            }


        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }

    public static function leaveGroup($email, $id){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $memberStmnt = "DELETE FROM `groupmembers` WHERE `group_ID` LIKE '$id' AND `user_email` LIKE '$email' ";

            $results1=$conn->query($memberStmnt);



            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }



}
