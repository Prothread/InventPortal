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
        $this->dbQuery($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `assignments` WHERE `id` = '{$id}'";

        if ($result = $this->dbQuery($sql)) {
            return true;
        }
        return false;
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

    public function getTimeDifference($date1, $date2)
    {
        $d1 = new DateTime($date1);
        $d2 = new DateTime($date2);
        return $diff = $d1->diff($d2)->format("%a");
    }

    public function getAssignmentsByStatus($status)
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

}