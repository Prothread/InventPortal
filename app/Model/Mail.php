<?php

#SETUP FOR MAIL

class Mail
{

    private $db;

    /**
     * Variabele om MailUserId op te slaan
     *
     * @var $MailUserId
     */

    private $MailUserId;

    /**
     * Variabele om MailClientId op te slaan
     *
     * @var $MailClientId
     */

    private $MailClientId;

    /**
     * Variabele om MailId op te slaan
     *
     * @var $MailId
     */

    private $MailId;

    /**
     * Variabele om ht id van de klant in op te slaan
     *
     * @var $ClientID
     */

    private $ClientID;

    /**
     * Variabele om MailSubject op te slaan
     *
     * @var $MailSubject
     */

    private $MailSubject;

    /**
     * Variabele om MailSender op te slaan
     *
     * @var $MailSender
     */

    private $MailSender;

    /**
     * Variabele om MailDescription op te slaan
     *
     * @var $MailDescription
     */

    private $MailDescription;

    /**
     * Variabele om MailName op te slaan
     *
     * @var $MailName
     */

    private $MailName;

    /**
     * Variabele om MailEmail op te slaan
     *
     * @var $MailEmail
     */

    private $MailEmail;

    /**
     * Variabele om MailToken op te slaan
     *
     * @var $MailToken
     */

    private $MailToken;

    /**
     * Variabele om MailFake (neppe naam voor image) op te slaan
     *
     * @var $MailFake
     */

    private $MailFake;

    /**
     * Variabele om MailImage op te slaan
     *
     * @var $MailImage
     */

    private $MailImage;

    /**
     * Variabele om MailAnswer op te slaan
     *
     * @var $MailAnswer
     */

    private $MailAnswer;

    /**
     * Variabele om MailDatum op te slaan
     *
     * @var $MailDatum
     */

    private $MailDatum;

    /**
     * Variabele om MailVerified op te slaan
     *
     * @var $MailVerified
     */

    private $MailVerified;

    /**
     * Variabele om MailComment in op te slaan
     *
     * @var $MailComment
     */

    private $MailComment;

    /**
     * Sla de commentgroep op
     *
     * @var $Commentgroup
     */

    private $Commentgroup;

    /**
     * Constructor om te verbinden met DbMail
     *
     * Mail constructor.
     */

    public function __construct()
    {
        $this->db = new DbMail();
    }

    /**
     * Functie om de informatie te creeren
     *
     * @return bool|mixed
     */

    public function create()
    {
        return $this->db->create($this);
    }

    /**
     * Functie om informatie up te daten
     *
     * @return array|bool|mysqli_result
     */

    public function update()
    {
        return $this->db->update($this);
    }

    /**
     * Haal een mail op met een meegestuurd id
     *
     * @param $id
     * @return mixed
     */

    public function getMailById($id)
    {
        return $this->db->getMailById($id);
    }

    /**
     * Haal meerdere mails op met een mail id
     *
     * @param $ids
     * @return mixed
     */
    public function getMailsById($ids)
    {
        return $this->db->getMailsById($ids);
    }

    /**
     * Haal een mail op met een meegestuurd id
     *
     * @param $status
     * @return mixed
     */

    public function getUserMailByStatus($status)
    {
        return $this->db->getUserMailByStatus($status);
    }

    /**
     * Tel het aantal mails van de gebruiker met de status en hun id
     *
     * @param $id , $status
     * @return mixed
     */
    public function CountUserMailbyIdStatus($id, $status)
    {
        return $this->db->CountUserMailbyIdStatus($id, $status);
    }

    /**
     * Haal alle mail van de gebruiker op met een id en een filter
     *
     * @return mixed
     */

    public function getUserMailByUserId($id, $date = null, $verified = null, $clientid = null)
    {
        return $this->db->getUserMailByUserId($id, $date, $verified, $clientid);
    }

    /**
     * Tel het aantal mails van de user
     *
     * @return mixed
     */

    public function countUserMailByUserId($id)
    {
        return $this->db->countUserMailByUserId($id);
    }

    /**
     * Haal alle mail van de meegegeven gebruiker en de status op
     *
     * @return mixed
     */

    public function getUserMail($id, $status)
    {
        return $this->db->getUserMail($id, $status);
    }

    /**
     * Sla meegegeven informatie op in de MailUserId variabele
     *
     * @param $MailUserId
     */

    public function setMailUserId($MailUserId)
    {
        $this->MailUserId = $MailUserId;
    }

    /**
     * Sla gegevens op in MailClientId variabele
     *
     * @param $MailClientId
     */

    public function setMailClientId($MailClientId)
    {
        $this->MailClientId = $MailClientId;
    }

    /**
     * Sla meegegeven informatie op in de MailId variabele
     *
     * @param $MailId
     */

    public function setMailId($MailId)
    {
        $this->MailId = $MailId;
    }

    /**
     * ID van de geselecteerde klant
     *
     * @param $clientid
     */

    public function setClientID($clientid)
    {
        $this->ClientID = $clientid;
    }

    /**
     * Sla meegegeven informatie op in de setMailSubject variabele
     *
     * @param setMailSubject
     */

    public function setMailSubject($MailSubject)
    {
        $this->MailSubject = $MailSubject;
    }

    /**
     * Sla meegegeven informatie op in de setMailSender variabele
     *
     * @param setMailSender
     */

    public function setMailSender($MailSender)
    {
        $this->MailSender = $MailSender;
    }

    /**
     * Sla meegegeven informatie op in de setMailDescription variabele
     *
     * @param setMailDescription
     */

    public function setMailDescription($MailDescription)
    {
        $this->MailDescription = $MailDescription;
    }

