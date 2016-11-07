<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 14-Oct-16
 * Time: 08:35
 */

class User
{
    private $db;

    /**
     * Variabele voor het opslaan/ophalen van de naam van de user
     *
     * @var $Name
     */

    private $Name;

    /**
     * Variabele voor het opslaan/ophalen van het id van de user
     *
     * @var $UserId
     */

    private $UserId;

    /**
     * Variabele voor het opslaan/ophalen van de email van de user
     *
     * @var $Email
     */
    private $Email;

    /**
     * Variabele voor het opslaan/ophalen van het wachtwoord van de user
     *
     * @var $Password
     */

    private $Password;

    /**
     * Variabele om klant bedrijfsnaam in op te slaan
     *
     * @var $UserCompany
     */

    private $UserCompany;

    /**
     * Variabele om het adres van de klant in op te slaan
     *
     * @var $UserAdres
     */

    private $UserAdres;

    /**
     * Variabele om de postcode van het bedrijf van de klant in op te slaan
     *
     * @var $UserPostcode
     */

    private $UserPostcode;

    /**
     * Variabele om de plek van het bedrijf van de klant in op te slaan
     *
     * @var $UserPlace
     */

    private $UserPlace;

    /**
     * Variabele om rechtgroep van de gebruiker in op te slaan
     *
     * @var $UserPermGroup
     */

    private $UserPermGroup;

    /**
     * Variabele voor de smtp setting
     *
     * @var $SettingSMTP
     */

    private $SettingSMTP;

    /**
     * Variabele voor de email admin setting
     *
     * @var $SettingEmail
     */

    private $SettingEmail;

    /**
     * Variabele voor het logo van de header
     *
     * @var $SettingLogo
     */

    private $SettingLogo;

    /**
     * Variabele voor de kleur van de header
     *
     * @var $SettingHeader
     */

    private $SettingHeader;

    /**
     * Link naar de database user contructor
     *
     * User constructor.
     */

    public function __construct()
    {
        $this->db = new DbUser();
    }

    /**
     * Functie om gebruikers aan te maken
     *
     * @return mixed
     */

    public function create()
    {
        return $this->db->create($this);
    }

    /**
     * Functie om gebruikers up te daten
     *
     * @return mixed
     */

    public function update()
    {
        return $this->db->update($this);
    }

    /**
     * Functie om gebruiker informatie op te halen
     *
     * @return array|bool|mysqli_result
     */

    public function getUser()
    {
        return $this->db->getUser($this);
    }

    /**
     * Haal de admin instellingen op
     *
     * @return bool
     */

    public function getAdminSettings()
    {
        return $this->db->getAdminSettings();
    }

    /**
     * Set de smtp setting
     *
     * @param $smtp
     */

    public function setSettingsSMTP($smtp)
    {
        $this->SettingSMTP = $smtp;
    }

    /**
     * Set de email van de mailclient
     *
     * @param $mail
     */

    public function setSettingsEmail($mail)
    {
        $this->SettingEmail = $mail;
    }

    /**
     * Set het logo van de header
     *
     * @param $logo
     */

    public function setSettingsLogo($logo)
    {
        $this->SettingLogo = $logo;
    }

    /**
     * Set de kleur van de header
     *
     * @param $headerkleur
     */

    public function setSettingsHeader($headerkleur)
    {
        $this->SettingHeader = $headerkleur;
    }

    /**
     * Haal de smtp setting op
     *
     * @return mixed
     */

    public function getSettingSMTP()
    {
        return $this->SettingSMTP;
    }

    /**
     * Haal de email setting op
     *
     * @return mixed
     */

    public function getSettingEmail()
    {
        return $this->SettingEmail;
    }

    /**
     * Haal de logo setting op
     *
     * @return mixed
     */

    public function getSettingLogo()
    {
        return $this->SettingLogo;
    }

    public function updateSettings()
    {
        return $this->db->updateSettings($this);
    }

    /**
     * Haal de headerkleur setting op
     *
     * @return mixed
     */

    public function getSettingHeader()
    {
        return $this->SettingHeader;
    }

    /**
     * Haal de rechten van de gebruiker voor de pagina op
     *
     * @param $perm
     * @return mixed
     */

    public function getPermission($row, $perm)
    {
        return $this->db->getPermission($row, $perm);
    }

    /**
     * Haal de rechten van de gebruiker op
     *
     * @param $id
     * @return bool
     */

    public function getPermissionGroup($id)
    {
        return $this->db->getPermissionGroup($id);
    }

    /**
     * Geef de variabele $Naam een waarde
     *
     * @param $Name
     */

    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * Geef de variabele $Email een waarde
     *
     * @param $Email
     */

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    /**
     * Geef de variabele $Password een waarde
     *
     * @param $Password
     */

    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    /**
     * Sla het id van de gebruiker op
     *
     * @param $userid
     */

