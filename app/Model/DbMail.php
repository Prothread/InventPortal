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

            $myid = $this->dbLastInsertedId();

            $i=0;
            foreach($imgarray as $img){
                $sql2 = "INSERT INTO `image` (`mailid`, `images`, `verify`) VALUES ('{$myid}', '{$img}', '{$mail->getVerified()}')";

                if($this->dbQuery($sql2)){
                    $i++;
                    true;
                }
            }

            $user = new UserController();
            $getbymail = $user->getUserByEmail($mail->getMailEmail());
            $userid = $getbymail['id'];

            $sql1 = "INSERT INTO `usermail` (`userid`, `mailid`, `status`) VALUES ('{$userid}', '{$myid}', '{$mail->getVerified()}')";

            if($this->dbQuery($sql1)) {

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

                $sql1 = "UPDATE `usermail` SET `clientid` = '{$mail->getMailClientId()}', `status` = '{$mail->getVerified()}' WHERE `mailid` = '{$mail->getMailId()}'";

                if($this->dbQuery($sql1)) {
                    true;
                }

                return true;
            }

            return false;
        }

        else {
            if ($this->dbQuery($sql)) {

                $imagecontroller = new ImageController();
                $images = $imagecontroller->getDeclinedImages($mail->getMailId());

                if (isset($images)) {
                    foreach ($images as $image) {
                        $sql = "UPDATE `image` SET `verify` = '3' WHERE `id` = '{$image}'";

                        if ($this->dbQuery($sql)) {
                            true;
                        }
                    }
                }

                if($mail->getImage()) {
                    $imgarray = (explode(", ", $mail->getImage()));

                    $i = 0;
                    foreach ($imgarray as $img) {
                        $sql2 = "INSERT INTO `image` (`mailid`, `images`, `verify`) VALUES ('{$mail->getMailId()}', '{$img}', '{$mail->getVerified()}')";

                        if ($this->dbQuery($sql2)) {
                            $i++;
                            true;
                        }
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
     * Haal meerdere mails op met een mail id
     *
     * @param $ids
     * @return mixed
     */
    public function getMailsById($ids)
    {
        $sql = "SELECT * FROM `mail` WHERE `id` IN ($ids)";

        if($result = $this->dbQuery($sql)) {

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

        if($value) {
            return $value;
        }
    }

    /**
     * Haal alle mail van de meegegeven gebruiker op
     *
     * @return mixed
     */

    public function getUserMailByUserId($id, $limit = null, $offset = null, $clientid = null)
    {
        $sql = "SELECT * FROM `usermail` ";

        if($clientid) {
            $sql .= "WHERE `clientid` = '{$clientid}'";
        }
        else {
            $sql .= "WHERE `userid` = '{$id}'";
        }

        if($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if($offset) {
            $sql .= " OFFSET {$offset}";
        }

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($value) {
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
        $query ="SELECT COUNT(`id`) AS 'total_blocks' FROM `usermail` WHERE `userid` = '{$id}'";

        if($result = $this->dbFetchArray($query)){
            return $result['total_blocks'];
        }
        return false;
    }

    /**
     * Tel het aantal mails van de gebruiker met de status en hun id
     *
     * @param $id, $status
     * @return mixed
     */
    public function CountUserMailbyIdStatus($id, $status)
    {
        $query ="SELECT COUNT(status) FROM `usermail` WHERE `userid` = '{$id}' AND `status` = '{$status}'";

        if($result = $this->dbFetchArray($query)){
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

        if($ids) {
            if($status) {
                $sql .= "WHERE `id` IN ($ids) AND onderwerp LIKE '%" . $term . "%' AND verified = '". $status ."'";
                $sql .= " OR `id` IN ($ids) AND verstuurder LIKE '%" . $term . "%' AND verified = '". $status ."'";
                $sql .= " OR `id` IN ($ids) AND naam LIKE '%" . $term . "%' AND verified = '". $status ."'";
                $sql .= " OR `id` IN ($ids) AND datum LIKE '%" . $term . "%' AND verified = '". $status ."'";
            }
            else {
                $sql .= "WHERE `id` IN ($ids) AND onderwerp LIKE '%" . $term . "%' ";
                $sql .= " OR `id` IN ($ids) AND verstuurder LIKE '%" . $term . "%'";
                $sql .= " OR `id` IN ($ids) AND naam LIKE '%" . $term . "%'";
                $sql .= " OR `id` IN ($ids) AND datum LIKE '%" . $term . "%'";
            }
        }
        else {
            if($status) {
                $sql .= " WHERE onderwerp LIKE '%".$term."%' AND verified = '". $status ."'";
                $sql .= " OR verstuurder LIKE '%".$term."%' AND verified = '". $status ."'";
                $sql .= " OR naam LIKE '%".$term."%' AND verified = '". $status ."'";
                $sql .= " OR datum LIKE '%".$term."%' AND verified = '". $status ."'";
            }
            else {
                $sql .= " WHERE onderwerp LIKE '%" . $term . "%' OR verstuurder LIKE '%" . $term . "%' OR naam LIKE '%" . $term . "%' OR datum LIKE '%" . $term . "%'";
            }
        }

        if($table) {
            $sql .= " ORDER BY $table";
        }
        if($filter) {
            $sql .= " $filter";
        }

        if($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if($offset) {
            $sql .= " OFFSET {$offset}";
        }

        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row !== null) {
            return $row;
        }
        return false;
    }


}