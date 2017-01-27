<?php

class StatusController
{
    /**
     * Variabele for model
     *
     * @var Status
     */
    private $model;

    /**
     * Link model to the $model variabele
     *
     * StatusController constructor.
     */

    public function __construct()
    {
        $this->model = new Status();
    }

    /**
     * Create functie voor statusportaal
     *
     * @param array $statusinfo
     * @return bool
     */

    public function create(array $statusinfo)
    {
        $this->model->setName($statusinfo['naam']);
        $this->model->setSubject($statusinfo['onderwerp']);
        $this->model->setDeadline($statusinfo['deadline']);
        $this->model->setCategory($statusinfo['category']);
        $this->model->setComment($statusinfo['comment']);

        if ($result = $this->model->create()) {
            Session::flash('message', TEXT_ITEM_CREATED);
            return $result;
        }
        return false;
    }

    /**
     * update functie voor statusportaal
     *
     * @param array $statusinfo
     * @return bool
     */

    public function update(array $statusinfo)
    {
        $this->model->setID($statusinfo['id']);
        $this->model->setName($statusinfo['naam']);
        $this->model->setSubject($statusinfo['onderwerp']);
        $this->model->setDeadline($statusinfo['deadline']);
        $this->model->setCategory($statusinfo['category']);
        $this->model->setComment($statusinfo['comment']);

        if ($result = $this->model->update()) {
            Session::flash('message', TEXT_ITEM_EDITED);
            return $result;
        }
        return false;
    }

    /**
     * Delete item met een (meegegeven) id
     *
     * @param $id
     * @return bool
     */

    public function deleteItemByID($id)
    {
        return $this->model->deleteItemByID($id);
    }

    /**
     * Haal alle items ophalen
     *
     * @return array|null
     */

    public function getItems()
    {
        return $this->model->getItems();
    }

    /**
     * Haal item op met (meegegeven) id
     *
     * @param $id
     * @return array|null
     */

    public function getItemById($id)
    {
        return $this->model->getItemById($id);
    }

}