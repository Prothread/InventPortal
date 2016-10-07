<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 30-Sep-16
 * Time: 14:35
 */

class DbMail extends Database
{
    public function create(Mail $mail)
    {
        $sql = "INSERT INTO `mail` (`onderwerp`, `verstuurder`, `beschrijving`, `naam`, `email`, `key`, `imgname` , `uniquename`, `datum` , `verified`) VALUES ('{$mail->getMailSubject()}' , '{$mail->getMailSender()}' ,
                '{$mail->getMailDescription()}' , '{$mail->getMailName()}' , '{$mail->getMailEmail()}' , '{$mail->getToken()}', '{$mail->getFakeImage()}' ,'{$mail->getImage()}', '{$mail->getDatum()}' ,
                '{$mail->getVerified()}' )";

        if($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }

        return false;

    }

    public function update(Mail $mail)
    {
        $sql = "UPDATE `mail` SET `onderwerp` = '{$mail->getMailSubject()}', `verstuurder` = '{$mail->getMailSender()}', `beschrijving` = '{$mail->getMailDescription()}', `naam` = '{$mail->getMailName()}',
                `email` = '{$mail->getMailEmail()}', `key` = '{$mail->getToken()}', `imgname` = '{$mail->getFakeImage()}', `uniquename` = '{$mail->getImage()}', `datum` = '{$mail->getDatum()}',
                `verified` = '{$mail->getVerified()}' WHERE `id`= '{$mail->getMailId()}'";

        if($this->dbQuery($sql)) {
            return true;
        }

        return false;

    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }
}