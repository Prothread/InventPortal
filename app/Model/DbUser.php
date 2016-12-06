<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 14-Oct-16
 * Time: 08:37
 */

class DbUser extends Database
{

    /**
     * Maak een gebruiker aan met de meegestuurde informatie
     *
     * @param User $user
     * @return mixed
     */

    public function create(User $user)
    {
        $name = $user->getName();
        $email = $user->getEmail();
        $password = hash('sha256', $user->getPassword());

        $sql = "INSERT INTO `users` (`naam`, `email`, `altmail`,  `paswoord`, `permgroup`, `bedrijfsnaam`, `adres`, `postcode`, `plaats`) VALUES('" . $name . "', '" . $email . "', '{$user->getAltMail()}', '" . $password . "', '{$user->getPermGroup()}',
        '{$user->getCompanyName()}', '{$user->getUserAdres()}', '{$user->getUserPostcode()}', '{$user->getUserPlace()}')";

        if($this->dbQuery($sql)){
            return $this->dbLastInsertedId();
        }

    }



    public function update(User $user)
    {
        $sql = "UPDATE `users` SET `naam` = '{$user->getName()}', `email` = '{$user->getEmail()}', `bedrijfsnaam` = '{$user->getCompanyName()}', `permgroup` = '{$user->getPermGroup()}',
        `adres` = '{$user->getUserAdres()}', `postcode` = '{$user->getUserPostcode()}', `plaats` = '{$user->getUserPlace()}'";

        if($user->getPassword() !== null) {
            $password = hash('sha256', $user->getPassword());
            $sql .= ", `paswoord` = '{$password}' ";
        }

        if($user->getAltMail() !== null) {
            $sql .= ", `altmail` = '{$user->getAltmail()}' ";
        }

        if( $user->getProfileImage() !== null) {
            $sql .= ", `profimg` = '{$user->getProfileImage()}' ";
        }
        $sql .= " WHERE `id` = '{$user->getUserId()}'";

        if($this->dbQuery($sql)){
            return true;
        }
        return false;
    }

    /**
     * Haal je gebruiker op
     *
     * @param User $user
     * @return array|bool|mysqli_result
     */

    public function getUser(User $user)
    {
        $email = $user->getEmail();
        $password = hash('sha256', $user->getPassword());

        $sql = "SELECT * FROM users WHERE email = '" . $email. "' and paswoord = '" .$password . "'";

        if($result = $this->dbQuery($sql)){
            return $result;
        }
    }

    /**
     * Haal admin instellingen op
     *
     * @return bool
     */

    public function getAdminSettings()
    {
        $sql = "SELECT * FROM `settings` WHERE `id` = '0'";

        if($result = $this->dbQuery($sql)) {
            return mysqli_fetch_assoc( $result );
        }
        return false;
    }

    public function updateSettings(User $setting)
    {
        $sql = "UPDATE `settings` SET `SMTP` = '{$setting->getSettingSMTP()}', `SMTPport` = '{$setting->getSettingSMTPPort()}', `Email` = '{$setting->getSettingEmail()}', `Mailpass` = '{$setting->getSettingEmailPass()}'";

        $logo = $setting->getSettingLogo();
        if(isset($logo) && $setting->getSettingLogo() !== '') {
            $sql .= ", `Logo` = '{$setting->getSettingLogo()}'";
        }

        $sql .= ", `Header` = '{$setting->getSettingHeader()}'";

        if($this->dbQuery($sql)) {
            return true;
        }
        return false;
    }

    /**
     * Haal de rechten van de gebruiker voor de pagina op
     *
     *
     */

    public function getPermission($row, $perm)
    {
        $sql = "SELECT * FROM `permissions` WHERE `permission` = '{$perm}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value){
            return $value[$row];
        }

    }

    /**
     * Haal de rechten van de gebruiker op
     *
     * @param $id
     * @return bool
     */

    public function getPermissionGroup($id)
    {
        $sql = "SELECT `permgroup` FROM `users` WHERE `id` = '{$id}'";

        if($result = $this->dbQuery($sql)){
            return mysqli_fetch_assoc( $result );
        }
    }

    /**
     * Haal user op met het id van die gebruiker
     *
     * @param $id
     * @return array|null
     */

    public function getUserById($id)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = '{$id}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value;
        }
    }

    /**
     * Haal de gebruiker op met behulp van het meegegeven email
     *
     * @param $email
     * @return array|null
     */

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = '{$email}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value;
        }
    }

    public function updateUser($id, $npassword)
    {
        $sql = "UPDATE `users` SET `paswoord` = '{$npassword}' WHERE `id` = '{$id}'";

        if($this->dbQuery($sql)){
            return true;
        }
    }

    /**
     * Haal de laatste id op die in de database toegevoegd wordt
     *
     * @return mixed
     */


    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    /**
     * Haal alle gebruikers op
     *
     * @return array|null
     */

    public function getAllUsers($limit = null, $offset = null)
    {
        $sql = "SELECT * FROM `users`";

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
     * Haal alle gebruikers op die een klant zijn
     *
     * @return array|null
     */

    public function getAllClients(/*$table, $filter, $limit = null, $offset = null, $permgroup*/)
    {
        $sql = "SELECT * FROM `users`";

        $sql .= "WHERE permgroup = '1'";

        /*
        if($permgroup) {
            $sql .= " WHERE permgroup = '{$permgroup}'";
        }
        if($table) {
            $sql .= " ORDER BY $table";
        }
        if($filter) {
            $sql .= " $filter";
        }
        if($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if($offset) {
            $sql .= " OFFSET {$offset}";
        }
        */

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($value){
            return $value;
        }
        return null;
    }

    /**
     * Tel het aantal gebruikers
     *
     * @return bool
     */

    public function countClients()
    {
        $query ="SELECT COUNT(`id`) AS 'total_blocks' FROM `users` WHERE `permgroup` = '1'";

        if($result = $this->dbFetchArray($query)){
            return $result['total_blocks'];
        }
        return false;
    }

    /**
     * Haal alle gebruikers op die geen klanten zijn
     *
     * @return array|null
     */

    public function getAllUsersByPerm(/*$table, $filter, $limit = null, $offset = null, */ $permgroup )
    {
        $sql = "SELECT * FROM `users`";


        if($permgroup) {
            $sql .= " WHERE permgroup != '{$permgroup}'";
        }
        /*
        if($table) {
            $sql .= " ORDER BY $table";
        }
        if($filter) {
            $sql .= " $filter";
        }
        if($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if($offset) {
            $sql .= " OFFSET {$offset}";
        }
        */

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($value){
            return $value;
        }
    }

    /**
     * Haal aantal resultaten van mails op
     *
     * @return mixed
     */

    public function countBlocks()
    {
        $query ="SELECT COUNT(`id`) AS 'total_blocks' FROM `users`";

        if($result = $this->dbFetchArray($query)){
            return $result['total_blocks'];
        }
        return false;
    }

    /**
     * Zoek hele tabel
     *
     * @param $term
     * @return array|null
     */

    public function searchTable($term, $limit, $offset, $table = null, $filter = null, $ids = null)
    {
        $sql = "SELECT * FROM `users` ";

        if($ids) {
            $sql .= "WHERE `permgroup` IN ($ids) AND naam LIKE '%" . $term . "%'";
            $sql .= " OR `permgroup` IN ($ids) AND email LIKE '%" . $term . "%'";
            $sql .= " OR `permgroup` IN ($ids) AND bedrijfsnaam LIKE '%" . $term . "%'";
            $sql .= " OR `permgroup` IN ($ids) AND adres LIKE '%" . $term . "%'";
            $sql .= " OR `permgroup` IN ($ids) AND postcode LIKE '%" . $term . "%'";
            $sql .= " OR `permgroup` IN ($ids) AND plaats LIKE '%" . $term . "%'";
        }
        else {
            $sql .= "WHERE naam LIKE '%" . $term . "%'";
            $sql .= " OR email LIKE '%" . $term . "%'";
            $sql .= " OR bedrijfsnaam LIKE '%" . $term . "%'";
            $sql .= " OR adres LIKE '%" . $term . "%'";
            $sql .= " OR postcode LIKE '%" . $term . "%'";
            $sql .= " OR plaats LIKE '%" . $term . "%'";
        }

        if($table) {
            $sql .= " ORDER BY $table";
        }
        if($filter) {
            $sql .= " $filter";
        }

        if($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if($offset) {
            $sql .= " OFFSET {$offset}";
        }

        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row !== null) {
            return $row;
        }
        return false;
    }

    /**
     * Sla token voor wachtwoord vergeten op
     *
     * @param $mail
     * @param $token
     * @return bool
     */

    public function passForget($mail, $token)
    {
        $date = date('Y-m-d h:i:s', strtotime('+15 minutes'));
        $sql = "UPDATE `users` SET `paswoordvergeten` = '{$token}', `passresetdate` = '{$date}' WHERE `email` = '{$mail}'";

        if($this->dbQuery($sql)) {
            return true;
        }
        return false;
    }

    public function resetPassword($mail, $token, $pass)
    {
        $password = hash('sha256', $pass);
        $sql = "UPDATE `users` SET `paswoord` = '{$password}', `paswoordvergeten` = '' WHERE `email` = '{$mail}' AND `paswoordvergeten` = '{$token}'";

        if($this->dbQuery($sql)) {
            return true;
        }
        return false;
    }

}