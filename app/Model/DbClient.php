<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 18-Oct-16
 * Time: 15:20
 */

class DbClient extends Database
{

    /**
     * Maak een nieuwe klant aan
     *
     * @param Client $client
     * @return bool
     */

    public function newClient(Client $client)
    {
        $sql = "INSERT INTO `clients` (`naam`, `email`, `bedrijfsnaam`, `adres`, `postcode`, `plaats`) VALUES ('{$client->getClientName()}', '{$client->getClientEmail()}',
        '{$client->getCompanyName()}', '{$client->getClientAdres()}', '{$client->getClientPostcode()}', '{$client->getClientPlaats()}')";

        if($this->dbQuery($sql)){
            return true;
        }
    }

    /**
     * Update de klant informatie
     *
     * @param Client $client
     * @return bool
     */

    public function updateClient(Client $client)
    {
        $sql = "UPDATE `clients` SET `naam` = '{$client->getClientName()}', `email` = '{$client->getClientEmail()}', `bedrijfsnaam` = '{$client->getCompanyName()}',
        `adres` = '{$client->getClientAdres()}', `postcode` = '{$client->getClientPostcode()}', `plaats` = '{$client->getClientPlaats()}') WHERE `id` = '{$client->getClientId()}'";

        if($this->dbQuery($sql)){
            echo 'test';
            return true;
        }
        return false;
    }

    /**
     * Haal de klant op met een id
     *
     * @param $id
     * @return array|null
     */

    public function getClientById($id)
    {

        $sql = "SELECT * FROM `clients` WHERE `id` = '{$id}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value;
        }
    }

    /**
     * Haal alle klanten op
     *
     * @return array|null
     */

    public function getAllClients()
    {
        $sql = "SELECT * FROM `clients`";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($value){
            return $value;
        }
    }

}