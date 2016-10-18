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
        $password = md5($user->getPassword());

        $sql = "INSERT INTO users(`name`,`email`,`password`) VALUES('" . $name . "', '" . $email . "', '" . $password . "')";

        if($this->dbQuery($sql)){
            return $this->dbLastInsertedId();
        }
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
        $password = md5($user->getPassword());

        $sql = "SELECT * FROM users WHERE email = '" . $email. "' and password = '" .$password . "'";

        if($result = $this->dbQuery($sql)){
            return $result;
        }
    }

    /**
     * Haal user op met het id van die gebruiker
     *
     * @param $id
     * @return array|null
     */

    public function getUserById($id){
        $sql = "SELECT * FROM `users` WHERE `id` = '{$id}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value;
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

}