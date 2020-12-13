<?php


namespace App\Services\Business;


use App\Models\EmploymentModel;
use App\Models\jobModel;
use App\Models\MemberInfoModel;
use App\Models\MemberModel;
use App\Models\memberProfileModel;
use App\Models\SkillsModel;
use App\Models\UserModel;
use App\Services\Data\JobsDAO;
use App\Services\Data\SecurityDao;

class JobsService
{
    public static function getJobs(){
       return JobsDAO::getAllJobs();
    }
    public static function updateJob(jobModel $job){
        return JobsDAO::updateJob($job);
    }

    public static function addJob(jobModel $job){
        JobsDAO::addJob($job);
    }

    public static function deleteJob(int $id){
        JobsDAO::deleteJob($id);
    }

    public static function searchJobs($searchTerm){
       return JobsDAO::searchForJobs($searchTerm);
    }

    public static function findJobByID($id){
        return JobsDAO::findJobByID($id);
    }








}
