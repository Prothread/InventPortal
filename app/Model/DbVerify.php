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
        $query =
        "IF EXISTS (SELECT * FROM `mail` WHERE `email` = '{$verifyemail}' && `key` = '{$verifykey}')
            BEGIN
                SELECT * FROM `mail` WHERE `email` = '{$verifyemail}' && `key` = '{$verifykey}'
            END
        ";
        if( $result = $this->dbQuery($query) ){
            return $this->result = $result;
        }
    }
    public function getVerified()
    {
        return $this->result;
    }
}