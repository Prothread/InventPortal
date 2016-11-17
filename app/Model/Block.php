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

    public function getUploads(){
        return $this->db->getUploads();
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

    public function getUploadById($id){
        return $this->db->getUploadById($id);
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

}