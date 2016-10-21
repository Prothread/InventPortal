<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 30-Sep-16
 * Time: 14:35
 */

class DbMail extends Database
{

    /**
     * Get all information in the sql variable
     *
     * If: get query from information
     * Maak een array van imgarray
     * Voor elke image, maak je een nieuwe rij met id, de image en een tabel voor goedkeuring/afkeuring
     *
     * Geef weer dat het gelukt.
     *
     * @param Mail $mail
     * @return bool|mixed
     */

    public function create(Mail $mail)
    {
        $sql = "INSERT INTO `mail` (`onderwerp`, `verstuurder`, `beschrijving`, `naam`, `email`, `key`, `datum` , `verified`) VALUES ('{$mail->getMailSubject()}' , '{$mail->getMailSender()}' ,
                '{$mail->getMailDescription()}' , '{$mail->getMailName()}' , '{$mail->getMailEmail()}' , '{$mail->getToken()}', '{$mail->getDatum()}' ,
                '{$mail->getVerified()}' )";

        if($this->dbQuery($sql)) {

            $imgarray = ( explode(", ", $mail->getImage()) );
            $fakeimgarray = ( explode(", ", $mail->getFakeImage()) );

            $myid = $this->dbLastInsertedId();

            $i=0;
            foreach($imgarray as $img){
                $sql2 = "INSERT INTO `image` (`mailid`, `fakename`, `images`, `verify`) VALUES ('{$myid}', '{$fakeimgarray[$i]}', '{$img}', '{$mail->getVerified()}')";

                if($this->dbQuery($sql2)){
                    $i++;
                    true;
                }
            }

            return $this->dbLastInsertedId();
        }

        return false;

    }

    /**
     * Get all information in the sql variable
     *
     * If: als er een antwoord is ingevuld --> werk antwoord, token en verified bij
     * Update de usermail met een nieuwe userid en mailid (dit is voor geaccordeerde proeven/offertes)
     *
     * Else: Voor elke image update de rij.
     *
     * @param Mail $mail
     * @return bool|mixed
     */

    public function update(Mail $mail)
    {
        $sql = "UPDATE `mail` SET `onderwerp` = '{$mail->getMailSubject()}', `verstuurder` = '{$mail->getMailSender()}', `beschrijving` = '{$mail->getMailDescription()}', `naam` = '{$mail->getMailName()}',
                `email` = '{$mail->getMailEmail()}', `key` = '{$mail->getToken()}', `datum` = '{$mail->getDatum()}',
                `verified` = '{$mail->getVerified()}' WHERE `id`= '{$mail->getMailId()}'";

        if($mail->getAnswer() !== null) {
            $sql = "UPDATE `mail` SET `answer` = '{$mail->getAnswer()}', `key` = '{$mail->getToken()}' , `verified` = '{$mail->getVerified()}' WHERE `id` = '{$mail->getMailId()}'";

            if($this->dbQuery($sql)){

                $sql1 = "INSERT INTO `usermail` (`userid`, `clientid`, `mailid`) VALUES ('{$mail->getMailUserId()}', '{$mail->getMailClientId()}', '{$mail->getMailId()}')";

                if($this->dbQuery($sql1)) {
                    true;
                }

                return true;
            }

            return false;
        }

        else {
            if ($this->dbQuery($sql)) {

                $imgarray = (explode(", ", $mail->getImage()));
                $fakeimgarray = ( explode(", ", $mail->getFakeImage()) );

                $i=0;
                foreach ($imgarray as $img) {
                    $sql1 = "UPDATE `image` SET `fakename` = '{$fakeimgarray[$i]}' , `images` = '{$img}', `verify` = '{$mail->getVerified()}') WHERE `mailid` = '{$mail->getMailId()}'";

                    if ($this->dbQuery($sql1)) {
                        true;
                    }
                }

                return true;
            }

            return false;
        }
    }

    /**
     * Haal mail op met id
     *
     * @param $id
     * @return array|null
     */

    public function getMailById($id)
    {
        $sql = "SELECT * FROM `mail` WHERE `id` = '{$id}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value;
        }
    }

    /**
     * Geef aan dat het de laatste rij is die geimporteerd wordt in de database
     *
     * @return mixed
     */

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }
}