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

        $sql = "INSERT INTO `users` (`naam`, `email`, `paswoord`, `permgroup`, `bedrijfsnaam`, `adres`, `postcode`, `plaats`) VALUES('" . $name . "', '" . $email . "', '" . $password . "', '{$user->getPermGroup()}',
        '{$user->getCompanyName()}', '{$user->getUserAdres()}', '{$user->getUserPostcode()}', '{$user->getUserPlace()}')";

        if($this->dbQuery($sql)){
            return $this->dbLastInsertedId();
        }

    }



    public function update(User $user)
    {
        $password = hash('sha256', $user->getPassword());

        $sql = "UPDATE `users` SET `naam` = '{$user->getName()}', `email` = '{$user->getEmail()}', `paswoord` = '{$password}', `bedrijfsnaam` = '{$user->getCompanyName()}', `permgroup` = '{$user->getPermGroup()}',
        `adres` = '{$user->getUserAdres()}', `postcode` = '{$user->getUserPostcode()}', `plaats` = '{$user->getUserPlace()}' WHERE `id` = '{$user->getUserId()}'";

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
     * Haal de rechten van de gebruiker voor de pagina op
     *
     *
     */

    public function getPermission($row, $perm)
    {
        $sql = "SELECT `{$row}` FROM `permissions` WHERE `permission` = '{$perm}'";

        /*if($result = $this->dbQuery($sql)) {
            return mysqli_fetch_assoc($result);
        }*/

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
        $sql = "UPDATE `users` SET `password` = '{$npassword}' WHERE `id` = '{$id}'";

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
     * Haal alle gebruikers op
     *
     * @return array|null
     */

    public function getAllClients($limit = null, $offset = null, $permgroup)
    {
        $sql = "SELECT * FROM `users` WHERE `permgroup` = '{$permgroup}'";

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

    public function searchTable($term, $limit, $offset, $table = null, $filter = null, $ids = null, $status)
    {
        $sql = "SELECT * FROM mail ";

        if($ids) {
            if($status) {
                $sql .= "WHERE `id` IN ($ids) AND onderwerp LIKE '%" . $term . "%' AND verified = '". $status ."'";
                $sql .= " OR `id` IN ($ids) AND verstuurder LIKE '%" . $term . "%' AND verified = '". $status ."'";
                $sql .= " OR `id` IN ($ids) AND naam LIKE '%" . $term . "%' AND verified = '". $status ."'";
                $sql .= " OR `id` IN ($ids) AND datum LIKE '%" . $term . "%' AND verified = '". $status ."'";
            }
            else {
                $sql .= "WHERE `id` IN ($ids) AND onderwerp LIKE '%" . $term . "%' ";
                $sql .= " OR `id` IN ($ids) AND verstuurder LIKE '%" . $term . "%'";
                $sql .= " OR `id` IN ($ids) AND naam LIKE '%" . $term . "%'";
                $sql .= " OR `id` IN ($ids) AND datum LIKE '%" . $term . "%'";
            }
        }
        else {
            if($status) {
                $sql .= " WHERE onderwerp LIKE '%".$term."%' AND verified = '". $status ."'";
                $sql .= " OR verstuurder LIKE '%".$term."%' AND verified = '". $status ."'";
                $sql .= " OR naam LIKE '%".$term."%' AND verified = '". $status ."'";
                $sql .= " OR datum LIKE '%".$term."%' AND verified = '". $status ."'";
            }
            else {
                $sql .= " WHERE onderwerp LIKE '%" . $term . "%' OR verstuurder LIKE '%" . $term . "%' OR naam LIKE '%" . $term . "%' OR datum LIKE '%" . $term . "%'";
            }
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

}