<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 5-4-2017
 * Time: 11:58
 */
class TemplateTaskLinksController
{

    private $model;

    public function __construct()
    {
        $this->model = new TemplateTaskLinks();
    }

    public function create(array $templatetaskinfo)
    {
        $this->model->setIdTemplate($templatetaskinfo['idTemplate']);
        $this->model->setIdTask($templatetaskinfo['idTask']);

        $result = $this->model->create();
        return $result;
    }

    public function getTaskAmountByTemplateId($id){
        return $this->model->getTaskAmountByTemplateId($id);
    }

    public function getTaskByTemplateId($id){
        return $this->model->getTaskByTemplateId($id);
    }

    public function deleteByTemplateId($id){
        return $this->model->deleteByTemplateId($id);
    }

    public function checkDeleteDefaultTask($id){
        return $this->model->checkDeleteDefaultTask($id);
    }
}