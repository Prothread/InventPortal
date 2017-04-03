<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 27-3-2017
 * Time: 12:15
 */
class Assignment
{
    private $db;

    private $assignmentId;

    private $subject;

    private $client;

    private $user;

    private $endDate;

    private $description;

    private $project;

    private $status;

    public function __construct()
    {
        $this->db = new DbAssignment();
    }

    public function create()
    {
        return $this->db->create($this);
    }

    public function update()
    {
        return $this->db->update($this);
    }

    public function delete($id)
    {
        return $this->db->delete($id);
    }

    public function getAssignmentById($id)
    {
        return $this->db->getAssignmentById($id);
    }

    public function getAllAssignments()
    {
        return $this->db->getAllAssignments();
    }

    public function getAssignmentsByUserId($userId)
    {
        return $this->db->getAssignmentsByUserId($userId);
    }

    public function getAssignmentsByStatus($status)
    {
        return $this->db->getAssignmentsByStatus($status);
    }

    /**
     * @return mixed
     */
    public function getAssignmentId()
    {
        return $this->assignmentId;
    }

    /**
     * @param mixed $assignmentId
     */
    public function setAssignmentId($assignmentId)
    {
        $this->assignmentId = $assignmentId;
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

    public function assignUser($user, $id){
        $this->db->assignUser($user, $id);
    }

    public function getAssignmentByProjectId($id){
        return $this->db->getAssignmentByProjectId($id);
    }

}