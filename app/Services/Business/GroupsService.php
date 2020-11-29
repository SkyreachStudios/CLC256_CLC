<?php


namespace App\Services\Business;


use App\Models\EmploymentModel;
use App\Models\groupModel;
use App\Models\jobModel;
use App\Models\MemberInfoModel;
use App\Models\MemberModel;
use App\Models\memberProfileModel;
use App\Models\SkillsModel;
use App\Models\UserModel;
use App\Services\Data\groupsDAO;
use App\Services\Data\JobsDAO;
use App\Services\Data\SecurityDao;

class GroupsService
{
    public static function getGroups(){
       return groupsDAO::getAllGroups();
    }
    public static function updateGroup(groupModel $group){
        groupsDAO::updateGroup($group);

    }

    public static function addGroup(groupModel $group){
        groupsDAO::addGroup($group);

    }

    public static function deleteGroup(int $id){
        groupsDAO::deleteGroup($id);

    }

    public static function getMembers(int $id){
        return groupsDAO::getGroupMembers($id);
    }

    public static function getByID(int $id){
        return groupsDAO::getGroupByID($id);
    }

    public static function checkIfMember($email, $groupID){


        return groupsDAO::checkMemberStatus($email, $groupID);
    }

    public static function joinGroup($email,$id){
         groupsDAO::joinGroup($email,$id);
    }

    public static function leaveGroup($email,$id){
        groupsDAO::leaveGroup($email,$id);
    }








}
