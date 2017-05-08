<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 28-3-2017
 * Time: 10:07
 */
class DbCase extends Database
{
    public function create(CaseClass $case)
    {
        $sql = "INSERT INTO `cases` (`subject`,`client`,`user`,`endDate`,`description`,`status`, `project`,`assignment`) VALUES('{$case->getSubject()}','{$case->getClient()}','{$case->getUser()}','{$case->getEndDate()}','{$case->getDescription()}','{$case->getStatus()}','{$case->getProject()}','{$case->getAssignment()}')";
        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
    }

    public function update(CaseClass $case)
    {
        $sql = "UPDATE `cases` SET `subject` = '{$case->getSubject()}', `client` = '{$case->getClient()}',`user` = '{$case->getUser()}', `endDate` = '{$case->getEndDate()}', `description` = '{$case->getDescription()}', `status` = '{$case->getStatus()}', `project` = '{$case->getProject()}',`assignment` = '{$case->getAssignment()}' WHERE `id` = '{$case->getCaseId()}'";
        if($this->dbQuery($sql)){
            return true;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `cases` WHERE `id` = '{$id}'";

        if ($result = $this->dbQuery($sql)) {
            return true;
        }
        return false;
    }

    public function getCaseById($id)
    {
        $sql = "SELECT * FROM `cases` WHERE `id` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if ($endResult) {
            return $endResult;
        }
    }

    public function getAllCases()
    {
        $sql = "SELECT * FROM `cases`";
        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($endResult) {
            return $endResult;
        }
    }

    public function getCasesByUserId($userId)
    {
        $sql = "SELECT * FROM `cases` WHERE `user` = {$userId}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function getCasesByStatus($status)
    {
        $sql = "SELECT * FROM `cases` WHERE `status` = {$status}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function assignUser($user, $id){
        $status = 1;
        $sql = "UPDATE `cases` SET `user` = '{$user}', `status` = '{$status}' WHERE `id` = {$id}";
        $this->dbQuery($sql);
    }
}