    public function setUserId($userid)
    {
        $this->UserId = $userid;
    }

    /**
     * Sla de naam van het bedrijf op in zijn variabele
     *
     * @param $company
     */

    public function setCompanyName($company)
    {
        $this->UserCompany = $company;
    }

    /**
     * Sla de naam van het adres van het bedrijf van de klant op in zijn variabele
     *
     * @param $useradres
     */

    public function setUserAdres($useradres)
    {
        $this->UserAdres = $useradres;
    }

    /**
     * Sla de postcode van het bedrijf van de klant op in zijn variabele
     *
     * @param $userpostcode
     */

    public function setUserPostcode($userpostcode)
    {
        $this->UserPostcode = $userpostcode;
    }

    /**
     * Haal de plaats van het bedrijf van de klant op
     *
     * @param $userplace
     */

    public function setUserPlace($userplace)
    {
        $this->UserPlace = $userplace;
    }

    /**
     * Set rechtgroep voor de gebruiker
     *
     * @param $userperm
     */

    public function setUserPermgroup($userperm)
    {
        $this->UserPermGroup = $userperm;
    }

    /**
     * Haal de gebruiker op met behulp van het gebruiker id
     *
     * @param $id
     * @return array|null
     */

    public function getUserById($id)
    {
        return $this->db->getUserById($id);
    }

    /**
     * Haal de gebruiker op met behulp van het gebruiker email
     *
     * @param $email
     * @return array|null
     */

    public function getUserByEmail($email)
    {
        return $this->db->getUserByEmail($email);
    }

    /**
     * Haal gebruiker id op
     *
     * @return mixed
     */

    public function getUserId()
    {
        return $this->UserId;
    }

    /**
     * Haal de naam van de gebruikerinformatie op
     *
     * @return mixed
     */

    public function getName()
    {
        return $this->Name;
    }

    /**
     * Haal de email van de gebruikerinformatie op
     *
     * @return mixed
     */

    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Haal het wachtwoord van de gebruikerinformatie op
     *
     * @return mixed
     */

    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * Haal de naam van het bedrijf van de klantop
     *
     * @return mixed
     */

    public function getCompanyName()
    {
        return $this->UserCompany;
    }

    /**
     * Haal het adres van het bedrijf van de klant op
     *
     * @return mixed
     */

    public function getUserAdres()
    {
        return $this->UserAdres;
    }

    /**
     * Haal de postoce van het bedrijf van de klant op
     *
     * @return mixed
     */

    public function getUserPostcode()
    {
        return $this->UserPostcode;
    }

    /**
     * Haal de plaats van het bedrijf van de klant op
     *
     * @return mixed
     */

    public function getUserPlace()
    {
        return $this->UserPlace;
    }

    public function getPermGroup()
    {
        return $this->UserPermGroup;
    }

    /**
     * Update user password
     *
     * @return mixed
     */

    public function updateUser($id, $npassword)
    {
        return $this->db->updateUser($id, $npassword);
    }

    /**
     * Haal alle gebruikers op
     *
     * @param null $limit
     * @param null $offset
     * @return array|null
     */

    public function getAllUsers($limit = null, $offset = null)
    {
        return $this->db->getAllUsers($limit, $offset);
    }

    /**
     * Haal alle klanten op
     *
     * @param null $limit
     * @param null $offset
     * @param $permgroup
     * @return array|null
     */

    public function getAllClients($table, $filter, $limit = null, $offset = null, $permgroup)
    {
        return $this->db->getAllClients($table, $filter, $limit, $offset, $permgroup);
    }

    /**
     * Haal aantal klanten op
     *
     * @return mixed
     */

    public function countClients()
    {
        return $this->db->countClients();
    }

    /**
     * Haal alle gebruikres op die geen klant zijn
     *
     * @param null $limit
     * @param null $offset
     * @param $permgroup
     * @return mixed
     */

    public function getAllUsersByPerm($table, $filter, $limit = null, $offset = null, $permgroup)
    {
        return $this->db->getAllUsersByPerm($table, $filter, $limit, $offset, $permgroup);
    }
    /**
     * Haal aantal resultaten van mails op
     *
     * @return mixed
     */

    public function countBlocks()
    {
        return $this->db->countBlocks();
    }

    /**
     * Zoeken in een tabel
     *
     * @return mixed
     */

    public function searchTable($term, $limit = null, $offset = null, $table = null, $filter = null, $ids = null)
    {
        return $this->db->searchTable($term, $limit, $offset, $table, $filter, $ids);
    }

}