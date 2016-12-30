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

    public function getNewId()
    {
        return $this->model->getNewId();
    }

    /**
     * Kijk hoe de image geverifieerd is
     *
     * @param $id
     * @return mixed
     */

    public function getImageVerify($id)
    {
        return $this->model->getImageVerify($id);
    }

    /**
     * Haal de images op die afgekeurd zijn
     *
     * @param $id
     * @return mixed
     */

    public function getDeclinedImages($id)
    {
        return $this->model->getDeclinedImages($id);
    }

    /**
     * Haal image op door te kijken bij welke mail hij hoort
     *
     * @param $MailID
     * @return array|null
     */

    public function getImagebyMailID($MailID)
    {
        return $this->model->getImagebyMailID($MailID);
    }

    /**
     * Verander de verify tabel van de image om aan te geven dat hij goedgekeurd of afgekeurd wordt
     *
     * @param $id
     * @param $verify
     * @return bool
     */

    public function setImageVerify($id, $verify)
    {
        return $this->model->setImageVerify($id, $verify);
    }

    /**
     * Verander de verify tabel van de image om aan te geven dat hij goedgekeurd of afgekeurd wordt
     *
     * @param $id
     * @param $vote
     * @return bool
     */

    public function setDownloadable($id, $vote)
    {
        return $this->model->setDownloadable($id, $vote);
    }

    /**
     * Verander de image naam naa een naam waar geen id in vor komt
     *
     * @return mixed
     */

    public function getFakeImageName($imagename)
    {
        $ImageName = pathinfo($imagename, PATHINFO_FILENAME);
        $ImageFileType = pathinfo($imagename, PATHINFO_EXTENSION);
        $NewImageName = substr($ImageName, 0, -3) . '.' . $ImageFileType;
        return $NewImageName;
    }

    /**
     * Haal image met de naam op
     *
     * @param $ImageName
     * @return mixed
     */

    public function getImageByName($ImageName)
    {
        return $this->model->getImageByName($ImageName);
    }

}