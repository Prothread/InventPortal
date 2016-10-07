<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 30-Sep-16
 * Time: 11:48
 */

class Mail {

    private $db;
    private $MailId;
    private $MailSubject;
    private $MailSender;
    private $MailDescription;
    private $MailName;
    private $MailEmail;
    private $MailToken;
    private $MailFake;
    private $MailImage;
    private $MailDatum;
    private $MailVerified;

    public function __construct()
    {
        $this->db = new DbMail();
    }

    public function create()
    {
        return $this->db->create($this);
    }

    public function update()
    {
        return $this->db->update($this);
    }

    public function read()
    {
        return $this->db->read($this);
    }

    public function setMailId($MailId)
    {
        $this->MailId = $MailId;
    }

    public function setMailSubject($MailSubject)
    {
        $this->MailSubject = $MailSubject;
    }

    public function setMailSender($MailSender)
    {
        $this->MailSender = $MailSender;
    }

    public function setMailDescription($MailDescription)
    {
        $this->MailDescription = $MailDescription;
    }

    public function setMailName($MailName)
    {
        $this->MailName = $MailName;
    }

    public function setMailEmail($MailEmail)
    {
        $this->MailEmail = $MailEmail;
    }

    public function setToken($MailToken)
    {
        $this->MailToken = $MailToken;
    }

    public function setFakeImage($FakeImage)
    {
        $this->MailFake = $FakeImage;
    }

    public function setImage($MailImage)
    {
        $this->MailImage = $MailImage;
    }

    public function setDatum($Datum)
    {
        $this->MailDatum = $Datum;
    }

    public function setVerified($Verified)
    {
        $this->MailVerified = $Verified;
    }

    public function getMailId()
    {
        return $this->MailId;
    }

    public function getMailSubject()
    {
        return $this->MailSubject;
    }

    public function getMailSender()
    {
        return $this->MailSender;
    }

    public function getMailDescription()
    {
        return $this->MailDescription;
    }

    public function getMailName()
    {
        return $this->MailName;
    }

    public function getMailEmail()
    {
        return $this->MailEmail;
    }

    public function getToken()
    {
        return $this->MailToken;
    }

    public function getFakeImage()
    {
        return $this->MailFake;
    }

    public function getImage()
    {
        return $this->MailImage;
    }

    public function getDatum()
    {
        return $this->MailDatum;
    }

    public function getVerified()
    {
        return $this->MailVerified;
    }

}