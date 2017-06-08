<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 11-4-2017
 * Time: 15:56
 */
class logController
{
    private $model;

    public function __construct()
    {
        $this->model = new log();
    }

    public function create(array $loginfo){
        $this->model->setSubject($loginfo['subject']);
        $this->model->setDescription($loginfo['description']);
        $this->model->setDate($loginfo['date']);
        $this->model->setUser($loginfo['userId']);
        $this->model->setLinkType($loginfo['linkType']);
        $this->model->setLinkId($loginfo['linkId']);
        if ($result = $this->model->create()) {
            return $result;
        }
    }

    public function getLogById($id){
        return $this->model->getLogById($id);
    }

    public function getLogsByLinkId($linkType, $linkId){
        return $this->model->getLogsByLinkId($linkType, $linkId);
    }

    public function deleteLogsByLinkId($typeNumb, $id){
        return $this->model->deleteLogsByLinkId($typeNumb, $id);
    }
}