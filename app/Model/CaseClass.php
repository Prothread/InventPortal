<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 28-3-2017
 * Time: 10:01
 */
class CaseClass
{

    private $db;
    /*
     * Case ID
     */
    private $caseId;
    /*
     * Onderwerp
     */
    private $subject;
    /*
     * Klant Id
     */
    private $client;
    /*
     * Werknemer Id
     */
    private $user;
    /*
     * Deadline datum
     */
    private $endDate;
    /*
     * Beschrijving
     */
    private $description;
    /*
     * Status nummer
     */
    private $status;
    /*
     * Afrond datum
     */
    private $finishDate;

    private $project;

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->db = new DbCase();
    }

    public function create(){
        return $this->db->create($this);
    }

    public function update(){
        return $this->db->update($this);
    }

    public function delete($id){
        return $this->db->delete($id);
    }

    public function getCaseById($id){
        return $this->db->getCaseById($id);
    }

    public function getAllCases(){
        return $this->db->getAllCases();
    }

    public function getCasesByUserId($userId){
        return $this->db->getCasesByUserId($userId);
    }

    /**
     * @return mixed
     */
    public function getCaseId()
    {
        return $this->caseId;
    }

    /**
     * @param mixed $caseId
     */
    public function setCaseId($caseId)
    {
        $this->caseId = $caseId;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * @param mixed $finishDate
     */
    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;
    }

    public function getCasesByStatus($status){
        return $this->db->getCasesByStatus($status);
    }

    public function assignUser($user, $id){
       $this->db->assignUser($user, $id);
    }
}