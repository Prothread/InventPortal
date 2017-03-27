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
        if (isset($tenderinfo['creationDate'])) {
            $this->model->setCreationDate($tenderinfo['creationDate']);
        }
        if (isset($tenderinfo['description'])) {
            $this->model->setDescription($tenderinfo['description']);
        }

        if ($result = $this->model->create()) {
            Session::flash('message', "Offerte aangemaakt!");
            return $result;
        }

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