<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 14-Oct-16
 * Time: 08:37
 */

class DbUser extends Database
{

    public function create(User $user)
    {
        $name = $user->getName();
        $email = $user->getEmail();
        $password = md5($user->getPassword());

        //$sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES( '{$user->getName()}' . '{$user->getEmail()}' . '{$password}'";

        $sql = "INSERT INTO users(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . $password . "')";

        if($this->dbQuery($sql)){
            return $this->dbLastInsertedId();
        }
    }

    public function getUser(User $user)
    {
        $email = $user->getEmail();
        $password = md5($user->getPassword());

        $sql = "SELECT * FROM users WHERE email = '" . $email. "' and password = '" .$password . "'";

        if($result = $this->dbQuery($sql)){
            return $result;
        }
    }

    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

}