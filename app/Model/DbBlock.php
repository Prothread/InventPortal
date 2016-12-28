<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 11:39
 */

class DbBlock extends Database
{

    /**
     * Haal ale uploads op die jonger zijn dan 1 jaar
     *
     * @return array|null
     */

    public function getUploads(/*$table, $filter, $limit = null, $offset = null, $status*/){
        /*
        $sql = "SELECT * FROM `mail`";

        if($status) {
            $sql .= " WHERE verified = '{$status}'";
        }
        if($table) {
            $sql .= " ORDER BY $table";
        }
        if($filter) {
            $sql .= " $filter";
        }
        if($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if($offset) {
            $sql .= " OFFSET {$offset}";
        }
        */

        $sql = "SELECT * FROM `mail` WHERE `datum` > DATE_SUB(NOW(),INTERVAL 1 YEAR)";
        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row) {
            return $row;
        }
        return null;
    }

    /**
     * Haal alle uploads op die ouder zijn dan 1 jaar
     *
     * @return array|null
     */

    public function getArchiveUploads(/*$table, $filter, $limit = null, $offset = null, $status*/){
        /*
        $sql = "SELECT * FROM `mail`";

        if($status) {
            $sql .= " WHERE verified = '{$status}'";
        }
        if($table) {
            $sql .= " ORDER BY $table";
        }
        if($filter) {
            $sql .= " $filter";
        }
        if($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if($offset) {
            $sql .= " OFFSET {$offset}";
        }
        */

        $sql = "SELECT * FROM `mail` WHERE `datum` <= DATE_SUB(NOW(),INTERVAL 1 YEAR)";
        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row) {
            return $row;
        }
        return null;
    }

    /**
     * Haal alle uploads op die ouder zijn dan 7 dagen
     *
     * @return array|null
     */

    public function getOlderUploads($verified = null, $date2 = null)
    {
        $date = date('Y-m-d');

        $sql = "SELECT * FROM `mail` WHERE `datum` <";

        if($date2) {
            $date2 = date('Y-m-d', strtotime("-5 day"));
            $sql .=" '{$date2}'";
        }
        else {
            $sql .= " '{$date}'";
        }

        if($verified) {
            $sql .= " AND `verified` IN({$verified})";
        }

        if($result = $this->dbQuery($sql)) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $row;
        }
    }

    /**
     * Haal de laatste 6 uploads op
     *
     * @return array|null
     */

    public function getLastSixUploads() {
        $sql = "SELECT * FROM `mail` ORDER BY `id` DESC LIMIT 6";

        $result = $this->dbQuery($sql);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row) {
            return $row;
        }
        return false;
    }

    /**
     * Haal alle geaccordeerde proeven op
     *
     * @return mixed
     */

    public function getAccordedUploads($date = null)
    {
        $sql = "SELECT * FROM `mail` WHERE `verified` =  '2'";

        if($date) {
            $sql .= " AND `datum` > DATE_SUB(NOW(),INTERVAL 1 YEAR)";
        }
        else {
            $sql .= " AND `datum` < DATE_SUB(NOW(),INTERVAL 1 YEAR)";
        }

        if($result = $this->dbQuery($sql)) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $row;
        }
    }

    /**
     * Haal alle geweigerde proeven op
     *
     * @return mixed
     */

    public function getDeclinedUploads($date = null)
    {
        $sql = "SELECT * FROM `mail` WHERE `verified` =  '3'";

        if($date) {
            $sql .= " AND `datum` > DATE_SUB(NOW(),INTERVAL 1 YEAR)";
        }
        else {
            $sql .= " AND `datum` < DATE_SUB(NOW(),INTERVAL 1 YEAR)";
        }

        if($result = $this->dbQuery($sql)) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $row;
        }
    }

    /**
     * Haal de laatste 6 items van de gebruiker op
     *
     * @param $userID
     * @return mixed
     */

    public function getLastSixUserUploads($userID)
    {
        $sql = "SELECT * FROM `usermail` JOIN `mail` ON `usermail`.`mailid` = `mail`.`id` WHERE `usermail`.`clientid` = '{$userID}' ORDER BY `mail`.`id` DESC LIMIT 6";

        if($result = $this->dbQuery($sql)) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $row;
        }
        return false;
    }

    /**
     * Haal alle usermail info op met id
     *
     * @param $id
     * @return mixed
     */

    public function getAllUserUploads($id)
    {
        $sql = "SELECT * FROM `usermail` JOIN `mail` ON `usermail`.`mailid` = `mail`.`id` WHERE `usermail`.`userid` = '{$id}' ORDER BY `mail`.`id`";

        $result = $this->dbQuery($sql);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row) {
            return $row;
        }
        return false;
    }

    /**
     * Haal alle usermail info op met id
     *
     * @param $id
     * @return mixed
     */

    public function getAllUserUploadsCount($id)
    {
        $sql = "SELECT COUNT('id') FROM `usermail` JOIN `mail` ON `usermail`.`mailid` = `mail`.`id` WHERE `usermail`.`userid` = '{$id}' ORDER BY `mail`.`id`";

        $result = $this->dbQuery($sql);
        $row = mysqli_fetch_assoc($result);

        if($row) {
            return $row;
        }
        return false;
    }

    /**
     * Haal alle usermail info op met id
     *
     * @param $id
     * @return mixed
     */

    public function getAllUserUploadsCountByVerified($id)
    {
        $sql = "SELECT COUNT('id') FROM `usermail` JOIN `mail` ON `usermail`.`mailid` = `mail`.`id` WHERE `usermail`.`userid` = '{$id}' AND `mail`.`verified` = '2' ORDER BY `mail`.`id`";

        $result = $this->dbQuery($sql);
        $row = mysqli_fetch_assoc($result);

        if($row) {
            return $row;
        }
    }


    /**
     * Haal een upload op met het id dat je meegeeft
     *
     * @param $id
     * @return array|null
     */

    public function getUploadById($id){
        $sql = "SELECT * FROM `mail` WHERE `id` = '{$id}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value;
        }
        return false;
    }

    /**
     * Haal de interne opmerkingen op
     *
     * @param $id
     * @return array|null
     */

    public function getComments($id)
    {
        $sql = "SELECT * FROM `comments` WHERE `mailid` = '{$id}' ORDER BY `commentgroep` DESC";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($value) {
            return $value;
        }
        return null;
    }

    /**
     * Haal het aantal mails op
     *
     * @return mixed
     */

    public function countBlocks()
    {
        $query ="SELECT COUNT(`id`) AS 'total_blocks' FROM `mail`";

        if($result = $this->dbFetchArray($query)){
            return $result['total_blocks'];
        }
        return false;
    }

}