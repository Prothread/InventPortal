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

        if ($this->dbQuery($sql)) {

            $imgarray = (explode(", ", $mail->getImage()));

            $myid = $this->dbLastInsertedId();

            $i = 0;
            foreach ($imgarray as $img) {
                $sql2 = "INSERT INTO `image` (`mailid`, `images`, `verify`) VALUES ('{$myid}', '{$img}', '{$mail->getVerified()}')";

                if ($this->dbQuery($sql2)) {
                    $i++;
                    true;
                }
            }

            $sql1 = "INSERT INTO `usermail` (`userid`, `clientid`, `mailid`, `status`) VALUES ('{$_SESSION['usr_id']}', '{$mail->getClientID()}', '{$myid}', '{$mail->getVerified()}')";

            if ($this->dbQuery($sql1)) {
                true;
            }

            if ($mail->getComment() !== null && $mail->getComment() !== '') {
                $date = date('Y-m-d');
                $sql3 = "INSERT INTO `comments`(`mailid`, `comment`, `commentgroep`, `datum`) VALUES ('{$myid}','{$mail->getComment()}', '{$mail->getCommentGroup()}', '{$date}')";
                if ($this->dbQuery($sql3)) {
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

        if($mail->getVerified()) {
            $sql1 = "UPDATE `usermail` SET `status` = '{$mail->getVerified()}' WHERE `mailid` = '{$mail->getMailId()}'";

            if ($this->dbQuery($sql1)) {
                true;
            }
        }

        $answer = $mail->getAnswer();
        if (isset($answer)) {
            $sql = "UPDATE `mail` SET `answer` = '{$mail->getAnswer()}', `key` = '{$mail->getToken()}' , `verified` = '{$mail->getVerified()}' WHERE `id` = '{$mail->getMailId()}'";

            if ($this->dbQuery($sql)) {
                return true;
            }

            return false;
        } else {
            if ($this->dbQuery($sql)) {

                $imagecontroller = new ImageController();
                $images = $imagecontroller->getDeclinedImages($mail->getMailId());

                if ($images) {
                    foreach ($images as $image) {
                        $sql = "UPDATE `image` SET `verify` = '3' WHERE `id` = '{$image['id']}'";

                        if ($this->dbQuery($sql)) {
                            true;
                        }

                    }
                }


                if ($mail->getImage()) {
                    $imgarray = (explode(", ", $mail->getImage()));

                    $vsql = "SELECT * from `image` WHERE `mailid` = '{$mail->getMailId()}' ORDER BY `version` DESC LIMIT 1";
                    if ($vresult = $this->dbQuery($vsql)) {
                        $vreturn = mysqli_fetch_assoc($vresult);
                        $version = intval($vreturn['version']) + 1;
                    } else {
                        $version = 1;
                    }


                    foreach ($imgarray as $img) {
                        $sql2 = "INSERT INTO `image` (`mailid`, `images`, `version`, `verify`) VALUES ('{$mail->getMailId()}', '{$img}', '{$version}', '{$mail->getVerified()}')";

                        if ($this->dbQuery($sql2)) {
                            true;
                        }

                    }
                }

                if ($mail->getComment() !== null && $mail->getComment() !== '') {
                    $date = date('Y-m-d');
                    $sql3 = "INSERT INTO `comments`(`mailid`, `comment`, `commentgroep`, `datum`) VALUES ('{$mail->getMailId()}','{$mail->getComment()}', '{$mail->getCommentGroup()}', '{$date}')";
                    if ($this->dbQuery($sql3)) {
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

        if ($value) {
            return $value;
        }
    }

    /**
     * Haal meerdere mails op met een mail id
     *
     * @param $ids
     * @return mixed
     */
    public function getMailsById($ids)
    {
        $sql = "SELECT * FROM `mail` WHERE `id` IN ($ids)";

        if ($result = $this->dbQuery($sql)) {

            $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $value;
        }
        return false;
    }

    /**
     * Haal mail op met id
     *
     * @param $status
     * @return array|null
     */

    public function getUserMailByStatus($status)
    {
        $sql = "SELECT COUNT(status) FROM `usermail` WHERE `status` = '{$status}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if ($value) {
            return $value;
        }
    }

    /**
     * Haal alle mail van de gebruiker op met een id en een filter
     *
     * @return mixed
     */

    public function getUserMailByUserId($id, $date = null, $verified = null, $clientid = null)
    {
        $sql = "SELECT * FROM `usermail` ";

        if ($clientid) {
            $sql .= " JOIN `mail` ON `usermail`.`mailid` = `mail`.`id` WHERE `usermail`.`clientid` = '{$id}'";
            //$sql .= "WHERE `clientid` = '{$clientid}'";
        } else {
            $sql .= " JOIN `mail` ON `usermail`.`mailid` = `mail`.`id` WHERE `usermail`.`userid` = '{$id}'";
            //$sql .= "WHERE `userid` = '{$id}'";
        }

        if ($date) {
            $date2 = date('Y-m-d', strtotime("-5 day"));
            $sql .= " AND `datum` < '{$date2}'";
        }
        if ($verified) {
            $sql .= " AND `verified` IN ({$verified})";
        }
        $sql .= " ORDER BY `mail`.`id`";

        if ($result = $this->dbQuery($sql)) {
            $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $value;
        }

    }

    /**
     * Tel het aantal mails van de user
     *
     * @return mixed
     */

    public function countUserMailByUserId($id)
    {
        $query = "SELECT COUNT(`id`) AS 'total_blocks' FROM `usermail` WHERE `userid` = '{$id}'";

        if ($result = $this->dbFetchArray($query)) {
            return $result['total_blocks'];
        }
        return false;
    }

    /**
     * Tel het aantal mails van de gebruiker met de status en hun id
     *
     * @param $id , $status
     * @return mixed
     */
    public function CountUserMailbyIdStatus($id, $status)
    {
        $query = "SELECT COUNT(status) FROM `usermail` WHERE `userid` = '{$id}' AND `status` = '{$status}'";

        if ($result = $this->dbFetchArray($query)) {
            return $result;
        }
        return false;
    }

    /**
     * Haal alle mail van de meegegeven gebruiker en de status op
     *
     * @return mixed
     */

    public function getUserMail($id, $status)
    {
        $sql = "SELECT * FROM `usermail` WHERE `userid` = '{$id}' AND `status` = '{$status}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($value) {
            return $value;
        }
        return false;
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

    /**
     * Geef aan dat het de laatste rij is die geimporteerd wordt in de database
     *
     * @return mixed
     */

    public function getLastID()
    {
        $sql = "SELECT id FROM `mail` ORDER BY id DESC LIMIT 1";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value['id'];
        }
    }

    /**
     * Zoek in tabel van mail
     *
     * @param $term
     * @param $limit
     * @param $offset
     * @param null $table
     * @param null $filter
     * @param null $ids
     * @param $status
     * @return array|bool|null
     */

    public function searchTable($term, $limit, $offset, $table = null, $filter = null, $ids = null, $status)
    {
        $sql = "SELECT * FROM mail ";

        if ($ids) {
            if ($status) {
                $sql .= "WHERE `id` IN ($ids) AND onderwerp LIKE '%" . $term . "%' AND verified = '" . $status . "'";
                $sql .= " OR `id` IN ($ids) AND verstuurder LIKE '%" . $term . "%' AND verified = '" . $status . "'";
                $sql .= " OR `id` IN ($ids) AND naam LIKE '%" . $term . "%' AND verified = '" . $status . "'";
                $sql .= " OR `id` IN ($ids) AND datum LIKE '%" . $term . "%' AND verified = '" . $status . "'";
            } else {
                $sql .= "WHERE `id` IN ($ids) AND onderwerp LIKE '%" . $term . "%' ";
                $sql .= " OR `id` IN ($ids) AND verstuurder LIKE '%" . $term . "%'";
                $sql .= " OR `id` IN ($ids) AND naam LIKE '%" . $term . "%'";
                $sql .= " OR `id` IN ($ids) AND datum LIKE '%" . $term . "%'";
            }
        } else {
            if ($status) {
                $sql .= " WHERE onderwerp LIKE '%" . $term . "%' AND verified = '" . $status . "'";
                $sql .= " OR verstuurder LIKE '%" . $term . "%' AND verified = '" . $status . "'";
                $sql .= " OR naam LIKE '%" . $term . "%' AND verified = '" . $status . "'";
                $sql .= " OR datum LIKE '%" . $term . "%' AND verified = '" . $status . "'";
            } else {
                $sql .= " WHERE onderwerp LIKE '%" . $term . "%' OR verstuurder LIKE '%" . $term . "%' OR naam LIKE '%" . $term . "%' OR datum LIKE '%" . $term . "%'";
            }
        }

        if ($table) {
            $sql .= " ORDER BY $table";
        }
        if ($filter) {
            $sql .= " $filter";
        }

        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if ($offset) {
            $sql .= " OFFSET {$offset}";
        }

        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($row !== null) {
            return $row;
        }
        return false;
    }

    /**
     * Haal usermail op met de meegestuurde mailid variabele
     *
     * @param $MailID
     * @return mixed
     */

    public function getUserMailbyMailID($MailID)
    {
        $sql = "SELECT * FROM `usermail` WHERE `mailid` = '{$MailID}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if ($value) {
            return $value;
        }
        return false;
    }

    /**
     * Delete item uit de database met (meegegeven) id
     *
     * @param $id
     * @return bool
     */

    public function deleteItemByID($id)
    {
        $sql = "DELETE mail, usermail FROM mail INNER JOIN usermail WHERE mail.id = usermail.mailid and mail.id = '{$id}'";

        $result = $this->dbQuery($sql);

        if ($result) {
            $sql1 = "DELETE FROM `image` WHERE `mailid` = '{$id}'";

            if($this->dbQuery($sql1)) {
                true;
            }

            return true;
        }
        return false;
    }

    /**
     * Weiger het item (bv als de klant het heeft goedgekeuren, maar het is nog niet helemaal goed)
     *
     * @param $id
     * @return mixed
     */

    public function weigerItemByID($id)
    {
        $sql = "UPDATE `mail` SET `verified`= '3' WHERE `id` = '{$id}'";

        if ($this->dbQuery($sql)) {
            $sql1 = "UPDATE `usermail` SET `status`= '3' WHERE `id` = '{$id}'";

            if($this->dbQuery($sql1)) {
                true;
            }
            $sql2 = "SELECT * FROM `image` WHERE `mailid` = '{$id}' AND `version` = (SELECT MAX(`version`) FROM `image` WHERE `mailid` = '{$id}') ORDER BY `version` DESC";

            if($result = $this->dbQuery($sql2)) {
                $images = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach($images as $image) {
                    $imageid = $image['id'];

                    $sql3 = "UPDATE `image` SET `verify`= '2' WHERE `id` = '{$imageid}'";
                    if ($this->dbQuery($sql3)) {
                        true;
                    }
                }

            }
            return true;
        }
        return false;
    }


    /**
     * Verwijder een image met het meegegeven mailid
     *
     * @param $id
     * @return bool
     */


    public function deleteItemImageByID($id)
    {
        $sql = "DELETE FROM image WHERE mailid = '{$id}'";

        $result = $this->dbQuery($sql);

        if ($result) {
            return true;
        }
        return false;
    }


    /**
     * Haal de rij op die als volgende toegevoegd wordt
     *
     * @return mixed
     */

    public function getIncrement()
    {
        //Als er meerdere databases zijn:
        //$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'portalinvent' AND TABLE_NAME = 'mail'";
        //Als je maar aan 1 database gelinkt ben:
        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'mail'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value['AUTO_INCREMENT'];
        }
    }

}