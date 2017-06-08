<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 5-4-2017
 * Time: 12:00
 */
class DbTemplate extends Database
{
    public function create(Template $template)
    {
        $sql = "INSERT INTO `template` (`onderwerp`, `beschrijving`) VALUES('{$template->getSubject()}','{$template->getDescription()}')";

        $this->dbQuery($sql);
        return $this->dbLastInsertedId();

    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function getAllTemplates()
    {
        $sql = "SELECT * FROM `template`";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($value) {
            return $value;
        }
    }

    public function getTemplateById($id){
        $sql = "SELECT * FROM `template` WHERE `id` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if ($endResult) {
            return $endResult;
        }
    }

    public function update(Template $template)
    {
        $sql = "UPDATE `template` SET `subject` = '{$template->getSubject()}', `description` = '{$template->getDescription()}' WHERE `id` = '{$template->getTemplateId()}'";
        if($this->dbQuery($sql)){
            return true;
        }
    }

    public function delete($id){
        $sql = "DELETE FROM `template` WHERE `id` = {$id}";
        $this->dbQuery($sql);
        $sql = "DELETE FROM `template_task_links` WHERE `idTemplate` = {$id}";
        $this->dbQuery($sql);
    }
}