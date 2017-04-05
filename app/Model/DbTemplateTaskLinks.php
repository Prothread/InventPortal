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

}