<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 09:22
 */

class ImageModel
{
    private $db;

    public function __construct()
    {
        $this->db = new DbImage();
    }

    public function getNewId(){
        return $this->db->getNewId();
    }

    public function ImageVerify($img){
        return $this->db->ImageVerify($img);
    }

    public function ImageDecline($img){
        return $this->db->ImageDecline($img);
    }

    public function getImageVerify($img){
        return $this->db->getImageVerify($img);
    }
}