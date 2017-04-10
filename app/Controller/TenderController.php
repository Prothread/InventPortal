<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 24-3-2017
 * Time: 09:00
 */
class TenderController
{
    /**
     * @var $model
     */

    private $model;

    /**
     * Verbind controller met tender
     *
     * TenderController constructor.
     */

    public function __construct()
    {
        $this->model = new Tender();
    }

    /**
     * Tender aanmaken
     *
     * @param array $tenderinfo
     *
     * @return int
     */

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
        $result = $this->model->create();
        return $result;
    }

    /**
     * Haalt alle Tenders op
     *
     * @return array|null
     */

    public function getAllTenders()
    {
        return $this->model->getAllTenders();
    }

    /**
     * Haalt een tender op met $id
     *
     * @param $id
     *
     * @return array|null
     */

    public function getTenderById($id)
    {
        return $this->model->getTenderById($id);
    }

    /**
     * Haalt enddate op
     *
     * @return mixed
     */

    public function getEndDate()
    {
        return $this->model->getEndDate();
    }

    /**
     * Berekend te enddate
     *
     * @param $creationdate
     * @param $validity
     */

    public function calcEndDate($creationdate, $validity)
    {
        $this->model->calcEndDate($creationdate, $validity);
    }

    /**
     * Haalt het tijdverschil op
     *
     * @param $date1
     * @param $date2
     *
     * @return string
     */

    public function getTimeDifference($date1, $date2)
    {
        return $this->model->getTimeDifference($date1, $date2);
    }

    /**
     * Haalt tenders op, op basis van $userId
     *
     * @param $userId
     *
     * @return array|null
     */

    public function getTendersByUserId($userId)
    {
        return $this->model->getTendersByUserId($userId);
    }

    /**
     * Haalt tenders op, op basis van $status
     *
     * @param $status
     *
     * @return array|null
     */

    public function getTendersByStatus($status)
    {
        return $this->model->getTendersByStatus($status);
    }

    /**
     * Tender aanpassen
     *
     * @param array $tenderinfo
     */

    public function update(array $tenderinfo)
    {
        $this->model->setTenderId($tenderinfo['id']);
        $this->model->setSubject($tenderinfo['subject']);
        $this->model->setClient($tenderinfo['client']);
        $this->model->setUser($tenderinfo['user']);
        $this->model->setValidity($tenderinfo['validity']);
        $this->model->setDescription($tenderinfo['description']);
        $this->model->setChance($tenderinfo['chance']);
        $this->model->setValue($tenderinfo['value']);
        $this->model->setStatus($tenderinfo['status']);
        $this->model->update();
    }

    /**
     * Verwijderd tender
     *
     * @param $id
     *
     * @return bool
     */

    public function delete($id)
    {
        return $this->model->delete($id);
    }

    public function assignUser($user, $id){
        $this->model->assignUser($user, $id);
    }

}