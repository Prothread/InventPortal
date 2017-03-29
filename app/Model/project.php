<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 23-3-2017
 * Time: 14:05
 */
class Project
{
    private $db;
    /*
     * Project ID
     */
    private $projectId;
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

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->db = new DbProject();
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

    public function getProjectById($id)
    {
        return $this->db->getProjectById($id);
    }

    public function getAllProjects()
    {
        return $this->db->getAllProjects();
    }

    public function getProjectsByUserId($userId)
    {
        return $this->db->getProjectsByUserId($userId);
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param mixed $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
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

    public function getProjectsByStatus($status)
    {
        return $this->db->getProjectsByStatus($status);
    }
}