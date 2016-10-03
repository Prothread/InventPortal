<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 30-Sep-16
 * Time: 11:39
 */
include_once "../config/db_constants.php";

class Database
{
    /**
     * Variale for creating a connection to the database
     *
     * @access protected
     * @var integer
     */
    protected $connection = null;

    /**
     * Show a query from the database to retrieve information
     *
     * @access private
     * @var array
     */
    private $query_result;

    /**
     * Variable for getting errors
     *
     * @access private
     * @var integer
     */
    private $error = null;

    public function __construct()
    {
        /* Creating a connection to the database*/
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("There was a problem connecting to the database");
    }

    public function dbQuery($query)
    {
        $this->query_result = $this->connection->query($query);

        return $this->query_result;
    }
    public function dbFetchArray($query)
    {
        $result = $this->connection->query($query);

        //TODO: add error check.
        if($data_array = $result->fetch_array(MYSQLI_ASSOC)) {
            if (!$this->connection->errno) {
                $data_array = $this->dbOutArray($data_array);
            }
            return $data_array;
        }


        if ($data_array == FALSE) {
            return FALSE;
        }

    }

}