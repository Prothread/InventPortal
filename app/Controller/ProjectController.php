<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 24-3-2017
 * Time: 09:10
 */
class ProjectController
{
    /**
     * @var Project
     */

    private $model;

    /**
     * Verbind controller met project
     *
     * ProjectController constructor.
     */

    public function __construct()
    {
        $this->model = new Project();
    }

    /**
     * Maakt project aan
     *
     * @param array $projectinfo
     *
     * @return mixed
     */

    public function create(array $projectinfo)
    {
        $this->model->setSubject($projectinfo['subject']);
        $this->model->setClient($projectinfo['client']);
        $this->model->setUser($projectinfo['user']);
        $this->model->setEndDate($projectinfo['endDate']);
        $this->model->setDescription($projectinfo['description']);
        $this->model->setStatus($projectinfo['status']);
        if ($result = $this->model->create()) {
            return $result;
        }
    }

    public function update(array $projectinfo)
    {
        $this->model->setProjectId($projectinfo['id']);
        $this->model->setSubject($projectinfo['subject']);
        $this->model->setClient($projectinfo['client']);
        $this->model->setUser($projectinfo['user']);
        $this->model->setEndDate($projectinfo['endDate']);
        $this->model->setDescription($projectinfo['description']);
        $this->model->setStatus($projectinfo['status']);
        $result = $this->model->update();
        return $result;
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }

    public function getProjectById($id)
    {
        return $this->model->getProjectById($id);
    }

    public function getAllProjects()
    {
        return $this->model->getAllProjects();
    }

    public function getProjectsByUserId($userId)
    {
        return $this->model->getProjectsByUserId($userId);
    }

    public function getTimeDifference($date1, $date2)
    {
        $d1 = new DateTime($date1);
        $d2 = new DateTime($date2);
        return $diff = $d1->diff($d2)->format("%a");
    }

    public function getProjectsByStatus($status)
    {
        return $this->model->getProjectsByStatus($status);
    }

    public function assignUser($user, $id){
        $this->model->assignUser($user, $id);
    }
}