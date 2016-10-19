<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 18-Oct-16
 * Time: 15:19
 */

class Client
{

    /**
     * Variabele om naar dbclient te gaan
     *
     * @var DbClient
     */

    private $db;

    /**
     * Variabele om clientID in op te slaan
     *
     * @var $ClientID
     */

    private $ClientID;

    /**
     * Variabele om klantnaam in op te slaan
     *
     * @var $ClientName
     */

    private $ClientName;

    /**
     * Variabele om klant email in op te slaan
     *
     * @var $ClientEmail
     */

    private $ClientEmail;

    /**
     * Variabele om klant paswoord in op te slaan
     *
     * @var $ClientPassword
     */

    private $ClientPassword;

    /**
     * Variabele om klant bedrijfsnaam in op te slaan
     *
     * @var $ClientCompany
     */

    private $ClientCompany;

    /**
     * Variabele om het adres van de klant in op te slaan
     *
     * @var $ClientAdres
     */

    private $ClientAdres;

    /**
     * Variabele om de postcode van het bedrijf van de klant in op te slaan
     *
     * @var $ClientPostcode
     */

    private $ClientPostcode;

    /**
     * Variabele om de plek van het bedrijf van de klant in op te slaan
     *
     * @var $ClientPlace
     */

    private $ClientPlace;

    /**
     * Redirect naar dbclient
     *
     * Client constructor.
     */

    public function __construct()
    {
        $this->db = new DbClient();
    }

    /**
     * Maak een nieuwe klant aan
     *
     * @return bool
     */

    public function newClient()
    {
        return $this->db->newClient($this);
    }

    /**
     * Update de klantinformatie
     *
     * @return mixed
     */

    public function updateClient()
    {
        return $this->db->updateClient($this);
    }

    /**
     * Haal klant informatie op voor het inlogscherm
     *
     * @return mixed
     */

    public function getClient()
    {
        return $this->db->getClient($this);
    }

    /**
     * Haal de klant op met id
     *
     * @param $id
     * @return array|null
     */

    public function getClientById($id)
    {
        return $this->db->getClientById($id);
    }

    /**
     * Haal de klant op met de meegestuude email
     *
     * @param $email
     * @return mixed
     */

    public function getClientByEmail($email)
    {
        return $this->db->getClientByEmail($email);
    }

    /**
     * Redirect naar de database om alle klante op te halen
     *
     * @return array|null
     */

    public function getAllClients()
    {
        return $this->db->getAllClients();
    }

    /**
     * Sla de klant id op
     *
     * @param $clientid
     */

    public function setClientId($clientid)
    {
        $this->ClientID = $clientid;
    }

    /**
     * Sla de klantnaam op in zijn variabele
     *
     * @param $clientname
     */

    public function setClientName($clientname)
    {
        $this->ClientName = $clientname;
    }

    /**
     * Sla de naam van het bedrijf op in zijn variabele
     *
     * @param $company
     */

    public function setCompanyName($company)
    {
        $this->ClientCompany = $company;
    }

    /**
     * Sla de naam van de klant op in zijn variabele
     *
     * @param $clientemai
     */

    public function setClientEmail($clientemai)
    {
        $this->ClientEmail = $clientemai;
    }

    /**
     * Sla het wachtwoord van de klant op
     *
     * @param setClientPassword
     */

    public function setClientPassword($clientpass)
    {
        $this->ClientPassword = $clientpass;
    }

    /**
     * Sla de naam van het adres van het bedrijf van de klant op in zijn variabele
     *
     * @param $clientadres
     */

    public function setClientAdres($clientadres)
    {
        $this->ClientAdres = $clientadres;
    }

    /**
     * Sla de postcode van het bedrijf van de klant op in zijn variabele
     *
     * @param $clientpostcode
     */

    public function setClientPostcode($clientpostcode)
    {
        $this->ClientPostcode = $clientpostcode;
    }

    /**
     * Haal de plaats van het bedrijf van de klant op
     *
     * @param $clientplace
     */

    public function setClientPlace($clientplace)
    {
        $this->ClientPlace = $clientplace;
    }

    /**
     * Haal de klant id op
     *
     * @return mixed
     */

    public function getClientId()
    {
        return $this->ClientID;
    }

    /**
     * Haal de naam van de klant op
     *
     * @return mixed
     */

    public function getClientName()
    {
        return $this->ClientName;
    }

    /**
     * Haal de naam van het bedrijf van de klantop
     *
     * @return mixed
     */

    public function getCompanyName()
    {
        return $this->ClientCompany;
    }

    /**
     * Haal de email van de klant op
     *
     * @return mixed
     */

    public function getClientEmail()
    {
        return $this->ClientEmail;
    }

    /**
     * Haal het wachwoord van de klant op
     *
     * @return mixed
     */

    public function getClientPassword()
    {
        return $this->ClientPassword;
    }

    /**
     * Haal het adres van het bedrijf van de klant op
     *
     * @return mixed
     */

    public function getClientAdres()
    {
        return $this->ClientAdres;
    }

    /**
     * Haal de postoce van het bedrijf van de klant op
     *
     * @return mixed
     */

    public function getClientPostcode()
    {
        return $this->ClientPostcode;
    }

    /**
     * Haal de plaats van het bedrijf van de klant op
     *
     * @return mixed
     */

    public function getClientPlaats()
    {
        return $this->ClientPlace;
    }

}