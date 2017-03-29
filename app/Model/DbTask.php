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
        $sql = "INSERT INTO `tasks` (`subject`, `client`, `user`,  `project`, `assignment`, `enddate`, `urgency`, `description`, `duration`, `status`) VALUES('{$task->getSubject()}', '{$task->getClient()}', '{$task->getUser()}', '{$task->getProject()}', '{$task->getAssignment()}', '{$task->getEndDate()}', '{$task->getUrgency()}', '{$task->getDescription()}', '{$task->getDuration()}', '{$task->getStatus()}')";

        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
    }

    public function update(Task $task)
    {
        $sql = "UPDATE `tasks` SET `subject` = '{$task->getSubject()}', `client` = '{$task->getClient()}',`user` = '{$task->getUser()}', `project` = '{$task->getProject()}', `assignment` = '{$task->getAssignment()}', `urgency` = '{$task->getUrgency()}', `duration` = '{$task->getDuration()}', `enddate` = '{$task->getEndDate()}', `description` = '{$task->getDescription()}' , `status` = '{$task->getStatus()}' WHERE `id` = '{$task->getTaskId()}'";
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

    public function getTendersByUserId($userId)
    {
        $sql = "SELECT * FROM `tenders` WHERE `user` = {$userId}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    public function getTasksByStatus($status)
    {
        $sql = "SELECT * FROM `tasks` WHERE `status` = {$status}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }
}