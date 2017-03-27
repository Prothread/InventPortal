<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 24-3-2017
 * Time: 09:10
 */
class ProjectController
{
    private $model;

    public function __construct()
    {
        $this->model = new Project();
    }

    public function create(array $projectinfo){
        $this->model->setSubject($projectinfo['title']);
        $this->model->setClient($projectinfo['client']);
        $this->model->setUser($projectinfo['user']);
        $this->model->setEndDate($projectinfo['endDate']);
        $this->model->setDescription($projectinfo['description']);
        $this->model->setStatus($projectinfo['status']);
        if($result = $this->model->create()){
            return $result;
        }
    }
    public function update(array $projectinfo){
        $this->model->setProjectId($projectinfo['title']);
        $this->model->setSubject($projectinfo['title']);
        $this->model->setClient($projectinfo['client']);
        $this->model->setUser($projectinfo['user']);
        $this->model->setEndDate($projectinfo['endDate']);
        $this->model->setDescription($projectinfo['description']);
        $this->model->setStatus($projectinfo['status']);
        $this->model->update();
    }
    public function delete($id){
        return $this->model->delete($id);
    }
    public function getProjectById($id){
        return $this->model->getProjectById($id);
    }
    public function getAllProjecs(){
        return $this->model->getAllProjects();
    }
    public function getProjectsByUserId($userId){

    }
}