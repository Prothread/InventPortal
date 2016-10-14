<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 14-Oct-16
 * Time: 08:35
 */

class User
{
    private $db;

    private $Name;
    private $Email;
    private $Password;

    public function __construct()
    {
        $this->db = new DbUser();
    }

    public function create()
    {
        return $this->db->create($this);
    }

    public function getUser()
    {
        return $this->db->getUser($this);
    }

    public function setName($Name)
    {
        $this->Name = $Name;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function getPassword()
    {
        return $this->Password;
    }

}