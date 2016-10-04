<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 30-Sep-16
 * Time: 11:48
 */

class Mail {

    private $db;
    private $MailSubject;
    private $MailSender;
    private $MailDescription;
    private $MailName;
    private $MailEmail;
    private $MailToken;
    private $MailImage;
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

    public function setImage($MailImage)
    {
        $this->MailImage = $MailImage;
    }

    public function setVerified($Verified)
    {
        $this->MailVerified = $Verified;
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

    public function getImage()
    {
        return $this->MailImage;
    }

    public function getVerified()
    {
        return $this->MailVerified;
    }

}