<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 11-4-2017
 * Time: 15:57
 */
class DBLog extends Database
{
    public function create(log $log){
        $sql = "INSERT INTO `logs` (`subject`,`description`,`date`,`user`,`linkType`,`linkId`) VALUES('{$log->getSubject()}','{$log->getDescription()}','{$log->getDate()}','{$log->getUser()}','{$log->getLinkType()}','{$log->getLinkId()}')";
        if($this->dbQuery($sql)){
            return $this->dbLastInsertedId();
        }
    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function getLogById($id){
        $sql = "SELECT * FROM `logs` WHERE `id` = '{$id}'";
        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if ($endResult) {
            return $endResult;
        }
    }
    public function getLogsByLinkId($linkType, $linkId){
        $sql = "SELECT * FROM `logs` WHERE `linkType` = '{$linkType}' AND `linkId` = '{$linkId}' ORDER BY `date` DESC";
        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $value;
    }
}