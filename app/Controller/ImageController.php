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
     * Variabele om ImageModel te verbinden met de controller
     *
     * @var ImageModel
     */

    private $model;
    private $uniquename;

    /**
     * Constructor om deze controller te verbinden met de ImageModel
     *
     * ImageController constructor.
     */

    public function __construct()
    {
        $this->model = new ImageModel();
    }

    /**
     * Haal het laatst geüploade item op
     *
     * @return int
     */

    public function getNewId(){
        return $this->model->getNewId();
    }

    /**
     * Kijk of de image al geverifieerd is
     *
     * @param $img
     * @return mixed
     */

    public function getImageVerify($img) {
        return $this->model->getImageVerify($img);
    }

    /**
     * Haal image op door te kijken bij welke mail hij hoort
     *
     * @param $MailID
     * @return array|null
     */

    public function getImagebyMailID($MailID) {
        return $this->model->getImagebyMailID($MailID);
    }

    /**
     * Verander de verify tabel van de image om aan te geven dat hij goedgekeurd of afgekeurd wordt
     *
     * @param $id
     * @param $verify
     * @return bool
     */

    public function setImageVerify($id, $verify) {
        return $this->model->setImageVerify($id, $verify);
    }

}