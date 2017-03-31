<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 24-3-2017
 * Time: 09:01
 */
class DbTender extends Database
{
    /**
     * @param Tender $tender
     * @return int
     */

    public function create(Tender $tender)
    {
        $sql = "INSERT INTO `tenders` (`subject`, `client`, `user`,  `validity`, `value`, `chance`, `creationdate`, `description`, `status`, `enddate`) VALUES('{$tender->getSubject()}', '{$tender->getClient()}', '{$tender->getUser()}', '{$tender->getValidity()}', '{$tender->getValue()}', '{$tender->getChance()}', '{$tender->getCreationDate()}', '{$tender->getDescription()}', '{$tender->getStatus()}', '{$tender->getEndDate()}')";

        $this->dbQuery($sql);
        return $this->dbLastInsertedId();
    }

    /**
     * @return int
     */

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    /**
     * @return array|null
     */

    public function getAllTenders()
    {
        $sql = "SELECT * FROM `tenders`";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($value) {
            return $value;
        }
    }

    /**
     * @param $id
     *
     * @return array|null
     */

    public function getTenderById($id)
    {
        $sql = "SELECT * FROM `tenders` WHERE `id` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if ($endResult) {
            return $endResult;
        }
    }

    /**
     * @param $userId
     *
     * @return array|null
     */

    public function getTendersByUserId($userId)
    {
        $sql = "SELECT * FROM `tenders` WHERE `user` = {$userId}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    /**
     * @param $status
     *
     * @return array|null
     */

    public function getTendersByStatus($status)
    {
        $sql = "SELECT * FROM `tenders` WHERE `status` = {$status}";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }

    /**
     * @param Tender $tender
     */

    public function update(Tender $tender)
    {
        $sql = "UPDATE `tenders` SET `subject` = '{$tender->getSubject()}', `client` = '{$tender->getClient()}',`user` = '{$tender->getUser()}', `validity` = '{$tender->getValidity()}', `description` = '{$tender->getDescription()}', `status` = '{$tender->getStatus()}', `value` = '{$tender->getValue()}', `chance` = '{$tender->getChance()}', `enddate` = '{$tender->getEndDate()}' WHERE `id` = '{$tender->getTenderId()}'";
        $this->dbQuery($sql);
    }

    /**
     * @param $id
     *
     * @return bool
     */

    public function delete($id)
    {
        $sql = "DELETE FROM `tenders` WHERE `id` = '{$id}'";

        if ($result = $this->dbQuery($sql)) {
            return true;
        }
        return false;
    }

    public function assignUser($user, $id){
        $status = 1;
        $sql = "UPDATE `tenders` SET `user` = '{$user}', `status` = '{$status}' WHERE `id` = {$id}";
        $this->dbQuery($sql);
    }

}