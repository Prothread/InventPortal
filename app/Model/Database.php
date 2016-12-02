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

    /**
     * Korte beschrijving van de method dbQuery
     *
     * @access protected
     * @author firstname and lastname of author, <author@example.org>
     * @param  query
     * @return mixed
     */

    public function dbQuery($query)
    {
        $this->query_result = $this->connection->query($query);

        return $this->query_result;
    }

    /**
     * Short description of method dbFetchArray
     *
     * @access protected
     * @author firstname and lastname of author, <author@example.org>
     * @param  query
     * @return mixed
     */

    public function dbFetchArray($query)
    {
        $result = $this->connection->query($query);

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

    /**
     * Korte beschrijving van method dbOutArray
     *
     * @access protected
     * @author firstname and lastname of author, <author@example.org>
     * @param  data_array
     * @return mixed
     */

    protected function dbOutArray($data_array)
    {
        // section 10-0-3-49--6022aa35:14bdfb8146c:-8000:000000000000088E begin


        foreach ($data_array as $field => $value) {
            if (is_numeric($value)) {
                continue;
            }
            else if (is_string($value)) {
                $data_array[$field] = $this->dbOutString($value);
            }
        }
        return $data_array;
        // section 10-0-3-49--6022aa35:14bdfb8146c:-8000:000000000000088E end
    }

    /**
     * Korte beschijving van de method dbOutString
     *
     * @access protected
     * @author firstname and lastname of author, <author@example.org>
     * @param  string
     * @return mixed
     */
    protected function dbOutString($string)
    {
        // section 10-0-3-49--6022aa35:14bdfb8146c:-8000:0000000000000890 begin
        if (is_string($string)) {
            return trim(stripslashes($string));
        }
        // section 10-0-3-49--6022aa35:14bdfb8146c:-8000:0000000000000890 end
    }

}