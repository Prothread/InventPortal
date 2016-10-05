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

        if($result = $this->dbQuery($sql) ) {
            return $result;
        }
    }
}