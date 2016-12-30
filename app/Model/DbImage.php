<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 09:24
 */
class DbImage extends Database
{

    /**
     * Haal het laatst geüploade item op
     *
     * @return int
     */

    public function getNewId()
    {
        $sql = "SELECT `id` FROM `mail` ORDER BY `id` DESC LIMIT 1";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if ($value) {
            return intval($value['id']);
        }
    }

    /**
     * Haal image op door te kijken bij welke mail hij hoort
     *
     * @param $MailID
     * @return array|null
     */

    public function getImagebyMailID($MailID)
    {
        $sql = "SELECT * FROM `image` WHERE `mailid` = '{$MailID}'";

        $result = $this->dbQuery($sql);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($row) {
            return $row;
        }

    }

    /**
     * Verander de verify tabel van de image om aan te geven dat hij goedgekeurd of afgekeurd wordt
     *
     * @param $id
     * @param $verify
     * @return bool
     */

    public function setImageVerify($id, $verify)
    {
        $sql = "UPDATE `image` SET `verify` = '{$verify}' WHERE `id` = '{$id}'";

        if ($this->dbQuery($sql)) {
            return true;
        }
    }

    /**
     * Kijk of de image al geverifieerd is
     *
     * @param $id
     * @return bool
     */


    public function getImageVerify($id)
    {
        $sql = "SELECT * FROM `image` WHERE `id` = '{$id}'";

        if ($result = $this->dbQuery($sql)) {
            return mysqli_fetch_assoc($result);
        }
    }

    /**
     * Haal de images op die afgekeurd zijn
     *
     * @param $id
     * @return mixed
     */

    public function getDeclinedImages($id)
    {
        $sql = "SELECT * FROM `image` WHERE `mailid` = '{$id}' && `verify` = '2'";

        if ($result = $this->dbQuery($sql)) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    /**
     * Verander de verify tabel van de image om aan te geven dat hij goedgekeurd of afgekeurd wordt
     *
     * @param $id
     * @param $vote
     * @return bool
     */

    public function setDownloadable($id, $vote)
    {
        $sql = "UPDATE `image` SET `downloadable` = '{$vote}' WHERE `id` = '{$id}'";

        if ($result = $this->dbQuery($sql)) {
            return true;
        }
        return false;
    }

    /**
     * Haal image met de naam op
     *
     * @param $ImageName
     * @return mixed
     */

    public function getImageByName($ImageName)
    {
        $sql = "SELECT * FROM `image` WHERE `images` = '{$ImageName}'";

        if ($result = $this->dbQuery($sql)) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

}