<?php


namespace App\Services\Business;


use App\Models\EmploymentModel;
use App\Models\MemberInfoModel;
use App\Models\MemberModel;
use App\Models\memberProfileModel;
use App\Models\SkillsModel;
use App\Models\UserModel;
use App\Services\Data\SecurityDao;

class SecurityService
{
    public static function login(UserModel $user){
        return SecurityDao::findByUser($user);

    }

    public static function register(MemberModel $user){
        return SecurityDao::registerUser($user);
    }

    public static function getMemberInfo(UserModel $user){

        return SecurityDao::getMemberInfo($user);
    }

    public static function getMemberName(UserModel $user){
        return SecurityDao::getUserName($user);
    }

    public static function getMemberID(UserModel $user){
        return SecurityDao::findUserID($user);
    }

     public static function updateInfo(MemberInfoModel $memberInfo, MemberModel $member){

        return SecurityDao::updateInfo($memberInfo,$member);
     }

     public static function checkAdmin(UserModel $user){
        return SecurityDao::checkIfAdmin($user);
     }

     public static function getAllMembers(){
        return SecurityDao::getAllUsers();
}
public static function checkSuspended(UserModel $user){
        return SecurityDao::checkSuspended($user);
}

public static function adminUpdate(memberProfileModel $memberProfileModel){
        SecurityDao::adminUpdate($memberProfileModel);
}

public static function adminDelete(memberProfileModel $memberProfileModel){
       return SecurityDao::adminDelete($memberProfileModel);
}


//employment editing
public static function employment(UserModel $userModel){
        return SecurityDao::getEmploymentHistory($userModel);
}

public static function updateEmployment(EmploymentModel $model){
        return SecurityDao::updateEmploymentData($model);
}

public static function deleteEmployment(int $id){
        SecurityDao::deleteEmployment($id);
}

public static function newEmployer(EmploymentModel $employer){
        SecurityDao::addEmployer($employer);

}
//skills editing
    public static function skills(UserModel $userModel){
        return SecurityDao::getSkills($userModel);
    }

    public static function updateSkill(SkillsModel $skill){
        return SecurityDao::updateSkill($skill);
    }

    public static function deleteSkill(int $id){
        SecurityDao::deleteSkill($id);
    }

    public static function newSkill(SkillsModel $skill){
        SecurityDao::addSkill($skill);

    }






}
