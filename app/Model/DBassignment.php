<?php

/**
 * Created by PhpStorm.
 * User: freek
 * Date: 27-3-2017
 * Time: 12:15
 */
class DBassignment extends Database
{
    public function create(Assignment $assignment){
        $sql = "INSERT INTO `assignments` (`subject`, `client`, `user` `endDate`, `description`,`project` ,`status`) VALUES('{$assignment->getSubject()}','{$assignment->getClient()}','{$assignment->getUser()}','{$assignment->getendDate()}','{$assignment->getDescription()}','{$assignment->getProject()}','{$assignment->getstatus()}')";
        if($this->dbQuerry($sql)){
            return $this->dbLastInsertedId();
        }
    }
}