<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 24-3-2017
 * Time: 09:01
 */
class DbTender extends Database
{
    public function create(Tender $tender)
    {
        $sql = "INSERT INTO `tenders` (`subject`, `client`, `user`,  `validity`, `value`, `chance`, `creationdate`, `description`, `status`, `enddate`) VALUES('{$tender->getSubject()}', '{$tender->getClient()}', '{$tender->getUser()}', '{$tender->getValidity()}', '{$tender->getValue()}', '{$tender->getChance()}', '{$tender->getCreationDate()}', '{$tender->getDescription()}', '{$tender->getStatus()}', '{$tender->getEndDate()}')";

        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
    }

    public function update(Tender $tender)
    {
        $sql = "UPDATE `tenders` SET `subject` = '{$tender->getSubject()}', `client` = '{$tender->getClient()}',`user` = '{$tender->getUser()}', `validity` = '{$tender->getValidity()}', `description` = '{$tender->getDescription()}', `status` = '{$tender->getStatus()}', `value` = '{$tender->getValue()}', `chance` = '{$tender->getChance()}', `enddate` = '{$tender->getEndDate()}' WHERE `id` = '{$tender->getTenderId()}'";
        $this->dbQuery($sql);
    }
//
    public function delete($id)
    {
        $sql = "DELETE FROM `tenders` WHERE `id` = '{$id}'";

        if ($result = $this->dbQuery($sql)) {
            return true;
        }
        return false;
    }
//
//    public function getTender(Tender $tender)
//    {
//        $email = $tender->getEmail();
//        $password = hash('sha256', $tender->getPassword());
//
//        $sql = "SELECT * FROM users WHERE email = '" . $email . "' and paswoord = '" . $password . "'";
//
//        if ($result = $this->dbQuery($sql)) {
//            return $result;
//        }
//    }
    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function getLastTenderId(){
        $sql = "SELECT `id` FROM `tenders` ORDER BY `id` DESC LIMIT 1";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if ($value) {
            return $value;
        }
    }

    public function getAllTenders(){
        $sql = "SELECT * FROM `tenders`";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($value) {
            return $value;
        }
    }

    public function getTenderById($id){
        $sql = "SELECT * FROM `tenders` WHERE `id` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if($endResult){
            return $endResult;
        }
    }
}