<?php


namespace App\Services\Data;


use App\Models\EmploymentModel;
use App\Models\MemberInfoModel;
use App\Models\MemberModel;
use App\Models\memberProfileModel;
use App\Models\SkillsModel;
use App\Models\UserModel;
use App\User;
use App\Services\Utility\Logger;
use PDO;
use PDOException;

class SecurityDAO
{
    //finds user by email
    public static function findByUser(UserModel $user)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";
        $email = $user->get_email();
        $password = $user->get_password();


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            (new \App\Services\Utility\Logger)->info("Executing findByUser(). Searching for given user in database.");


            //echo "Connected successfully";
            $stmt = "SELECT * FROM users WHERE email LIKE '$email' AND password LIKE '$password'";
            $result = $conn->query($stmt);
            if(self::checkSuspended($user)) {


                if ($result->rowCount() > 0) {
                    //echo "Login Success!";
                    (new \App\Services\Utility\Logger)->info("Valid user input! Proceeding with action.");


                    return true;
                } else {
                    //echo "Wrong login data or there was an error";
                    (new \App\Services\Utility\Logger)->info("Invalid user input. Redirecting to failed login.");

                    Log::info("Invalid user input. Redirecting to failed login.");

                    return false;
                }

            }


        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            (new \App\Services\Utility\Logger)->error("Exception SecurityDAO::findByUser()" . $e->getMessage());


        }

    }
    //gets all users in the database
    public static function getAllUsers()
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
            $stmt = "SELECT * FROM users";
            $result = $conn->query($stmt);
            $users=$result->fetchAll();


                if ($result->rowCount() > 0) {
                    //echo "Login Success!";

                    return $users;
                } else {
                    //echo "Wrong login data or there was an error";


                }




        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }
    //checks if a user account is suspended on login.
    public static function checkSuspended(UserModel $user){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";
        $email = $user->get_email();
        $password = $user->get_password();


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT suspended FROM users WHERE email LIKE '$email'";
            $result = $conn->query($stmt);
            $suspesionStatus= $result->fetch();
            if($suspesionStatus[0] =='0'){
                //echo "Login Success!";


                return true;
            }
            else{
                echo"$suspesionStatus[0]" ;
                echo "this account has been suspended! Please contact an administrator for assistance.";
                //echo "Wrong login data or there was an error";
                return false;
            }




        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }
    //checks if the given user is an admin
    public static function checkIfAdmin(UserModel $user){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";
        $email = $user->get_email();



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT admin FROM users WHERE email LIKE '$email'";
            $result = $conn->query($stmt);
            $adminStatus= $result->fetch();
            if($adminStatus[0] =='0'){
                //echo "Login Success!";


                return false;
            }
            else{
                //this user is an admin;
                return true;
            }




        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }

    //register a new user
    public static function registerUser(MemberModel $user)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";
        $email = $user->get_email();
        $password = $user->get_password();
        $name = $user->get_name();



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT * FROM users WHERE email LIKE '$email'";
            $result = $conn->query($stmt);

            if($result->rowCount() >0){
                //echo "Login Success!";
                echo "<br>";
                echo "email in use";
                return false;
            }
            else{
                //echo "Wrong login data or there was an error";
                echo "<br>";
                $insertStmnt= "INSERT INTO users(name,email,password,admin,suspended) VALUES ('$name','$email','$password','0','0')";
                if($conn->query($insertStmnt)){
                    $userModel=new UserModel($password,$email);
                    $userID = self::findUserID($userModel);

                    $insert = "INSERT INTO member_info( USERID, AGE, GENDER, EDUCATION, EMPLOYER) VALUES ('$userID','0','N','NA','NA')";
                    $conn->query($insert);
                    return true;
                }
                else{
                    echo "Error: " . $insertStmnt . "<br>" . $conn->error;
                }

            }




        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }
    //gets the user ID on the given user
    public static function findUserID(UserModel $user)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port = "3306";
        $email = $user->get_email();


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
    //gets the name of the given user
    public static function getUserName(UserModel $user)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port = "3306";
        $email = $user->get_email();
        $password = $user->get_password();

        $userName = "";


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT name FROM users WHERE email LIKE '$email'";
            $result = $conn->query($stmt);


            if ($result->rowCount() > 0) {
                $userName = $result->fetch();

                return $userName[0];
            } else {



            }


        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }
    //gets the member profile information for the given user
    public static function getMemberInfo(UserModel $user)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port = "3306";
        $userID = self::findUserID($user);




        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT * FROM member_info WHERE USERID LIKE '$userID'";
            $result = $conn->query($stmt);


            if ($result->rowCount() > 0) {
                $memberInfo = $result->fetch();
                return new MemberInfoModel($memberInfo[2], $memberInfo[3],$memberInfo[4],$memberInfo[5]);
            } else {



            }


        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }
    //updates user data
    public static function updateInfo(MemberInfoModel $memberInfo, MemberModel $member){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";

        //get member data
        $email = $member->get_email();
        $password = $member->get_password();
        $name = $member->get_name();

        $currentUsername = $_SESSION['username'];

        //get member info
        $age = $memberInfo->get_age();
        $gender = $memberInfo->get_gender();
        $education = $memberInfo->get_education();
        $employer = $memberInfo->get_employer();


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $memberStmnt = "UPDATE `users` SET `name`='$name',`email`='$email',`password`='$password'WHERE `email` LIKE '$currentUsername'";

            $results1=$conn->query($memberStmnt);
            $user = new UserModel($password,$email);

            $userID = self::findUserID($user);
            $memberInfoStmt = "UPDATE `member_info` SET `AGE`='$age',`GENDER`='$gender',`EDUCATION`= '$education',`EMPLOYER`= '$employer' WHERE `USERID` LIKE '$userID' ";
            $result2 = $conn->query($memberInfoStmt);


            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }


    public static function adminUpdate(memberProfileModel $memberProfileModel){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";

        //get member data
        $email = $memberProfileModel->get_email();
        $password = $memberProfileModel->get_password();
        $name = $memberProfileModel->get_name();
        $admin = $memberProfileModel->get_Admin();
        $suspended = $memberProfileModel->get_Suspended();
        $id = $memberProfileModel->get_id();



        //get member info



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $memberStmnt = "UPDATE `users` SET `name`='$name',`email`='$email',`password`='$password' ,`admin`='$admin',`suspended`='$suspended'WHERE `id` LIKE '$id'";

            $results1=$conn->query($memberStmnt);



            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }

    public static function adminDelete(memberProfileModel $memberProfileModel){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";

        //get member data
        $email = $memberProfileModel->get_email();
        $password = $memberProfileModel->get_password();
        $name = $memberProfileModel->get_name();
        $admin = $memberProfileModel->get_Admin();
        $suspended = $memberProfileModel->get_Suspended();
        $id = $memberProfileModel->get_id();



        //get member info



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $memberStmnt = "DELETE FROM `users` WHERE `id` LIKE '$id'";

            $results1=$conn->query($memberStmnt);



            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }


    public static function getEmploymentHistory(UserModel $user){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port = "3306";


        $id=self::findUserID($user);




        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT * FROM employment_history WHERE user_ID LIKE '$id'";
            $result = $conn->query($stmt);




            if ($result->rowCount() > 0) {
                //convert to list of employment history objects to be passed on
                $resultFetch = $result->fetchAll();

                $employment = [];
                for($i=0;$i<$result->rowCount();$i++){
                    $employer=new EmploymentModel($resultFetch[$i][0],$resultFetch[$i][1],$resultFetch[$i][2],$resultFetch[$i][3],$resultFetch[$i][4],$resultFetch[$i][5],$resultFetch[$i][6]);
                    $employment[$i]=$employer;
                }



                return $employment;
            } else {



            }


        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }

    public static function updateEmploymentData(EmploymentModel $employer){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";

        //get employer data
        $id=$employer->get_ID();
        $userID=$employer->get_userID();
        $company=$employer->get_company();
        $position=$employer->get_position();
        $start=$employer->get_startDate();
        $end=$employer->get_endDate();
        $desc=$employer->get_description();



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $memberStmnt = "UPDATE `employment_history` SET `company`='$company',`position`='$position',`start_date`='$start',`end_date`='$end',`description`='$desc'WHERE `ID` LIKE '$id' AND `user_ID`LIKE '$userID'";

            $conn->query($memberStmnt);


            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }

    public static function deleteEmployment(int $id){
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
            $memberStmnt = "DELETE FROM `employment_history` WHERE `id` LIKE '$id'";

            $results1=$conn->query($memberStmnt);



            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }


    public static function addEmployer(EmploymentModel $employer)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";


        //get employer data
        $id=$employer->get_ID();
        $userID=$employer->get_userID();
        $company=$employer->get_company();
        $position=$employer->get_position();
        $start=$employer->get_startDate();
        $end=$employer->get_endDate();
        $desc=$employer->get_description();


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $insert = "INSERT INTO employment_history( user_ID, company, `position`, start_date, end_date,description) VALUES ('$userID','$company','$position','$start','$end','$desc')";
                    $conn->query($insert);
                    return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }

    //skill rating coding elements

    public static function getSkills(UserModel $user){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port = "3306";


        $id=self::findUserID($user);




        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $stmt = "SELECT * FROM skills WHERE userID LIKE '$id'";

            $result = $conn->query($stmt);




            if ($result->rowCount() > 0) {
                //convert to list of skill objects to be passed on
                $resultFetch = $result->fetchAll();

                $skills = [];
                for($i=0;$i<$result->rowCount();$i++){
                    $skill=new SkillsModel($resultFetch[$i][0],$resultFetch[$i][1],$resultFetch[$i][2],$resultFetch[$i][3]);
                    $skills[$i]=$skill;
                }



                return $skills;
            } else {



            }


        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }

    public static function updateSkill(SkillsModel $skill){
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";

        //get skill data
        $id=$skill->get_ID();
        $userID=$skill->get_userID();
        $skillName=$skill->get_skillName();
        $skillRating=$skill->get_skillRating();



        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //echo "Connected successfully";
            $memberStmnt = "UPDATE `skills` SET `skillName`='$skillName',`skillRating`='$skillRating' WHERE `ID` LIKE '$id' AND `userID`LIKE '$userID'";

            $conn->query($memberStmnt);


            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }

    public static function deleteSkill(int $id){
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
            $memberStmnt = "DELETE FROM `skills` WHERE `id` LIKE '$id'";

            $results1=$conn->query($memberStmnt);



            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
    }


    public static function addSkill(SkillsModel $skill)
    {
        $servername = "localhost";
        $username1 = "root";
        $password1 = "root";
        $port="3306";


        //get skill data
        $id=$skill->get_ID();
        $userID=$skill->get_userID();
        $skillName=$skill->get_skillName();
        $skillRating=$skill->get_skillRating();


        try {
            $conn = new PDO("mysql:host=$servername;dbname=clc", $username1, $password1);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $insert = "INSERT INTO skills( userID, skillName, skillRating) VALUES ('$userID','$skillName','$skillRating')";
            $conn->query($insert);
            return true;







        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }

    }

}
