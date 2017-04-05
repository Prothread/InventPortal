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

        $this->model->setClient($taskinfo['client']);

        if (isset($taskinfo['user'])) {
            $this->model->setUser($taskinfo['user']);
        }

        if (isset($taskinfo['project'])) {
            $this->model->setProject($taskinfo['project']);
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

        if (isset($taskinfo['enddate'])) {
            $this->model->setEndDate($taskinfo['enddate']);
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

        if (isset($taskinfo['case'])) {
            $this->model->setCase($taskinfo['case']);
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
        $this->model->setUser($taskinfo['user']);
        $this->model->setProject($taskinfo['project']);
        $this->model->setAssignment($taskinfo['assignment']);
        $this->model->setUrgency($taskinfo['urgency']);
        $this->model->setDuration($taskinfo['duration']);
        $this->model->setEndDate($taskinfo['enddate']);
        $this->model->setDescription($taskinfo['description']);
        $this->model->setStatus($taskinfo['status']);
        $this->model->setTender($taskinfo['tender']);
        $this->model->setCase($taskinfo['cases']);
        $this->model->update();
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
        $d1 = new DateTime($date1);
        $d2 = new DateTime($date2);
        return $diff = $d1->diff($d2)->format("%a");
    }

    public function getTasksByUserId($userId){
        return $this->model->getTasksByUserId($userId);
    }

    public function getTasksByStatus($status)
    {
        return $this->model->getTasksByStatus($status);
    }

    public function assignUser($user, $id){
        $this->model->assignUser($user, $id);
    }

    public function getTaskByTendeId($id){
        return $this->model->getTaskByTendeId($id);
    }

    public function getTaskByAssignmentId($id){
        return $this->model->getTaskByAssignmentId($id);
    }

    public function getTaskByCaseId($id){
        return $this->model->getTaskByCaseId($id);
    }

    public function getTaskByProjectId($id){
        return $this->model->getTaskByProjectId($id);
    }

    public function getAllTasksByStatus($status){
        return $this->model->getAllTasksByStatus($status);
    }
}