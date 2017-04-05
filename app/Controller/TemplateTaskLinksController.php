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
}