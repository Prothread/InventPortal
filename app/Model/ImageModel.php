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

    public function getNewId(){
        return $this->db->getNewId();
    }

    /**
     * Kijk of de image al geverifieerd is
     *
     * @param $img
     * @return mixed
     */

    public function getImageVerify($img){
        return $this->db->getImageVerify($img);
    }

    /**
     * Haal image op door te kijken bij welke mail hij hoort
     *
     * @param $MailID
     * @return array|null
     */

    public function getImagebyMailID($MailID) {
        return $this->db->getImagebyMailID($MailID);
    }

    /**
     * Verander de verify tabel van de image om aan te geven dat hij goedgekeurd of afgekeurd wordt
     *
     * @param $id
     * @param $verify
     * @return bool
     */

    public function setImageVerify($id, $verify) {
        return $this->db->setImageVerify($id, $verify);
    }

}