<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 09:24
 */

class DbImage extends Database
{
    public function getNewId(){
        $sql = "SELECT `id` FROM `mail` ORDER BY `id` DESC LIMIT 1";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return intval($value['id']);
        }
    }

    public function ImageVerify($img){
        $sql = "UPDATE `image` SET  `verify` = '1' WHERE `images` = '{$img}'";

        if($this->dbQuery($sql)){
            var_dump($this->dbQuery($sql));
            return true;
        }
    }

    public function ImageDecline($img) {
        $sql = "UPDATE `image` SET  `verify` = '2' WHERE `images` = '{$img}'";

        if($this->dbQuery($sql)){
            var_dump($this->dbQuery($sql));
            return true;
        }
    }

    public function getImagebyMailID($MailID){
        $sql = "SELECT * FROM `image` WHERE `mailid` = '{$MailID}'";

        $result = $this->dbQuery($sql);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row) {
            return $row;
        }

    }

    public function setImageVerify($id, $verify) {
        $sql = "UPDATE `image` SET `verify` = '{$verify}' WHERE `id` = '{$id}'";

        if($this->dbQuery($sql)){
            return true;
        }
    }

}