<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 09:22
 */
class ImageModel
{

    /**
     * Variabele db om DbImage te linken
     *
     * @var DbImage
     */

    private $db;

    /**
     * Constructor om de DbImage Model te linken
     *
     * ImageModel constructor.
     */

    public function __construct()
    {
        $this->db = new DbImage();
    }

    /**
     * Haal het laatst geüploade item op
     *
     * @return int
     */

    public function getNewId()
    {
        return $this->db->getNewId();
    }

    /**
     * Haal op of de image al geverifieerd is
     *
     * @param $id
     * @return bool
     */

    public function getImageVerify($id)
    {
        return $this->db->getImageVerify($id);
    }

    /**
     * Haal de images op die afgekeurd zijn
     *
     * @param $id
     * @return mixed
     */

    public function getDeclinedImages($id)
    {
        return $this->db->getDeclinedImages($id);
    }

    /**
     * Haal image op door te kijken bij welke mail hij hoort
     *
     * @param $MailID
     * @return array|null
     */

    public function getImagebyMailID($MailID)
    {
        return $this->db->getImagebyMailID($MailID);
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
        return $this->db->setImageVerify($id, $verify);
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
        return $this->db->setDownloadable($id, $vote);
    }

    /**
     * Haal image met de naam op
     *
     * @param $ImageName
     * @return mixed
     */

    public function getImageByName($ImageName)
    {
        return $this->db->getImageByName($ImageName);
    }

    /**
     * haal de status van de laatste versie op
     *
     * @param $mailId
     * @return array|null|string
     */

    public function getStatusLastVersion($mailId){
        return $this->db->getStatusLastVersion($mailId);
    }

    /**
     * haal de hoogste versie nummer op
     * @param $mailId
     * @return array|null
     */

    public function getHighVersion($mailId){
        return $this->db->getHighVersion($mailId);
    }

}