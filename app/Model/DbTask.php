<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 28-3-2017
 * Time: 15:21
 */
class DbTask extends Database
{
    public function create(Task $task)
    {
        $sql = "INSERT INTO `tasks` (`subject`, `client`, `user`,  `project`, `assignment`, `endDate`, `urgency`, `description`, `duration`, `status`, `tender`, `cases`) VALUES('{$task->getSubject()}', '{$task->getClient()}', '{$task->getUser()}', '{$task->getProjectId()}', '{$task->getAssignment()}', '{$task->getEndDate()}', '{$task->getUrgency()}', '{$task->getDescription()}', '{$task->getDuration()}', '{$task->getStatus()}', '{$task->getTender()}', '{$task->getCases()}')";
        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
    }

    public function createDefault(Task $task)
    {
        $sql = "INSERT INTO `tasks` (`subject`, `description`, `duration`, `status`) VALUES('{$task->getSubject()}', '{$task->getDescription()}', '{$task->getDuration()}', '{$task->getStatus()}')";

        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
    }

    public function update(Task $task)
    {
        $sql = "UPDATE `tasks` SET `tender` = '{$task->getTender()}', `subject` = '{$task->getSubject()}', `client` = '{$task->getClient()}',`user` = '{$task->getUser()}', `project` = '{$task->getProjectId()}', `assignment` = '{$task->getAssignment()}', `urgency` = '{$task->getUrgency()}', `duration` = '{$task->getDuration()}', `endDate` = '{$task->getEndDate()}', `description` = '{$task->getDescription()}' , `status` = '{$task->getStatus()}' , `cases` = '{$task->getCases()}' WHERE `id` = '{$task->getTaskId()}'";
        if($this->dbQuery($sql)){
            return true;
        }
    }

    public function updateDefault(Task $task)
    {
        $sql = "UPDATE `tasks` SET `subject` = '{$task->getSubject()}', `duration` = '{$task->getDuration()}', `description` = '{$task->getDescription()}' WHERE `id` = '{$task->getTaskId()}'";
        $this->dbQuery($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `tasks` WHERE `id` = '{$id}'";

        if ($result = $this->dbQuery($sql)) {
            return true;
        }
        return false;
    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function getLastTenderId()
    {
        $sql = "SELECT `id` FROM `tenders` ORDER BY `id` DESC LIMIT 1";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if ($value) {
            return $value;
        }
    }

    public function getAllTasks()
    {
        $sql = "SELECT * FROM `tasks`";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($value) {
            return $value;
        }
    }

    public function getTaskById($id)
    {
        $sql = "SELECT * FROM `tasks` WHERE `id` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if ($endResult) {
            return $endResult;
        }
    }

    public function getTasksByUserId($userId)
    {
        $sql = "SELECT * FROM `tasks` WHERE `user` = {$userId}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function assignUser($user, $id){
        $status = 1;
        $sql = "UPDATE `tasks` SET `user` = '{$user}', `status` = '{$status}' WHERE `id` = {$id}";
        $this->dbQuery($sql);
    }

    public function getTasksByLinkId($type, $id){
        if($type == 'case'){
            $sql = "SELECT * FROM `tasks` WHERE `{$type}s` = {$id}";
        }else {
            $sql = "SELECT * FROM `tasks` WHERE `{$type}` = {$id}";
        }
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function getAllTasksByStatus($status){
        $sql = "SELECT * FROM `tasks` WHERE `status` = {$status}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }
}