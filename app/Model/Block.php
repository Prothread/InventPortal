<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 11:37
 */

class Block
{

    /**
     * Variabele om door te verbinden naar de model DbBlock
     *
     * @var Block
     */

    private $db;

    /**
     * Verbindt de model Block
     *
     * BlockController constructor.
     */

    public function __construct()
    {
        $this->db = new DbBlock();
    }

    /**
     * Haal ale uploads op
     *
     * @return array|null
     */

    public function getUploads()
    {
        return $this->db->getUploads();
    }

    /**
     * Haal alle uploads op die ouder zijn dan 7 dagen
     *
     * @return array|null
     */

    public function getOlderUploads($verified = null, $date2 = null)
    {
        return $this->db->getOlderUploads($verified, $date2);
    }

    /**
     * Haal de laatste 6 uploads op
     *
     * @return array|null
     */

    public function getLastSixUploads()
    {
        return $this->db->getLastSixUploads();
    }

    /**
     * Haal alle geaccordeerde proeven op
     *
     * @return mixed
     */

    public function getAccordedUploads()
    {
        return $this->db->getAccordedUploads();
    }

    /**
     * Haal alle geweigerde proeven op
     *
     * @return mixed
     */

    public function getDeclinedUploads()
    {
        return $this->db->getDeclinedUploads();
    }

    /**
     * Haal alle usermail info op met id
     *
     * @return mixed
     */


    public function getAllUserUploads($id)
    {
        return $this->db->getAllUserUploads($id);
    }

    /**
     * Haal de laatste 6 items van de gebruiker op
     *
     * @param $userID
     * @return mixed
     */

    public function getLastSixUserUploads($userID)
    {
        return $this->db->getLastSixUserUploads($userID);
    }

    /**
     * Haal een upload op met het id dat je meegeeft
     *
     * @param $id
     * @return array|null
     */

    public function getUploadById($id)
    {
        return $this->db->getUploadById($id);
    }

    /**
     * Haal de interne opmerkingen op
     *
     * @param $id
     * @return array|null
     */

    public function getComments($id)
    {
        return $this->db->getComments($id);
    }

    /**
     * Haal aantal resultaten van mails op
     *
     * @return mixed
     */

    public function countBlocks()
    {
        return $this->db->countBlocks();
    }

    /**
     * Telt alle user uploads
     *
     * @return array|null
     */

    public function getAllUserUploadsCount($id)
    {
        return $this->db->getAllUserUploadsCount($id);
    }

    /**
     * Telt alle user uploads met verified 2
     *
     * @return array|null
     */

    public function getAllUserUploadsCountByVerified($id)
    {
        return $this->db->getAllUserUploadsCountByVerified($id);
    }

}