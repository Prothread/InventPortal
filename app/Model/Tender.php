<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 24-3-2017
 * Time: 09:01
 */
class Tender
{
    private $db;

    private $TenderId;

    private $Subject;

    private $Client;

    private $User;

    private $Validity;

    private $Value;

    private $Chance;

    private $CreationDate;

    private $Description;

    private $Status;

    private $Id;

    private $EndDate;

    /**
     * @return mixed
     */

    public function setEndDate($enddate)
    {
        $this->EndDate = $enddate;
    }

    public function getEndDate()
    {
        return $this->EndDate;
    }

    public function calcEndDate($creationdate, $validity)
    {
        $this->EndDate = date('Y-m-d', strtotime($creationdate . " +" . $validity . " days"));
    }

    /**
     * @param mixed $EndDate
     */

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

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->Status;
    }

    public function setStatus($Status)
    {
        $this->Status = $Status;
    }

    public function __construct()
    {
        $this->db = new DbTender();
    }

    public function create()
    {
        return $this->db->create($this);
    }

    public function update()
    {
        return $this->db->update($this);
    }

//
    public function delete($id)
    {
        return $this->db->delete($id);
    }


    /**
     * @return mixed
     */
    public function getTenderId()
    {
        return $this->TenderId;
    }

    /**
     * @param mixed $TenderId
     */
    public function setTenderId($TenderId)
    {
        $this->TenderId = $TenderId;
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
    public function getValidity()
    {
        return $this->Validity;
    }

    /**
     * @param mixed $Validity
     */
    public function setValidity($Validity)
    {
        $this->Validity = $Validity;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @param mixed $Value
     */
    public function setValue($Value)
    {
        $this->Value = $Value;
    }

    /**
     * @return mixed
     */
    public function getChance()
    {
        return $this->Chance;
    }

    /**
     * @param mixed $Chance
     */
    public function setChance($Chance)
    {
        $this->Chance = $Chance;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->CreationDate;
    }

    /**
     * @param mixed $CreationDate
     */
    public function setCreationDate($CreationDate)
    {
        $this->CreationDate = $CreationDate;
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

    public function getLastTenderId()
    {
        return $this->db->getLastTenderId();
    }

    public function getAllTenders()
    {
        return $this->db->getAllTenders();
    }

    public function getTenderById($id)
    {
        return $this->db->getTenderById($id);
    }

    public function getTendersByUserId($userId)
    {
        return $this->db->getTendersByUserId($userId);
    }

    public function getTendersByStatus($status)
    {
        return $this->db->getTendersByStatus($status);
    }
}