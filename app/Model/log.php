<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 11-4-2017
 * Time: 15:57
 */
class log
{
    private $db;

    private $logId;

    private $subject;

    private $description;

    private $date;

    private $user;

    private $linkType;

    private $linkId;

    public function __construct()
    {
        $this->db = new DbLog();
    }

    /**
     * @return mixed
     */
    public function getLogId()
    {
        return $this->logId;
    }

    /**
     * @param mixed $logIdl
     */
    public function setLogId($logId)
    {
        $this->logId = $logId;
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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
    public function getLinkType()
    {
        return $this->linkType;
    }

    /**
     * @param mixed $linkType
     */
    public function setLinkType($linkType)
    {
        $this->linkType = $linkType;
    }

    /**
     * @return mixed
     */
    public function getLinkId()
    {
        return $this->linkId;
    }

    /**
     * @param mixed $linkId
     */
    public function setLinkId($linkId)
    {
        $this->linkId = $linkId;
    }

    public function create(){
        return $this->db->create($this);
    }

    public function getLogById($id){
        return $this->db->getLogById($id);
    }

    public function getLogsByLinkId($linkType, $linkId){
        return $this->db->getLogsByLinkId($linkType, $linkId);
    }

    public function deleteLogsByLinkId($typeNumb, $id){
        return $this->db->deleteLogsByLinkId($typeNumb, $id);
    }
}