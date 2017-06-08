<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 5-4-2017
 * Time: 12:00
 */
class DbTemplateTaskLinks extends Database
{
    public function create(TemplateTaskLinks $TemplateTaskLinks)
    {

        $sql = "INSERT INTO `template_task_links` (`idTemplate`, `idTask`) VALUES('{$TemplateTaskLinks->getIdTemplate()}','{$TemplateTaskLinks->getIdTask()}')";

        $this->dbQuery($sql);
        return $this->dbLastInsertedId();
    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function getTaskAmountByTemplateId($id)
    {
        $sql = "SELECT COUNT(*) FROM `template_task_links` WHERE `idTemplate` = {$id}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);
        return $value;
    }

    public function getTaskByTemplateId($id)
    {
        $sql = "SELECT * FROM `template_task_links` WHERE `idTemplate` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($endResult) {
            return $endResult;
        }
    }

    public function deleteByTemplateId($id)
    {
        $sql = "DELETE FROM `template_task_links` WHERE `idTemplate` = '{$id}'";

        if ($result = $this->dbQuery($sql)) {
            return true;
        }
        return false;
    }

    public function checkDeleteDefaultTask($id){
        $sql = "SELECT `id` FROM `template_task_links` WHERE `idTask` = '{$id}'";
        $ids = $this->dbQuery($sql);
        if(is_null($ids)){
            return true;
        }else{
            return false;
        }
    }
}