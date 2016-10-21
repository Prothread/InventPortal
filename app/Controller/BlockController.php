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
     * Haal ale uploads op
     *
     * @return array|null
     */

    public function getUploads($limit = null, $offset = null)
    {
        return $this->model->getUploads($limit, $offset);
    }

    /**
     * Haal de laatste 3 uploads op
     *
     * @return array|null
     */

    public function getLastSixUploads()
    {
        return $this->model->getLastSixUploads();
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
     * Haal aantal resultaten van mails op
     *
     * @return mixed
     */

    public function countBlocks()
    {
        return $this->model->countBlocks();
    }
}