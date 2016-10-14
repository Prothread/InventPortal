<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 14-Oct-16
 * Time: 08:33
 */

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function create(array $userinfo)
    {
        $this->model->setName($userinfo['name']);
        $this->model->setEmail($userinfo['email']);
        $this->model->setPassword($userinfo['password']);

        if ($result = $this->model->create()) {
            echo('Success, de user is succesvol aangemaakt.');
            return $result;
        }

    }

    public function getUser(array $userinfo)
    {
        $this->model->setEmail($userinfo['email']);
        $this->model->setPassword($userinfo['password']);

        if ($result = $this->model->getUser()) {
            echo('Success, de user is succesvol gecheckt.');
            return $result;
        }

    }

}