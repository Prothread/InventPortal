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
     * Variabele om de naam van de profielfoto op te slaan
     *
     * @var $ProfImg
     */

    private $ProfImg;

    /**
     * Variabele voor het opslaan/ophalen van de email van de user
     *
     * @var $Email
     */
    private $Email;

    /**
     * Variabele voor alternatief email adres voor de user
     *
     * @var $AltMail
     */

    private $AltMail;

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
     * Variabele om taal van de gebruiker in op te slaan
     *
     * @var $UserLanguage
     */

    private $UserLanguage;

    /**
     * Variabele om rechtgroep van de gebruiker in op te slaan
     *
     * @var $UserPermGroup
     */

    private $UserPermGroup;

    /**
     * Variabele om boolean van actief van de gebruiker in op te slaan
     *
     * @var $UserActive
     */

    private $UserActive;

    /**
     * Variabele voor de smtp setting
     *
     * @var $SettingSMTP
     */

    private $SettingSMTP;

    /**
     * Variabele voor de smtp poort setting
     *
     * @var $SettingSMTPPort
     */

    private $SettingSMTPPort;

    /**
     * Variabele voor de email admin setting
     *
     * @var $SettingEmail
     */

    private $SettingEmail;

    /**
     * Variabele voor email wachtwoord
     *
     * @var $SettingEmailPass
     */

    private $SettingEmailPass;

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
     * Variabele voor de host van de website
     *
     * @var $SettingHost
     */

    private $SettingHost;

    /**
     * Variabele voor checkbox globale email
     *
     * @var $SettingGlobalmail
     */

    private $SettingGlobalmail;

    /**
     * Variabele om het globale email in op te slaan
     *
     * @var $SettingContactmail
     */

    private $SettingContactmail;

    /**
     * Variabele voor de achtergrond op het loginscherm
     *
     * @var $SettingBackground
     */

    private $SettingBackground;

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
     * Delete gebruiker van de database
     *
     * @param $id
     * @return mixed
     */

    public function delete($id)
    {
        return $this->db->delete($id);
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
     * Set de poort van de smtp setting
     *
     * @param $smtpport
     */

    public function setSettingsSMTPPort($smtpport)
    {
        $this->SettingSMTPPort = $smtpport;
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
     * Set het email wachtwoord van de mailclient
     *
     * @param $mailpass
     */

    public function setSettingsEmailPass($mailpass)
    {
        $this->SettingEmailPass = $mailpass;
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
     * Set de host van de website (voor mailing)
     *
     * @param $host
     */

    public function setSettingsHost($host)
    {
        $this->SettingHost = $host;
    }

    /**
     * Check of er aangegeven wordt dat er een globale email is
     *
     * @param $mail
     */

    public function setSettingsGlobalmail($mail)
    {
        $this->SettingGlobalmail = $mail;
    }

    /**
     * Haal de globale email op
     *
     * @return mixed
     */

    public function setSettingsContactmail($mail)
    {
        $this->SettingContactmail = $mail;
    }

    /**
     * Setter voor de achtergrond op het loginscherm
     *
     * @param $background
     */

    public function setSettingsBackground($background)
    {
        $this->SettingBackground = $background;
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
     * Haal de smtp poort op
     *
     * @return mixed
     */

    public function getSettingSMTPPort()
    {
        return $this->SettingSMTPPort;
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
     * Haal het wachtwoord van de email setting op
     *
     * @return mixed
     */

    public function getSettingEmailPass()
    {
        return $this->SettingEmailPass;
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
     * Haal de host setting op
     *
     * @return mixed
     */

    public function getSettingHost()
    {
        return $this->SettingHost;
    }

    /**
     * Check of er aangegeven wordt dat er een globale email is
     *
     * @return mixed
     */

    public function getSettingsGlobalmail()
    {
        return $this->SettingGlobalmail;
    }

    /**
     * Haal de globale email op
     *
     * @return mixed
     */

    public function getSettingsContactmail()
    {
        return $this->SettingContactmail;
    }

    /**
     * Haal achtergrond van
     *
     * @return mixed
     */

    public function getSettingsBackground()
    {
        return $this->SettingBackground;
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
     * Check de groep van de gebruiker
     *
     * @param $value
     * @return mixed
     */

    public function checkUserPerms($value)
    {
        return $this->db->checkUserPerms($value);
    }

    /**
     * Haal de naam van de groep rechten van de klant op
     *
     * @param $value
     * @return mixed
     */

    public function getPermissionGroupName($value)
    {
        return $this->db->getPermissionGroupName($value);
    }

    /**
     * Get all permission groups that can be assigned to a user
     *
     * @return mixed
     */

    public function getAllPermGroups()
    {
        return $this->db->getAllPermGroups();
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
     * Set alternatief email adres voor de klant in een variabele genaamd: $Email
     *
     * @param $Email
     */

    public function setAltmail($Email)
    {
        $this->AltMail = $Email;
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
     * Sla de naam van de profielfoto op
     *
     * @param $profileimg
     */

    public function setProfileImage($profileimg)
    {
        $this->ProfImg = $profileimg;
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
     * Setter voor de taal van de gebruiker
     *
     * @param $language
     */

    public function setUserLanguage($language)
    {
        $this->UserLanguage = $language;
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
     * Setter voor UserActive variabele
     *
     * @param $useractive
     */

    public function setUserActive($useractive)
    {
        $this->UserActive = $useractive;
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
     * Haal profielimage op
     *
     * @return mixed
     */

    public function getProfileImage()
    {
        return $this->ProfImg;
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
     * Haal alternatief email van de gebruikersinformatie op
     *
     * @return mixed
     */

    public function getAltMail()
    {
        return $this->AltMail;
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

    /**
     * Getter voor de taal van de gebruiker
     *
     * @return mixed
     */

    public function getUserLanguage()
    {
        return $this->UserLanguage;
    }

    /**
     * Haal de rechtgroep van de gebruiker op
     *
     * @return mixed
     */

    public function getPermGroup()
    {
        return $this->UserPermGroup;
    }

    /**
     * Getter voor UserActive variabele
     *
     * @return mixed
     */

    public function getUserActive()
    {
        return $this->UserActive;
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
     * @return array|null
     */

    public function getAllClients()
    {
        return $this->db->getAllClients();
    }

    /**
     * Haal alle klanten op met de laatste id's
     *
     * @return array|null
     */

    public function getAllLatestClients()
    {
        return $this->db->getAllLatestClients();
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
     * @return mixed
     */

    public function getAllUsersByPerm($permgroup)
    {
        return $this->db->getAllUsersByPerm($permgroup);
    }

    /**
     * Haal alle gebruikres op die geen klant zijn
     *
     * @return mixed
     */

    public function getFourUsersByPerm($permgroup)
    {
        return $this->db->getFourUsersByPerm($permgroup);
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

    /**
     * Sla een token voor wachtwoord vergeten op
     *
     * @param $token
     * @return mixed
     */

    public function passForget($mail, $token)
    {
        return $this->db->passForget($mail, $token);
    }

    /**
     * Sla een token voor een nieuw wachtwoord aanmaken op
     *
     * @param $token
     * @return mixed
     */

    public function newPassword($mail, $token)
    {
        return $this->db->newPassword($mail, $token);
    }

    /**
     * Functie voor het resetten van het wachtwoord van de gebruiker
     *
     * @param $mail
     * @param $token
     * @param $pass
     * @return mixed
     */

    public function resetPassword($mail, $token, $pass)
    {
        return $this->db->resetPassword($mail, $token, $pass);
    }

    public function getClientKey($name)
    {
        return $this->db->getClientKey($name);
    }

}