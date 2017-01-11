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
        if (isset($userinfo['id'])) {
            $this->model->setUserId($userinfo['id']);
        }

        $this->model->setName($userinfo['name']);
        $this->model->setEmail($userinfo['email']);
        if (isset($userinfo['altmail'])) {
            $this->model->setAltmail($userinfo['altmail']);
        }
        $this->model->setPassword($userinfo['password']);

        if (isset($userinfo['bedrijfsnaam'])) {
            $this->model->setCompanyName($userinfo['bedrijfsnaam']);
        }
        if (isset($userinfo['adres'])) {
            $this->model->setUserAdres($userinfo['adres']);
        }
        if (isset($userinfo['postcode'])) {
            $this->model->setUserPostcode($userinfo['postcode']);
        }
        if (isset($userinfo['plaats'])) {
            $this->model->setUserPlace($userinfo['plaats']);
        }

        $this->model->setUserPermgroup($userinfo['permgroup']);

        if ($result = $this->model->create()) {
            Session::flash('message', ' De gebruiker is succesvol aangemaakt.');
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
        if (isset($userinfo['id'])) {
            $this->model->setUserId($userinfo['id']);
        }

        if (isset($userinfo['profimg'])) {
            $this->model->setProfileImage($userinfo['profimg']);
        }

        if (isset($userinfo['name'])) {
            $this->model->setName($userinfo['name']);
        }

        if (isset($userinfo['email'])) {
            $this->model->setEmail($userinfo['email']);
        }

        if (isset($userinfo['altmail'])) {
            $this->model->setAltmail($userinfo['altmail']);
        }

        if (isset($userinfo['password'])) {
            $this->model->setPassword($userinfo['password']);
        }

        if (isset($userinfo['bedrijfsnaam'])) {
            $this->model->setCompanyName($userinfo['bedrijfsnaam']);
        }

        if (isset($userinfo['adres'])) {
            $this->model->setUserAdres($userinfo['adres']);
        }

        if (isset($userinfo['postcode'])) {
            $this->model->setUserPostcode($userinfo['postcode']);
        }

        if (isset($userinfo['plaats'])) {
            $this->model->setUserPlace($userinfo['plaats']);
        }

        if (isset($userinfo['permgroup'])) {
            $this->model->setUserPermgroup($userinfo['permgroup']);
        }


        if ($result = $this->model->update()) {
            Session::flash('message', 'De gebruiker is succesvol bijgewerkt');
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
     * Haal de instellingen van de admin op
     *
     * @return mixed
     */

    public function getAdminSettings()
    {
        return $this->model->getAdminSettings();
    }

    /**
     * Setters voor de instellingen van de admin
     *
     * @param $settingsarray
     * @return bool
     */

    public function updateSettings($settingsarray)
    {
        $this->model->setSettingsSMTP($settingsarray['SMTP']);
        $this->model->setSettingsSMTPPort($settingsarray['SMTPport']);
        $this->model->setSettingsEmail($settingsarray['Email']);
        $this->model->setSettingsEmailPass($settingsarray['Mailpass']);
        $this->model->setSettingsLogo($settingsarray['Logo']);
        $this->model->setSettingsHeader($settingsarray['Header']);
        $this->model->setSettingsHost($settingsarray['Host']);

        if ($result = $this->model->updateSettings()) {
            return $result;
        }
        return false;
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
     * Haal de naam van de groep rechten van de klant op
     *
     * @param $value
     * @return mixed
     */

    public function getPermissionGroupName($value)
    {
        return $this->model->getPermissionGroupName($value);
    }

    /**
     * Get all permission groups that can be assigned to a user
     *
     * @return mixed
     */

    public function getAllPermGroups()
    {
        return $this->model->getAllPermGroups();
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
     * Haal alle goede accorderingen op bij een bepaalde gebruiker
     *
     * @return array|null
     */

    public function getUserAcceptedByName($verstuurder)
    {
        return $this->model->getUserAcceptedByName($verstuurder);
    }

    /**
     * Haal alle accorderingen op bij een bepaalde gebruiker
     *
     * @return array|null
     */

    public function getUserItemsByName($verstuurder)
    {
        return $this->model->getUserItemsByName($verstuurder);
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

    /**
     * Haal alle klanten op met de laatste id's
     *
     * @return array|null
     */

    public function getAllLatestClients()
    {
        return $this->model->getAllLatestClients();
    }

    /**
     * Haal alle gebruikers op die geen klant zijn
     *
     * @return array|null
     */

    public function getAllUsersByPerm($permgroup)
    {
        return $this->model->getAllUsersByPerm($permgroup);
    }

    /**
     * Haal aantal klanten op
     *
     * @return mixed
     */

    public function countClients()
    {
        return $this->model->countClients();
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

    public function searchTable($term, $limit = null, $offset = null, $table = null, $filter = null, $ids = null)
    {
        return $this->model->searchTable($term, $limit, $offset, $table, $filter, $ids);
    }

    /**
     * Sla een token voor wachtwoord vergeten op
     *
     * @param $token
     * @return mixed
     */

    public function passForget($mail, $token)
    {
        return $this->model->passForget($mail, $token);
    }

    /**
     * Sla een token voor een nieuw wachtwoord aanmaken op
     *
     * @param $token
     * @return mixed
     */

    public function newPassword($mail, $token)
    {
        return $this->model->newPassword($mail, $token);
    }

    /**
     * Functie voor het resetten van de gebruikers wachtwoord
     *
     * @param $mail
     * @param $token
     * @param $pass
     * @return mixed
     */

    public function resetPassword($mail, $token, $pass)
    {
        return $this->model->resetPassword($mail, $token, $pass);
    }

    public function getUserIP()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } else if (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

}