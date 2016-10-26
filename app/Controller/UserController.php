<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 14-Oct-16
 * Time: 08:33
 */

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Informatie voor een user aan te maken
     *
     * @param array $userinfo
     * @return mixed
     */

    public function create(array $userinfo)
    {
        if(isset($userinfo['id'])) {
            $this->model->setUserId($userinfo['id']);
        }

        $this->model->setName($userinfo['name']);
        $this->model->setEmail($userinfo['email']);
        $this->model->setPassword($userinfo['password']);

        if(isset($userinfo['bedrijfsnaam'])) {
            $this->model->setCompanyName($userinfo['bedrijfsnaam']);
        }
        if(isset($userinfo['adres'])) {
            $this->model->setUserAdres($userinfo['adres']);
        }
        if(isset($userinfo['postcode'])) {
            $this->model->setUserPostcode($userinfo['postcode']);
        }
        if(isset($userinfo['plaats'])) {
            $this->model->setUserPlace($userinfo['plaats']);
        }

        $this->model->setUserPermgroup($userinfo['permgroup']);

        if ($result = $this->model->create()) {
            echo('Success, de user is succesvol aangemaakt.');
            return $result;
        }

    }

    /**
     * Update klant
     *
     * @param array $userinfo
     * @return mixed
     */

    public function update(array $userinfo)
    {
        if(isset($userinfo['id'])) {
            $this->model->setUserId($userinfo['id']);
        }

        $this->model->setName($userinfo['name']);
        $this->model->setEmail($userinfo['email']);
        $this->model->setPassword($userinfo['password']);

        if(isset($userinfo['bedrijfsnaam'])) {
            $this->model->setCompanyName($userinfo['bedrijfsnaam']);
        }
        if(isset($userinfo['adres'])) {
            $this->model->setUserAdres($userinfo['adres']);
        }
        if(isset($userinfo['postcode'])) {
            $this->model->setUserPostcode($userinfo['postcode']);
        }
        if(isset($userinfo['plaats'])) {
            $this->model->setUserPlace($userinfo['plaats']);
        }

        $this->model->setUserPermgroup($userinfo['permgroup']);


        if ($result = $this->model->update()) {
            echo('Success, de klant is succesvol bijgewerkt.');
            return $result;
        }
    }

    /**
     * Haal de rechten van de gebruiker voor de pagina op
     *
     * @param $perm
     * @return mixed
     */

    public function getPermission($row, $perm)
    {
        return $this->model->getPermission($row, $perm);
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

    /**
     * Haal user op
     *
     * @param array $userinfo
     * @return array|bool|mysqli_result
     */

    public function getUser(array $userinfo)
    {
        $this->model->setEmail($userinfo['email']);
        $this->model->setPassword($userinfo['password']);

        if ($result = $this->model->getUser()) {
            return $result;
        }
        return false;
    }

    /**
     * Haal user met de meegegeven id op
     *
     * @param $id
     * @return array|null
     */

    public function getUserById($id)
    {
        return $this->model->getUserById($id);
    }

    /**
     * Haal user met het meegegeven email
     *
     * @param $email
     * @return array|null
     */

    public function getUserByEmail($email)
    {
        return $this->model->getUserByEmail($email);
    }

    /**
     * Update user password
     *
     * @return mixed
     */

    public function updateUser($id, $npassword)
    {
        return $this->model->updateUser($id, $npassword);
    }

    /**
     * Haal alle gebruikers op
     *
     * @return array|null
     */

    public function getAllUsers($limit = null, $offset = null)
    {
        return $this->model->getAllUsers($limit, $offset);
    }

    /**
     * Haal alle klanten op
     *
     * @return array|null
     */

    public function getAllClients($limit = null, $offset = null, $permgroup)
    {
        return $this->model->getAllClients($limit, $offset, $permgroup);
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
     * Zoeken in een tabel
     *
     * @return mixed
     */

    public function searchTable($term)
    {
        return $this->model->searchTable($term);
    }

}