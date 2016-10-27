<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 05-Oct-16
 * Time: 11:39
 */

class DbBlock extends Database
{

    /**
     * Haal ale uploads op
     *
     * @return array|null
     */

    public function getUploads($table, $filter, $limit = null, $offset = null){
        $sql = "SELECT * FROM `mail`";

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
        var_dump($sql);

        $result = $this->dbQuery($sql);

        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row) {
            return $row;
        }
    }

    /**
     * Haal de laatste 3 uploads op
     *
     * @return array|null
     */

    public function getLastSixUploads() {
        $sql = "SELECT * FROM `mail` ORDER BY `id` DESC LIMIT 6";

        $result = $this->dbQuery($sql);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($row) {
            return $row;
        }
    }

    /**
     * Haal een upload op met het id dat je meegeeft
     *
     * @param $id
     * @return array|null
     */

    public function getUploadById($id){
        $sql = "SELECT * FROM `mail` WHERE `id` = '{$id}'";

        $result = $this->dbQuery($sql);
        $value = mysqli_fetch_assoc($result);

        if($value) {
            return $value;
        }
    }

    /**
     * Haal het aantal mails op
     *
     * @return mixed
     */

    public function countBlocks()
    {
        $query ="SELECT COUNT(`id`) AS 'total_blocks' FROM `mail`";

        if($result = $this->dbFetchArray($query)){
            return $result['total_blocks'];
        }
        return false;
    }

}