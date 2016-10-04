<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 03-Oct-16
 * Time: 15:58
 */

class DbVerify extends Database
{

    private $result;

    public function setVerified($verifyemail, $verifykey)
    {
        $sql = "SELECT * FROM `mail` WHERE `email` = '{$verifyemail}' && `key` = '{$verifykey}'";
        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if( $result ){
            $this->result = $row;
            return $this->result;
        }

    }

    public function setVerifiedById($id)
    {
        $sql = "UPDATE `mail` SET `verified` = '1' WHERE `mail`.`id` = '{$id}';";
        $result = $this->dbQuery($sql);

        if( $result ){
            return $this->result;
        }

    }

    public function getVerifiedById($verifyemail, $verifykey)
    {
        $sql = "SELECT `id` FROM `mail` WHERE `email` = '{$verifyemail}' && `key` = '{$verifykey}'";
        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if( $result ){
            $this->result = $row;
            return $this->result;
        }

    }

    public function getVerified()
    {
        return $this->result;
    }
}