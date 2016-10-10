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
        $sql = "UPDATE `image` SET  `verify` = '0' WHERE `images` = '{$img}'";

        if($this->dbQuery($sql)){
            var_dump($this->dbQuery($sql));
            return true;
        }
    }

    public function getImageVerify($img) {
        $sql = "SELECT `image` SET  `verify` = '1' WHERE `images` = '{$img}'";

        if($this->dbQuery($sql)){
            var_dump($this->dbQuery($sql));
            return true;
        }
    }

}