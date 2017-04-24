<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 28-3-2017
 * Time: 15:20
 */
class Task
{
    private $db;

    private $TaskId;

    private $Subject;

    private $Client;

    private $User;

    private $Description;

    private $Status;

    private $project;

    private $assignment;

    private $urgency;

    private $duration;

    private $endDate;

    private $Id;

    private $tender;

    private $cases;

    /**
     * @return mixed
     */
    public function getCases()
    {
        return $this->cases;
    }

    /**
     * @param mixed $case
     */
    public function setCases($cases)
    {
        $this->cases = $cases;
    }

    /**
     * @return mixed
     */
    public function getTender()
    {
        return $this->tender;
    }

    /**
     * @param mixed $tender
     */
    public function setTender($tender)
    {
        $this->tender = $tender;
    }

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->TaskId;
    }

    /**
     * @param mixed $TaskId
     */
    public function setTaskId($TaskId)
    {
        $this->TaskId = $TaskId;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->Subject;
    }

    /**
     * @param mixed $Subject
     */
    public function setSubject($Subject)
    {
        $this->Subject = $Subject;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->Client;
    }

    /**
     * @param mixed $Client
     */
    public function setClient($Client)
    {
        $this->Client = $Client;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param mixed $User
     */
    public function setUser($User)
    {
        $this->User = $User;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProjectId($project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getAssignment()
    {
        return $this->assignment;
    }

    /**
     * @param mixed $assignment
     */
    public function setAssignment($assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * @return mixed
     */
    public function getUrgency()
    {
        return $this->urgency;
    }

    /**
     * @param mixed $urgency
     */
    public function setUrgency($urgency)
    {
        $this->urgency = $urgency;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
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
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    public function __construct()
    {
        $this->db = new DbTask();
    }

    public function create()
    {
        return $this->db->create($this);
    }

    public function createDefault()
    {
        return $this->db->createDefault($this);
    }

    public function update()
    {
        return $this->db->update($this);
    }

    public function updateDefault()
    {
        return $this->db->updateDefault($this);
    }

    public function delete($id)
    {
        return $this->db->delete($id);
    }

    public function getLastTenderId()
    {
        return $this->db->getLastTenderId();
    }

    public function getAllTasks()
    {
        return $this->db->getAllTasks();
    }

    public function getTaskById($id)
    {
        return $this->db->getTaskById($id);
    }

    public function getTasksByUserId($userId)
    {
        return $this->db->getTasksByUserId($userId);
    }

    public function getAllTasksByStatus($status)
    {
        return $this->db->getAllTasksByStatus($status);
    }

    public function assignUser($user, $id){
       $this->db->assignUser($user, $id);
    }

    public function getTasksByLinkId($type, $id){
        return $this->db->getTasksByLinkId($type, $id);
    }
    public function getTimeDifference($date1, $date2)
    {
        return $this->db->getTimeDifference($date1, $date2);
    }
}