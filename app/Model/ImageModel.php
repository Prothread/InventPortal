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
}