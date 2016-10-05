<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 11:37
 */

class Block
{
    private $db;

    public function __construct()
    {
        $this->db = new DbBlock();
    }

    public function getUploads(){
        return $this->db->getUploads();
    }

    public function getLastThreeUploads(){
        return $this->db->getLastThreeUploads();
    }

    public function getUploadById($id){
        return $this->db->getUploadById($id);
    }

}