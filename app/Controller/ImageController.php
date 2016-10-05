<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 09:20
 */

class ImageController
{
    private $model;

    public function __construct()
    {
        $this->model = new ImageModel();
    }

    public function getNewId(){
        return $this->model->getNewId();
    }
}