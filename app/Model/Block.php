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

    public function getUploads($limit = null, $offset = null){
        return $this->db->getUploads($limit, $offset);
    }

    /**
     * Haal de laatste 3 uploads op
     *
     * @return array|null
     */

    public function getLastThreeUploads(){
        return $this->db->getLastThreeUploads();
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