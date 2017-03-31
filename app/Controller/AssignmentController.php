<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 27-3-2017
 * Time: 12:13
 */
class AssignmentController
{
    private $model;

    public function __construct()
    {
        $this->model = new Assignment();
    }

    public function create(array $assignmentinfo)
    {
        $this->model->setSubject($assignmentinfo['subject']);
        $this->model->setClient($assignmentinfo['client']);
        $this->model->setUser($assignmentinfo['user']);
        $this->model->setEndDate($assignmentinfo['endDate']);
        $this->model->setDescription($assignmentinfo['description']);
        $this->model->setProject($assignmentinfo['project']);
        $this->model->setStatus($assignmentinfo['status']);
        if ($result = $this->model->create()) {
            return $result;
        }
    }

    public function update(array $assignmentinfo)
    {
        $this->model->setAssignmentId($assignmentinfo['id']);
        $this->model->setSubject($assignmentinfo['subject']);
        $this->model->setClient($assignmentinfo['client']);
        $this->model->setUser($assignmentinfo['user']);
        $this->model->setEndDate($assignmentinfo['endDate']);
        $this->model->setDescription($assignmentinfo['description']);
        $this->model->setProject($assignmentinfo['project']);
        $this->model->setStatus($assignmentinfo['status']);
        $result = $this->model->update();
        return $result;
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }

    public function getAssignmentById($id)
    {
        return $this->model->getAssignmentById($id);
    }

    public function getAllAssignments()
    {
        return $this->model->getAllAssignments();
    }

    public function getAssignmentsByUserId($userId)
    {
        return $this->model->getAssignmentsByUserId($userId);
    }

    public function getTimeDifference($date1, $date2)
    {
        $d1 = new DateTime($date1);
        $d2 = new DateTime($date2);
        return $diff = $d1->diff($d2)->format("%a");
    }

    public function getAssignmentsByStatus($status)
    {
        return $this->model->getAssignmentsByStatus($status);
    }

    public function assignUser($user, $id){
        $this->model->assignUser($user, $id);
    }
}