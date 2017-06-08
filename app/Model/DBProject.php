<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 24-3-2017
 * Time: 09:09
 */
class DbProject extends Database
{
    public function create(Project $project)
    {
        $sql = "INSERT INTO `projects` (`subject`,`client`,`user`,`endDate`,`description`,`status`) VALUES('{$project->getSubject()}','{$project->getClient()}','{$project->getUser()}','{$project->getEndDate()}','{$project->getDescription()}','{$project->getStatus()}')";
        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
    }

    public function update(Project $project)
    {
        $sql = "UPDATE `projects` SET `subject` = '{$project->getSubject()}', `client` = '{$project->getClient()}',`user` = '{$project->getUser()}', `endDate` = '{$project->getEndDate()}', `description` = '{$project->getDescription()}', `status` = '{$project->getStatus()}' WHERE `id` = '{$project->getProjectId()}'";
        if($this->dbQuery($sql)){
            return true;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `projects` WHERE `id` = '{$id}'";
        $this->dbQuery($sql);
        $sql = "DELETE FROM `logs` WHERE `linkType` = 2 AND `linkId` = '{$id}'";
        $this->dbQuery($sql);
        $sql = "DELETE FROM `notes` WHERE `linkType` = 2 AND `linkId` = '{$id}'";
        $this->dbQuery($sql);
        return true;
    }

    public function getProjectById($id)
    {
        $sql = "SELECT * FROM `projects` WHERE `id` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if ($endResult) {
            return $endResult;
        }
    }

    public function getAllProjects()
    {
        $sql = "SELECT * FROM `projects`";
        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($endResult) {
            return $endResult;
        }
    }

    public function getProjectsByUserId($userId)
    {
        $sql = "SELECT * FROM `projects` WHERE `user` = {$userId}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function getProjectsByStatus($status)
    {
        $sql = "SELECT * FROM `projects` WHERE `status` = {$status}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function assignUser($user, $id){
        $status = 1;
        $sql = "UPDATE `projects` SET `user` = '{$user}', `status` = '{$status}' WHERE `id` = {$id}";
        $this->dbQuery($sql);
    }

    public function getAllProjectsByStatus($status){
        $sql = "SELECT * FROM `projects` WHERE `status` = {$status}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function updateStatus($id, $status){
        $sql = "UPDATE `projects` SET `status` = {$status} WHERE `id` = {$id}";
        $this->dbQuery($sql);
    }
}