<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 18-Oct-16
 * Time: 15:18
 */

class ClientController
{

    /**
     * Variabele om met client model te verbinden
     *
     * @var Client
     */

    private $model;

    /**
     * Verbinding met client model
     *
     * ClientController constructor.
     */

    public function __construct()
    {
        $this->model = new Client();
    }

    /**
     * Maak een nieuwe klant aan
     *
     * @param array $clientinfo
     * @return bool
     */

    public function newClient(array $clientinfo)
    {
        $this->model->setClientName($clientinfo['naam']);
        $this->model->setClientEmail($clientinfo['email']);
        $this->model->setClientPassword($clientinfo['password']);
        $this->model->setCompanyName($clientinfo['bedrijfsnaam']);
        $this->model->setClientAdres($clientinfo['adres']);
        $this->model->setClientPostcode($clientinfo['postcode']);
        $this->model->setClientPlace($clientinfo['plaats']);

        if ($result = $this->model->newClient()) {
            echo('Success, de klant is succesvol aangemaakt.');
            return $result;
        }
    }

    /**
     * Update klant met meegegeven id
     *
     * @param array $clientinfo
     * @return bool
     */

    public function updateClient(array $clientinfo)
    {
        $this->model->setClientId($clientinfo['id']);
        $this->model->setClientName($clientinfo['naam']);
        $this->model->setClientEmail($clientinfo['email']);
        $this->model->setClientPassword($clientinfo['password']);
        $this->model->setCompanyName($clientinfo['bedrijfsnaam']);
        $this->model->setClientAdres($clientinfo['adres']);
        $this->model->setClientPostcode($clientinfo['postcode']);
        $this->model->setClientPlace($clientinfo['plaats']);

        if ($result = $this->model->updateClient()) {
            echo('Success, de klant is succesvol bijgewerkt.');
            return $result;
        }
    }

    /**
     * Haal de klant op voor het inlogscherm
     *
     * @param array $userinfo
     * @return bool
     */

    public function getClient(array $userinfo)
    {
        $this->model->setClientEmail($userinfo['email']);
        $this->model->setClientPassword($userinfo['password']);

        if ($result = $this->model->getClient()) {
            return $result;
        }
        return false;
    }

    /**
     * Haal klant op met een id
     *
     * @return mixed
     */

    public function getClientById($id)
    {
        return $this->model->getClientById($id);
    }

    /**
     * Haal de klant op met een meegestuude email
     *
     * @param $email
     * @return mixed
     */

    public function getClientByEmail($email)
    {
        return $this->model->getClientByEmail($email);
    }

    /**
     * Haal alle klanten op
     *
     * @return array|null
     */

    public function getAllClients($limit = null, $offset = null)
    {
        return $this->model->getAllClients($limit, $offset);
    }

    /**
     * Haal aantal resultaten van mails op
     *
     * @return mixed
     */

    public function countBlocks()
    {
        return $this->model->countBlocks();
    }

    /**
     * Haal de groep van rechten vande gebruiker op
     *
     * @param $id
     * @return mixed
     */

    public function getPermissionGroup($id)
    {
        return $this->model->getPermissionGroup($id);
    }

}