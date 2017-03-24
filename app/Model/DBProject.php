<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 24-3-2017
 * Time: 09:09
 */
class DBProject extends Database
{
    public function create(Project $project){
        $sql = "INSERT INTO `projects` (`subject`,`client`,`user`,`endDate`,`description`) VALUES('{$project->getSubject()}','{$project->getClient()}','{$project->getUser()}','{$project->getEndDate()}','{$project->getDescription()}')";
        if($this->dbQuery($sql)){
            return $this->dbLastInsertedId();
        }
    }

    public function update(Project $project){
        //Update function
        //=============================================
    }

    public function delete($id){
        //Delete function
        //=============================================
    }

    public function getProjectById($id){
        $sql = "SELECT * FROM `projects` WHERE `id` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if($endResult){
            return $endResult;
        }
    }

    public function getAllProjects(){
        //=============================================
    }

    public function getProjectsByUserId($userId){
        //=============================================
    }
    public function dbLastInsertedId(){
        return  $this->connection->insert_id;
    }
}