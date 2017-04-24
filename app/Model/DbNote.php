<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 30-3-2017
 * Time: 14:23
 */
class DbNote extends Database
{
    public function create(Note $note)
    {
        $sql = "INSERT INTO `notes` (`id`,`linkType`,`linkId`,`noteType`,`eventDate`,`description`,`user`,`creationDate`) VALUES('{$note->getNoteId()}','{$note->getLinkType()}','{$note->getLinkId()}','{$note->getNoteType()}','{$note->getEventDate()}','{$note->getDescription()}','{$note->getUser()}','{$note->getCreationDate()}')";
        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
        return false;
    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function update(Note $note)
    {
        $sql = "UPDATE `notes` SET `linkType` = '{$note->getLinkType()}',`linkId` = '{$note->getLinkId()}',`noteType` = '{$note->getNoteType()}',`eventDate` = '{$note->getEventDate()}',`description` = '{$note->getDescription()}',`user` = '{$note->getUser()}',`creationDate` = '{$note->getCreationDate()}' WHERE `id` = '{$note->getNoteId()}'";
        if ($this->dbQuery($sql)) {
            return true;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `notes` WHERE `id` = '{$id}'";
        $this->dbQuery($sql);
    }

    public function getNoteById($id)
    {
        $sql = "SELECT * FROM `notes` WHERE `id` = '{$id}'";
        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if ($endResult) {
            return $endResult;
        }
        return false;
    }

    public function getNotesByLinkId($linkType, $linkId)
    {
        $sql = "SELECT * FROM `notes` WHERE `linkType` = '{$linkType}' AND `linkId` = '{$linkId}' ORDER BY `creationDate`";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }
}