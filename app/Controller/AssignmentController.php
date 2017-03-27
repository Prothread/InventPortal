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
        $this->model = new Assignment;
    }
}