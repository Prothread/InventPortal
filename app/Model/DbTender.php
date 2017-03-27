<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 24-3-2017
 * Time: 09:01
 */
class DbTender extends Database
{
    public function create(Tender $tender)
    {
        $sql = "INSERT INTO `tenders` (`onderwerp`, `klant`, `werknemer`,  `geldigheidsduur`, `waarde`, `kans`, `aanmaakdatum`, `beschrijving`) VALUES('{$tender->getSubject()}', '{$tender->getClient()}', '{$tender->getUser()}', '{$tender->getValidity()}', '{$tender->getValue()}', '{$tender->getChance()}', '{$tender->getCreationDate()}', '{$tender->getDescription()}')";


        if ($this->dbQuery($sql)) {
            return $this->dbLastInsertedId();
        }
    }

//    public function update(Tender $tender)
//    {
//        $sql = "UPDATE `users` SET ";
//
//        if ($user->getName()) {
//            $sql .= "`naam` = '{$user->getName()}'";
//        }
//
//        if ($user->getEmail()) {
//            $sql .= ", `email` = '{$user->getEmail()}'";
//        }
//
//        if ($user->getCompanyName()) {
//            $sql .= ", `bedrijfsnaam` = '{$user->getCompanyName()}'";
//        }
//
//        if ($user->getPermGroup()) {
//            $sql .= ", `permgroup` = '{$user->getPermGroup()}'";
//        }
//
//        if ($user->getUserPostcode()) {
//            $sql .= ", `postcode` = '{$user->getUserPostcode()}'";
//        }
//
//        if ($user->getUserPlace()) {
//            $sql .= ", `plaats` = '{$user->getUserPlace()}'";
//        }
//
//        if ($user->getUserAdres()) {
//            $sql .= ", `adres` = '{$user->getUserAdres()}'";
//        }
//
//        if ($user->getUserLanguage()) {
//            $sql .= ", `lang` = '{$user->getUserLanguage()}'";
//        }
//
//        if ($user->getPassword()) {
//            $password = hash('sha256', $user->getPassword());
//            $sql .= ", `paswoord` = '{$password}' ";
//        }
//
//        if ($user->getAltMail()) {
//            $sql .= ", `altmail` = '{$user->getAltmail()}'";
//        }
//
//        if ($user->getProfileImage()) {
//            $sql .= ", `profimg` = '{$user->getProfileImage()}'";
//        }
//
//        if ($user->getUserActive() !== null) {
//            $sql .= ", `active` = '{$user->getUserActive()}'";
//        }
//
//        $sql .= " WHERE `id` = '{$user->getUserId()}'";
//
//        if ($this->dbQuery($sql)) {
//            return true;
//        }
//        return false;
//    }
//
//    public function delete($id)
//    {
//        $sql = "DELETE FROM `users` WHERE `id` = '{$id}'";
//
//        if ($result = $this->dbQuery($sql)) {
//            return true;
//        }
//        return false;
//    }
//
//    public function getTender(Tender $tender)
//    {
//        $email = $tender->getEmail();
//        $password = hash('sha256', $tender->getPassword());
//
//        $sql = "SELECT * FROM users WHERE email = '" . $email . "' and paswoord = '" . $password . "'";
//
//        if ($result = $this->dbQuery($sql)) {
//            return $result;
//        }
//    }
    public function dbLastInsertedId()
    {
        return $this->connection->insert_id;
    }

    public function getLastTenderId(){
        $sql = "SELECT `id` FROM `tenders` ORDER BY `id` DESC LIMIT 1";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if ($value) {
            return $value;
        }
    }

    public function getAllTenders(){
        $sql = "SELECT * FROM `tenders`";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($value) {
            return $value;
        }
    }

    public function getTenderById($id){
        $sql = "SELECT * FROM `tenders` WHERE `id` = {$id}";

        $result = $this->dbQuery($sql);
        $endResult = mysqli_fetch_assoc($result);
        if($endResult){
            return $endResult;
        }
    }
}