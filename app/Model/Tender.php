<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 24-3-2017
 * Time: 09:01
 */
class Tender
{
    /**
     * Voor de dbTender connectie
     *
     * @var DbTender
     */

    private $db;

    /**
     * Id van de tender
     *
     * @var $TenderId
     */

    private $TenderId;

    /**
     * Onderwerp van de tender
     *
     * @var $Subject
     */

    private $Subject;

    /**
     * Client id van de tender
     *
     * @var $client
     */

    private $Client;

    /**
     * User id van de tender
     *
     * @var $User
     */

    private $User;

    /**
     * Geldigheids duur van de tender
     *
     * @var $Validity
     */

    private $Validity;

    /**
     * De waarde van de tender
     *
     * @var $Value
     */

    private $Value;

    /**
     * Kans van de tender
     *
     * @var $Chance
     */

    private $Chance;

    /**
     * Aanmaak datum van de tender
     *
     * @var $CreationDate
     */

    private $CreationDate;

    /**
     * Bescbhrijving van de tender
     *
     * @var $Description
     */

    private $Description;

    /**
     * Status ven de tender
     *
     * @var $Status
     */

    private $Status;

    /**
     * Verval datum van de tender
     *
     * @var $endDate
     */

    private $endDate;

    /**
     * Tender constructor.
     */

    public function __construct()
    {
        $this->db = new DbTender();
    }

    /**
     * @return int
     */

    public function getTenderId()
    {
        return $this->TenderId;
    }

    /**
     * @param int $TenderId
     */

    public function setTenderId($TenderId)
    {
        $this->TenderId = $TenderId;
    }

    /**
     * @return string
     */

    public function getSubject()
    {
        return $this->Subject;
    }

    /**
     * @param string $Subject
     */

    public function setSubject($Subject)
    {
        $this->Subject = $Subject;
    }

    /**
     * @return int
     */

    public function getClient()
    {
        return $this->Client;
    }

    /**
     * @param int $Client
     */

    public function setClient($Client)
    {
        $this->Client = $Client;
    }

    /**
     * @return int
     */

    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param int $User
     */

    public function setUser($User)
    {
        $this->User = $User;
    }

    /**
     * @return int
     */

    public function getValidity()
    {
        return $this->Validity;
    }

    /**
     * @param int $Validity
     */

    public function setValidity($Validity)
    {
        $this->Validity = $Validity;
    }

    /**
     * @return float
     */

    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @param float $Value
     */

    public function setValue($Value)
    {
        $this->Value = $Value;
    }

    /**
     * @return int
     */

    public function getChance()
    {
        return $this->Chance;
    }

    /**
     * @param int $Chance
     */

    public function setChance($Chance)
    {
        $this->Chance = $Chance;
    }

    /**
     * @return string
     */

    public function getCreationDate()
    {
        return $this->CreationDate;
    }

    /**
     * @param string $CreationDate
     */

    public function setCreationDate($CreationDate)
    {
        $this->CreationDate = $CreationDate;
    }

    /**
     * @return string
     */

    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     */

    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    /**
     * @return int
     */

    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param int $Status
     */

    public function setStatus($Status)
    {
        $this->Status = $Status;
    }

    /**
     * @return string
     */

    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     */

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return int
     */

    public function create()
    {
        return $this->db->create($this);
    }

    /**
     * @return array|null
     */

    public function getAllTenders()
    {
        return $this->db->getAllTenders();
    }

    /**
     * @param $id
     * @return array|null
     */

    public function getTenderById($id)
    {
        return $this->db->getTenderById($id);
    }

    /**
     * @param $userId
     * @return array|null
     */

    public function getTendersByUserId($userId)
    {
        return $this->db->getTendersByUserId($userId);
    }

    /**
     * @param $status
     * @return array|null
     */

    public function getAllTendersByStatus($status)
    {
        return $this->db->getAllTendersByStatus($status);
    }

    /**
     * @param $creationdate
     * @param $validity
     */

    public function calcEndDate($creationdate, $validity)
    {
        $date = date('Y-m-d', strtotime($creationdate . " +" . $validity . " days"));
        return $date;
    }

    /**
     * update tender
     */

    public function update()
    {
        return $this->db->update($this);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->db->delete($id);
    }

    public function assignUser($user, $id)
    {
        $this->db->assignUser($user, $id);
    }

    public function getTimeDifference($date1, $date2)
    {
        return $this->db->getTimeDifference($date1, $date2);
    }

    public function updateStatus($id, $status){
        return $this->db->updateStatus($id, $status);
    }
}