    /**
     * Sla meegegeven informatie op in de setMailName variabele
     *
     * @param setMailName
     */

    public function setMailName($MailName)
    {
        $this->MailName = $MailName;
    }

    /**
     * Sla meegegeven informatie op in de setMailEmail variabele
     *
     * @param setMailEmail
     */

    public function setMailEmail($MailEmail)
    {
        $this->MailEmail = $MailEmail;
    }

    /**
     * Sla meegegeven informatie op in de setToken variabele
     *
     * @param setToken
     */

    public function setToken($MailToken)
    {
        $this->MailToken = $MailToken;
    }

    /**
     * Sla meegegeven informatie op in de setFakeImage variabele
     *
     * @param setFakeImage
     */

    public function setFakeImage($FakeImage)
    {
        $this->MailFake = $FakeImage;
    }

    /**
     * Sla meegegeven informatie op in de setImage variabele
     *
     * @param setImage
     */

    public function setImage($MailImage)
    {
        $this->MailImage = $MailImage;
    }

    /**
     * Sla meegegeven informatie op in de setAnswer variabele
     *
     * @param setAnswer
     */

    public function setAnswer($MailAnswer)
    {
        $this->MailAnswer = $MailAnswer;
    }

    /**
     * Sla meegegeven informatie op in de setDatum variabele
     *
     * @param setDatum
     */

    public function setDatum($Datum)
    {
        $this->MailDatum = $Datum;
    }

    /**
     * Sla meegegeven informatie op in de setVerified variabele
     *
     * @param setVerified
     */

    public function setVerified($Verified)
    {
        $this->MailVerified = $Verified;
    }

    /**
     * Sla informatie van interne opmerking in de variabele MailComment op
     *
     * @param $Comment
     */

    public function setMailComment($Comment)
    {
        $this->MailComment = $Comment;
    }

    public function setCommentGroup($Commentgroep)
    {
        $this->Commentgroup = $Commentgroep;
    }

    /**
     * Haal de informatie voor MailId op
     *
     * @param getMailId
     */

    public function getMailUserId()
    {
        return $this->MailUserId;
    }

    /**
     * Haal de klant id voor mail
     *
     * @return mixed
     */

    public function getMailClientId()
    {
        return $this->MailClientId;
    }

    /**
     * Haal de informatie voor MailId op
     *
     * @param getMailId
     */

    public function getMailId()
    {
        return $this->MailId;
    }

    /**
     * ID van de geselecteerde klant
     *
     * @param ClientID
     */

    public function getClientID()
    {
        return $this->ClientID;
    }

    /**
     * Haal de informatie voor getMailSubject op
     *
     * @param getMailSubject
     */

    public function getMailSubject()
    {
        return $this->MailSubject;
    }

    /**
     * Haal de informatie voor getMailSender op
     *
     * @param getMailSender
     */

    public function getMailSender()
    {
        return $this->MailSender;
    }

    /**
     * Haal de informatie voor getMailDescription op
     *
     * @param getMailDescription
     */

    public function getMailDescription()
    {
        return $this->MailDescription;
    }

    /**
     * Haal de informatie voor getMailName op
     *
     * @param getMailName
     */

    public function getMailName()
    {
        return $this->MailName;
    }

    /**
     * Haal de informatie voor getMailEmail op
     *
     * @param getMailEmail
     */

    public function getMailEmail()
    {
        return $this->MailEmail;
    }

    /**
     * Haal de informatie voor getToken op
     *
     * @param getToken
     */

    public function getToken()
    {
        return $this->MailToken;
    }

    /**
     * Haal de informatie voor getFakeImage op
     *
     * @param getFakeImage
     */

    public function getFakeImage()
    {
        return $this->MailFake;
    }

    /**
     * Haal de informatie voor getImage op
     *
     * @param getImage
     */

    public function getImage()
    {
        return $this->MailImage;
    }

    /**
     * Haal de informatie voor getAnswer op
     *
     * @param getAnswer
     */

    public function getAnswer()
    {
        return $this->MailAnswer;
    }

    /**
     * Haal de informatie voor getDatum op
     *
     * @param getDatum
     */

    public function getDatum()
    {
        return $this->MailDatum;
    }

    /**
     * Haal de informatie voor getVerified op
     *
     * @param getVerified
     */

    public function getVerified()
    {
        return $this->MailVerified;
    }

    /**
     * Haal de informatie van voor getComment op
     *
     * @return mixed
     */

    public function getComment()
    {
        return $this->MailComment;
    }

    /**
     * Haal de commentgroep op
     *
     * @return mixed
     */

    public function getCommentGroup()
    {
        return $this->Commentgroup;
    }

    /**
     * Zoeken in een tabel
     *
     * @return mixed
     */

    public function searchTable($term, $limit = null, $offset = null, $table = null, $filter = null, $ids = null, $status = null)
    {
        return $this->db->searchTable($term, $limit, $offset, $table, $filter, $ids, $status);
    }

    /**
     * Haal usermail op met de meegestuurde mailid variabele
     *
     * @param $MailID
     * @return mixed
     */

    public function getUserMailbyMailID($MailID)
    {
        return $this->db->getUserMailbyMailID($MailID);
    }

    /**
     * Delete item met een (meegegeven) id
     *
     * @param $id
     * @return bool
     */

    public function deleteItemByID($id)
    {
        return $this->db->deleteItemByID($id);
    }

    /**
     * Weiger het item (bv als de klant het heeft goedgekeuren, maar het is nog niet helemaal goed)
     *
     * @param $id
     * @return mixed
     */

    public function weigerItemByID($id)
    {
        return $this->db->weigerItemByID($id);
    }

}