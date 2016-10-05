<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 11:39
 */

class DbBlock extends Database
{

    public function getUploads(){
        $sql = "SELECT * FROM `mail` ORDER BY `mail`.`id` DESC";

        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row) {
            return $row;
        }
    }

    public function getLastThreeUploads() {
        $sql = "SELECT * FROM `mail` ORDER BY `id` DESC LIMIT 3";

        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row) {
            return $row;
        }
    }

    public function getUploadById($id){
        $sql = "SELECT * FROM `mail` WHERE `id` = '{$id}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value;
        }
    }

}