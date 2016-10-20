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
        $password = $password = hash('sha256', $client->getClientPassword());

        $sql = "INSERT INTO `clients` (`naam`, `email`, `paswoord`, `bedrijfsnaam`, `adres`, `postcode`, `plaats`) VALUES ('{$client->getClientName()}', '{$client->getClientEmail()}',
        '{$password}', '{$client->getCompanyName()}', '{$client->getClientAdres()}', '{$client->getClientPostcode()}', '{$client->getClientPlaats()}')";

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
        $password = $password = hash('sha256', $client->getClientPassword());

        $sql = "UPDATE `clients` SET `naam` = '{$client->getClientName()}', `email` = '{$client->getClientEmail()}', `paswoord` = '{$password}', `bedrijfsnaam` = '{$client->getCompanyName()}',
        `adres` = '{$client->getClientAdres()}', `postcode` = '{$client->getClientPostcode()}', `plaats` = '{$client->getClientPlaats()}') WHERE `id` = '{$client->getClientId()}'";

        if($this->dbQuery($sql)){
            echo 'test';
            return true;
        }
        return false;
    }

    /**
     * Haal klant op voor het inlogscherm
     *
     * @param Client $user
     * @return array|bool|mysqli_result
     */

    public function getClient(Client $user)
    {
        $email = $user->getClientEmail();
        $password = $password = hash('sha256', $user->getPassword());

        $sql = "SELECT * FROM clients WHERE email = '" . $email. "' and paswoord = '" .$password . "'";

        if($result = $this->dbQuery($sql)){
            return $result;
        }
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
     * Haal de klant op met de email van die klant
     *
     * @param $email
     * @return array|null
     */

    public function getClientByEmail($email)
    {
        $sql = "SELECT * FROM `clients` WHERE `email` = '{$email}'";

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

    public function getAllClients($limit = null, $offset = null)
    {
        $sql = "SELECT * FROM `clients`";

        if($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if($offset) {
            $sql .= " OFFSET {$offset}";
        }

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($value){
            return $value;
        }
    }

    /**
     * Haal het aantal geburikers op
     *
     * @return mixed
     */

    public function countBlocks()
    {
        $query ="SELECT COUNT(`id`) AS 'total_blocks' FROM `clients`";

        if($result = $this->dbFetchArray($query)){
            return $result['total_blocks'];
        }
        return false;
    }

}