<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 3-4-2017
 * Time: 08:37
 */
class DbNoteType extends Database
{
    public function create(NoteType $noteType)
    {
        $sql = "INSERT INTO `note_types` (`name`) VALUES('{$noteType->getNoteTypeName()}')";
        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function update(NoteType $noteType)
    {
        $sql = "UPDATE `note_types` SET `name` = '{$noteType->getNoteTypeName()}' WHERE `id` = '{$noteType->getNoteTypeId()}'";
//        return $sql;
        $this->dbQuery($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `note_types` WHERE `id` = '{$id}'";
        $this->dbQuery($sql);
    }

    public function getNoteTypeById($id)
    {
        $sql = "SELECT * FROM `note_type` WHERE '{$id}'";
        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if ($endResult) {
            return $endResult;
        }
        return false;
    }

    public function getNoteTypes()
    {
        $sql = "SELECT * FROM `note_types`";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }
}