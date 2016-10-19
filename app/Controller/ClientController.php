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
     * Haal klant op met een id
     *
     * @return mixed
     */

    public function getClientById($id)
    {
        return $this->model->getClientById($id);
    }

    /**
     * Haal alle klanten op
     *
     * @return array|null
     */

    public function getAllClients()
    {
        return $this->model->getAllClients();
    }

}