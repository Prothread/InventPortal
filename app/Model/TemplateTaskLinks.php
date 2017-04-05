<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 5-4-2017
 * Time: 12:00
 */
class TemplateTaskLinks
{
    private $db;

    private $idTemplate;

    private $idTask;

    public function __construct()
    {
        $this->db = new DbTemplateTaskLinks();
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function getIdTemplate()
    {
        return $this->idTemplate;
    }

    public function setIdTemplate($idTemplate)
    {
        $this->idTemplate = $idTemplate;
    }

    public function getIdTask()
    {
        return $this->idTask;
    }

    public function setIdTask($idTask)
    {
        $this->idTask = $idTask;
    }

    public function create()
    {
        return $this->db->create($this);
    }

}