<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 24-3-2017
 * Time: 09:00
 */
class TenderController
{

    private $model;

    public function __construct()
    {
        $this->model = new Tender();
    }

    public function create(array $tenderinfo)
    {
        $this->model->setSubject($tenderinfo['subject']);

        $this->model->setClient($tenderinfo['client']);

        if (isset($tenderinfo['user'])) {
            $this->model->setUser($tenderinfo['user']);
        }

        $this->model->setValidity($tenderinfo['validity']);

        if (isset($tenderinfo['value'])) {
            $this->model->setValue($tenderinfo['value']);
        }
        if (isset($tenderinfo['chance'])) {
            $this->model->setChance($tenderinfo['chance']);
        }
        if (isset($tenderinfo['creationdate'])) {
            $this->model->setCreationDate($tenderinfo['creationdate']);
        }
        if (isset($tenderinfo['description'])) {
            $this->model->setDescription($tenderinfo['description']);
        }
        if (isset($tenderinfo['status'])) {
            $this->model->setStatus($tenderinfo['status']);
        }

        if ($result = $this->model->create()) {
            return $result;
        }

    }

    public function update(array $tenderinfo){
        $this->model->setTenderId($tenderinfo['id']);
        $this->model->setSubject($tenderinfo['subject']);
        $this->model->setClient($tenderinfo['client']);
        $this->model->setUser($tenderinfo['user']);
        $this->model->setValidity($tenderinfo['validity']);
        $this->model->setCreationDate($tenderinfo['creationdate']);
        $this->model->setDescription($tenderinfo['description']);
        $this->model->setChance($tenderinfo['chance']);
        $this->model->setValue($tenderinfo['value']);
        $this->model->setStatus($tenderinfo['status']);
        $this->model->update();
    }

    public function delete($id){
        return $this->model->delete($id);
    }

    public function getLastTenderId(){
        return $this->model->getLastTenderId();
    }

    public function getAllTenders(){
        return $this->model->getAllTenders();
    }

    public function getTenderById($id){
        return $this->model->getTenderById($id);
    }
}