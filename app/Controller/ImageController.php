<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 09:20
 */

class ImageController
{
    /**
 * Model voor de imagecontroller
 *
 * @var ImageModel
 */
    private $model;
    private $uniquename;

    public function __construct()
    {
        $this->model = new ImageModel();
    }

    public function getNewId(){
        return $this->model->getNewId();
    }

    /*public function ImageVerify($id, $img, $imageFileType) {
        $unique_name = pathinfo($img, PATHINFO_FILENAME)."_".( $id . 'V' ).'.'.$imageFileType;
        $this->uniquename = DIR_IMAGE.$unique_name;
        echo $this->uniquename;
    }*/

    public function ImageVerify($img) {
        return $this->model->ImageVerify($img);
    }

    public function ImageDecline($img) {
        return $this->model->ImageDecline($img);
    }

    public function getImageVerify($img) {
        return $this->model->getImageVerify($img);
    }

    public function getImagebyMailID($MailID) {
        return $this->model->getImagebyMailID($MailID);
    }

    public function setImageVerify($id, $verify) {
        return $this->model->setImageVerify($id, $verify);
    }

}