<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 5-4-2017
 * Time: 11:58
 */
class templateController
{

    private $model;

    public function __construct()
    {
        $this->model = new Template();
    }

    public function create(array $templateinfo)
    {
        $this->model->setSubject($templateinfo['subject']);
        $this->model->setDescription($templateinfo['description']);
        if ($result = $this->model->create()) {
            return $result;
        }
    }
}