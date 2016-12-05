<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 10:47
 */

class BlockController
{
    /**
     * Variabele om door te verbinden naar de model Block
     *
     * @var Block
     */

    private $model;

    /**
     * Verbindt de model Block
     *
     * BlockController constructor.
     */

    public function __construct()
    {
        $this->model = new Block();
    }

    /**
     * Haal alle uploads op
     *
     * @return array|null
     */

    public function getUploads()
    {
        return $this->model->getUploads();
    }

    /**
     * Telt alle user uploads
     *
     * @return array|null
     */

    public function getAllUserUploadsCount($id)
    {
        return $this->model->getAllUserUploadsCount($id);
    }

    /**
     * Haal alle usermail info op met id
     *
     * @return mixed
     */


    public function getAllUserUploads($id)
    {
        return $this->model->getAllUserUploads($id);
    }

    /**
     * Telt alle user uploads met verified 2
     *
     * @return array|null
     */

    public function getAllUserUploadsCountByVerified($id)
    {
        return $this->model->getAllUserUploadsCountByVerified($id);
    }

    /**
     * Haal alle uploads op die ouder zijn dan 7 dagen (me eventuele verified)
     *
     * @return array|null
     */

    public function getOlderUploads($verified = null, $date2 = null)
    {
        return $this->model->getOlderUploads($verified, $date2);
    }

    /**
     * Haal de laatste 6 uploads op
     *
     * @return array|null
     */

    public function getLastSixUploads()
    {
        return $this->model->getLastSixUploads();
    }

    /**
     * Haal alle geaccordeerde proeven op
     *
     * @return mixed
     */

    public function getAccordedUploads()
    {
        return $this->model->getAccordedUploads();
    }

    /**
     * Haal de laatste 6 items van de gebruiker op
     *
     * @param $userID
     * @return mixed
     */

    public function getLastSixUserUploads($userID)
    {
        return $this->model->getLastSixUserUploads($userID);
    }

    /**
     * Haal een upload op met het id dat je meegeeft
     *
     * @param $id
     * @return array|null
     */

    public function getUploadById($id)
    {
        return $this->model->getUploadById($id);
    }

    /**
     * Haal de interne opmerkingen op
     *
     * @param $id
     * @return array|null
     */

    public function getComments($id)
    {
        return $this->model->getComments($id);
    }

    /**
     * Haal aantal resultaten van mails op
     *
     * @return mixed
     */

    public function countBlocks()
    {
        return $this->model->countBlocks();
    }

    public function Redirect($url) {
        if (headers_sent()) {
            echo('<script type="text/javascript">window.location=\''.$url.'\';</script> ');
        }
        else {
            header('Location: ' . $url);
        }
    }
}