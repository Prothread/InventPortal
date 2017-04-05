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
}