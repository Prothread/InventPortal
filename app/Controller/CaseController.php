<?php

class CaseController
{

    private $model;

    public function __construct()
    {
        $this->model = new CaseClass();
    }

    public function create(array $caseinfo){
        $this->model->setSubject($caseinfo['subject']);
        $this->model->setClient($caseinfo['client']);
        $this->model->setUser($caseinfo['user']);
        $this->model->setEndDate($caseinfo['enddate']);
        $this->model->setDescription($caseinfo['description']);
        $this->model->setStatus($caseinfo['status']);
        $this->model->setProject($caseinfo['project']);
        if($result = $this->model->create()){
            return $result;
        }
    }

    public function update(array $caseinfo){
        $this->model->setCaseId($caseinfo['id']);
        $this->model->setSubject($caseinfo['subject']);
        $this->model->setSubject($caseinfo['subject']);
        $this->model->setClient($caseinfo['client']);
        $this->model->setUser($caseinfo['user']);
        $this->model->setEndDate($caseinfo['enddate']);
        $this->model->setDescription($caseinfo['description']);
        $this->model->setStatus($caseinfo['status']);
        $this->model->setProject($caseinfo['project']);
        $result = $this->model->update();
        return $result;
    }

    public function delete($id){
        return $this->model->delete($id);
    }
    public function getCaseById($id){
        return $this->model->getCaseById($id);
    }
    public function getAllCases(){
        return $this->model->getAllCases();
    }
    public function getCasesByUserId($userId){
        return $this->model->getCasesByUserId($userId);
    }

    public function getCasesByStatus($status){
        return $this->model->getCasesByStatus($status);
    }
}