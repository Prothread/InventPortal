<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 27-3-2017
 * Time: 12:15
 */
class DbAssignment extends Database
{
    public function create(Assignment $assignment)
    {
        $sql = "INSERT INTO `assignments` (`subject`, `client`, `user`, `endDate`, `description`,`project` ,`status`) VALUES('{$assignment->getSubject()}','{$assignment->getClient()}','{$assignment->getUser()}','{$assignment->getendDate()}','{$assignment->getDescription()}','{$assignment->getProject()}','{$assignment->getstatus()}')";
        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
    }

    public function update(Assignment $assignment)
    {
        $sql = "UPDATE `assignments` SET `subject` = '{$assignment->getSubject()}', `client` = '{$assignment->getClient()}', `user` = '{$assignment->getUser()}', `endDate` = '{$assignment->getEndDate()}', `description` = '{$assignment->getDescription()}',`project` = '{$assignment->getProject()}', `status` = '{$assignment->getStatus()}' WHERE `id` = '{$assignment->getAssignmentId()}'";
        if($this->dbQuery($sql)){
            return true;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `assignments` WHERE `id` = '{$id}'";

        $this->dbQuery($sql);
        $sql = "DELETE FROM `logs` WHERE `linkType` = 3 AND `linkId` = '{$id}'";
        $this->dbQuery($sql);
        $sql = "DELETE FROM `notes` WHERE `linkType` = 3 AND `linkId` = '{$id}'";
        $this->dbQuery($sql);
        return true;
    }

    public function getAssignmentById($id)
    {
        $sql = "SELECT * FROM `assignments` WHERE `id` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if ($endResult) {
            return $endResult;
        }
    }

    public function getAllAssignments()
    {
        $sql = "SELECT * FROM `assignments`";
        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($endResult) {
            return $endResult;
        }
    }

    public function getAssignmentsByUserId($userId)
    {
        $sql = "SELECT * FROM `assignments` WHERE `user` = {$userId}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function getAllAssignmentsByStatus($status)
    {
        $sql = "SELECT * FROM `assignments` WHERE `status` = {$status}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function assignUser($user, $id){
        $status = 1;
        $sql = "UPDATE `assignments` SET `user` = '{$user}', `status` = '{$status}' WHERE `id` = {$id}";
        $this->dbQuery($sql);
    }

    public function getAssignmentByProjectId($id){
        $sql = "SELECT * FROM `assignments` WHERE `project` = {$id}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function updateStatus($id, $status){
        $sql = "UPDATE `assignments` SET `status` = {$status} WHERE `id` = {$id}";
        $this->dbQuery($sql);
    }

}