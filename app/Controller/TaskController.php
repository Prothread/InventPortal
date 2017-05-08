<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 28-3-2017
 * Time: 15:19
 */
class TaskController
{
    private $model;

    public function __construct()
    {
        $this->model = new Task();
    }

    public function create(array $taskinfo)
    {
        $this->model->setSubject($taskinfo['subject']);

        if(isset($taskinfo['client'])) {
            $this->model->setClient($taskinfo['client']);
        }

        if (isset($taskinfo['user'])) {
            $this->model->setUser($taskinfo['userId']);
        }

        if (isset($taskinfo['project'])) {
            $this->model->setProjectId($taskinfo['project']);
        }

        if (isset($taskinfo['assignment'])) {
            $this->model->setAssignment($taskinfo['assignment']);
        }

        if (isset($taskinfo['urgency'])) {
            $this->model->setUrgency($taskinfo['urgency']);
        }

        if (isset($taskinfo['duration'])) {
            $this->model->setDuration($taskinfo['duration']);
        }

        if (isset($taskinfo['endDate'])) {
            $this->model->setEndDate($taskinfo['endDate']);
        }

        if (isset($taskinfo['description'])) {
            $this->model->setDescription($taskinfo['description']);
        }

        if (isset($taskinfo['status'])) {
            $this->model->setStatus($taskinfo['status']);
        }

        if (isset($taskinfo['tender'])) {
            $this->model->setTender($taskinfo['tender']);
        }

        if (isset($taskinfo['cases'])) {
            $this->model->setCases($taskinfo['cases']);
        }

        if ($result = $this->model->create()) {
            return $result;
        }

    }

    public function createDefault(array $taskinfo)
    {
        $this->model->setSubject($taskinfo['subject']);

        if (isset($taskinfo['duration'])) {
            $this->model->setDuration($taskinfo['duration']);
        }

        if (isset($taskinfo['description'])) {
            $this->model->setDescription($taskinfo['description']);
        }

        if (isset($taskinfo['status'])) {
            $this->model->setStatus($taskinfo['status']);
        }

        if ($result = $this->model->createDefault()) {
            return $result;
        }

    }

    public function update(array $taskinfo)
    {
        $this->model->setTaskId($taskinfo['id']);
        $this->model->setSubject($taskinfo['subject']);
        $this->model->setClient($taskinfo['client']);
        $this->model->setUser($taskinfo['userId']);
        $this->model->setProjectId($taskinfo['project']);
        $this->model->setAssignment($taskinfo['assignment']);
        $this->model->setUrgency($taskinfo['urgency']);
        $this->model->setDuration($taskinfo['duration']);
        $this->model->setEndDate($taskinfo['endDate']);
        $this->model->setDescription($taskinfo['description']);
        $this->model->setStatus($taskinfo['status']);
        $this->model->setTender($taskinfo['tender']);
        $this->model->setCases($taskinfo['cases']);
        return $this->model->update();
    }

    public function updateDefault(array $taskinfo)
    {
        $this->model->setTaskId($taskinfo['id']);
        $this->model->setSubject($taskinfo['subject']);
        $this->model->setDescription($taskinfo['description']);
        $this->model->setDuration($taskinfo['duration']);
        $this->model->setStatus($taskinfo['status']);
        $this->model->updateDefault();
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }

    public function getLastTenderId()
    {
        return $this->model->getLastTenderId();
    }

    public function getAllTasks()
    {
        return $this->model->getAllTasks();
    }

    public function getTaskById($id)
    {
        return $this->model->getTaskById($id);
    }

    public function getEndDate()
    {
        return $this->model->getEndDate();
    }

    public function calcEndDate($creationdate, $validity)
    {
        return $this->model->calcEndDate($creationdate, $validity);
    }

    public function getUser()
    {
        return $this->model->getUser();
    }

    public function getTimeDifference($date1, $date2)
    {
        return $this->model->getTimeDifference($date1, $date2);
    }

    public function getTasksByUserId($userId){
        return $this->model->getTasksByUserId($userId);
    }

    public function assignUser($user, $id){
        $this->model->assignUser($user, $id);
    }

    public function getTasksByLinkId($type, $id){
        return $this->model->getTasksByLinkId($type, $id);
    }

    public function getAllTasksByStatus($status){
        return $this->model->getAllTasksByStatus($status);
    }
}