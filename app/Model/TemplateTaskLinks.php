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

    public function getTaskAmountByTemplateId($id){
        return $this->db->getTaskAmountByTemplateId($id);
    }

    public function getTaskByTemplateId($id){
        return $this->db->getTaskByTemplateId($id);
    }

    public function deleteByTemplateId($id){
        return $this->db->deleteByTemplateId($id);
    }

    public function checkDeleteDefaultTask($id){
        return $this->db->checkDeleteDefaultTask($id);
    }
}