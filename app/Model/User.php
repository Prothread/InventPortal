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
     * Functie om gebruiker informatie op te halen
     *
     * @return array|bool|mysqli_result
     */

    public function getUser()
    {
        return $this->db->getUser($this);
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

}