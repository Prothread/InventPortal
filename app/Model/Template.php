<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 5-4-2017
 * Time: 11:59
 */
class Template
{
    private $db;

    private $templateId;

    private $subject;

    private $description;

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function getTemplateId()
    {
        return $this->templateId;
    }

    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }



    public function __construct()
    {
        $this->db = new DbTemplate();
    }

    public function create()
    {
        return $this->db->create($this);
    }

    public function getAllTemplates(){
        return $this->db->getAllTemplates();
    }

    public function getTemplateById($id){
        return $this->db->getTemplateById($id);
    }

    public function update()
    {
        return $this->db->update($this);
    }
}