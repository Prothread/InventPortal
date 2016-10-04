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
        $query = "SELECT * FROM `mail` WHERE `email` = '{$verifyemail}' && `key` = '{$verifykey}'";

        /*"IF EXISTS (SELECT * FROM `mail` WHERE `email` = '{$verifyemail}' && `key` = '{$verifykey}')
            BEGIN
                SELECT `verified` FROM `mail` WHERE `email` = '{$verifyemail}' && `key` = '{$verifykey}'
            END
        ";*/

        if( $result = $this->dbQuery($query) ){
            $this->result = $result;
        }

    }
    public function getVerified()
    {
        return $this->result;
    }
}
$test = new DbVerify();
var_dump(  $test->getVerified() );