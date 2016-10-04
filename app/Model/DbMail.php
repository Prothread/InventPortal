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
        $sql = "INSERT INTO `mail` (`onderwerp`, `verstuurder`, `beschrijving`, `naam`, `email`, `key`, `images`, `verified`) VALUES ('{$mail->getMailSubject()}' , '{$mail->getMailSender()}' ,
                '{$mail->getMailDescription()}' , '{$mail->getMailName()}' , '{$mail->getMailEmail()}' , '{$mail->getToken()}', '{$mail->getImage()}' , '{$mail->getVerified()}' )";

        if($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }

        return false;

    }

    public function update(Mail $mail)
    {
        $sql = "INSERT INTO `mail` (`onderwerp`, `verstuurder`, `beschrijving`, `naam`, `email`, `key`, `images`, `verified`) VALUES ('{$mail->getMailSubject()}' , '{$mail->getMailSender()}' ,
                '{$mail->getMailDescription()}' , '{$mail->getMailName()}' , '{$mail->getMailEmail()}' , '{$mail->getToken()}', '{$mail->getImage()}' , '{$mail->getVerified()}' )";

        if($this->dbQuery($sql)) {
            return true;
        }

        return false;

    }

    public function read(Mail $mail)
    {

    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }
}