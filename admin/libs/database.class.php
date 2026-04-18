<?php

class database {

    /** Put this variable to true if you want ALL queries to be debugged by default:
     */
    var $defaultDebug = false;

    /** INTERNAL: The start time, in miliseconds.
     */
    var $mtStart;

    /** INTERNAL: The number of executed queries.
     */
    var $nbQueries;

    /** INTERNAL: The last result ressource of a query().
     */
    var $lastResult;
    private $session;
    private $con;

    /** Connect to a MySQL database to be able to use the methods below. */
    function __construct() {
        $base = DB_NAME;
        $server = DB_HOST;
        $user = DB_USER;
        $pass = DB_PASS;

        $this->mtStart = $this->getMicroTime();
        $this->nbQueries = 0;
        $this->lastResult = NULL;
        $this->session = new session();
        $this->con = mysqli_connect($server, $user, $pass, $base) or die('Server connection not possible.');
        //mysqli_select_db($this->con, $base) or die('Database connection not possible.');
    }

    /** Query the database.
     * @param $query The query.
     * @param $debug If true, it output the query and the resulting table.
     * @return The result of the query, to use with fetchNextObject().
     */
    function query($query, $debug = -1) {
        $this->nbQueries++;
        $this->lastResult = mysqli_query($this->con, $query) or $this->debugAndDie($query);

        $this->debug($debug, $query, $this->lastResult);

        return $this->lastResult;
    }

    /** Do the same as query() but do not return nor store result.\n
     * Should be used for INSERT, UPDATE, DELETE...
     * @param $query The query.
     * @param $clean Cleaning the query.
     * @param $debug If true, it output the query and the resulting table.
     */
    function execute($query, $clean = false, $debug = false) {
        if ($clean) {
            $this->clean($query);
        }
        //echo '<br>'.$query;
        $this->nbQueries++;
        $result = mysqli_query($this->con, $query) or $this->debugAndDie($query);
        if ($debug)
            $this->debug($debug, $query);
        return $result;
    }

    /** Convenient method for mysql_fetch_object().
     * @param $result The ressource returned by query(). If NULL, the last result returned by query() will be used.
     * @return An object representing a data row.
     */
    function fetchNextObject($result = NULL) {
        if ($result == NULL)
            $result = $this->lastResult;

        if ($result == NULL || mysqli_num_rows($result) < 1)
            return NULL;
        else
            return mysqli_fetch_object($result);
    }

    /** Get the number of rows of a query.
     * @param $result The ressource returned by query(). If NULL, the last result returned by query() will be used.
     * @return The number of rows of the query (0 or more).
     */
    function numRows($result = NULL) {
        if ($result == NULL)
            return mysqli_num_rows($this->lastResult);
        else
            return mysqli_num_rows($result);
    }

    /** Get the result of the query as an object. The query should return a unique row.\n
     * Note: no need to add "LIMIT 1" at the end of your query because
     * the method will add that (for optimisation purpose).
     * @param $query The query.
     * @param $debug If true, it output the query and the resulting row.
     * @return An object representing a data row (or NULL if result is empty).
     */
    function queryUniqueObject($query, $debug = -1) {
        $res = true;
        $query = "$query LIMIT 1";

        $this->nbQueries++;
        $result = mysqli_query($this->con, $query) or ($res = $this->debugAndDie($query));
        if ($res) {
            $this->debug($debug, $query, $result);

            return mysqli_fetch_object($result);
        }
        return false;
    }

    /** Fetch Multiple Objects
     * @param $query The query.
     * @param $debug If true, it output the query and the resulting value.
     * @return Retuns Array of Objects on Success and false on error.
     */
    public function queryMultipleObjects($query, $debug = -1) {
        $res = true;
        $this->nbQueries++;
        $result = mysqli_query($this->con, $query) or ($res = $this->debugAndDie($query));
        if ($res) {
            $i = 0;
            $objs = null;
            do {
                $obj = $this->fetchNextObject($result);
                if ($obj) {
                    $objs[$i++] = $obj;
                }
            } while ($obj != null);
            $this->debug($debug, $query, $result);
            return (($objs[0] != null) ? $objs : false);
        }

        return false;
    }

    /** Get the result of the query as value. The query should return a unique cell.\n
     * Note: no need to add "LIMIT 1" at the end of your query because
     * the method will add that (for optimisation purpose).
     * @param $query The query.
     * @param $debug If true, it output the query and the resulting value.
     * @return A value representing a data cell (or NULL if result is empty).
     */
    function queryUniqueValue($query, $debug = -1) {
        $res = true;
        $query = "$query LIMIT 1";

        $this->nbQueries++;
        $result = mysqli_query($this->con, $query) or ($res = $this->debugAndDie($query));
        if ($res) {
            $line = mysqli_fetch_row($result);

            $this->debug($debug, $query, $result);

            return $line[0];
        }

        return false;
    }

    /** Get the maximum value of a column in a table, with a condition.
     * @param $column The column where to compute the maximum.
     * @param $table The table where to compute the maximum.
     * @param $where The condition before to compute the maximum.
     * @return The maximum value (or NULL if result is empty).
     */
    function maxOf($column, $table, $where) {
        return $this->queryUniqueValue("SELECT MAX(`$column`) FROM `$table` WHERE $where");
    }

    /** Get the maximum value of a column in a table.
     * @param $column The column where to compute the maximum.
     * @param $table The table where to compute the maximum.
     * @return The maximum value (or NULL if result is empty).
     */
    function maxOfAll($column, $table) {
        return $this->queryUniqueValue("SELECT MAX(`$column`) FROM `$table`");
    }

    /** Get the count of rows in a table, with a condition.
     * @param $table The table where to compute the number of rows.
     * @param $where The condition before to compute the number or rows.
     * @return The number of rows (0 or more).
     */
    function countOf($table, $where) {
        return $this->queryUniqueValue("SELECT COUNT(*) FROM `$table` WHERE $where");
    }

    /** Get the count of rows in a table.
     * @param $table The table where to compute the number of rows.
     * @return The number of rows (0 or more).
     */
    function countOfAll($table) {
        return $this->queryUniqueValue("SELECT COUNT(*) FROM `$table`");
    }

    /** Internal function to debug when MySQL encountered an error,
     * even if debug is set to Off.
     * @param $query The SQL query to echo before diying.
     */
    function debugAndDie($query) {
        $this->debugQuery($query, "Error");
        //die("<p style=\"margin: 2px;\">" . mysql_error() . "</p></div>");
        $this->session->setError("feedback_negative", mysqli_error($this->con));
        return false;
    }

    /** Internal function to debug a MySQL query.\n
     * Show the query and output the resulting table if not NULL.
     * @param $debug The parameter passed to query() functions. Can be boolean or -1 (default).
     * @param $query The SQL query to debug.
     * @param $result The resulting table of the query, if available.
     */
    function debug($debug, $query, $result = NULL) {
        if ($debug === -1 && $this->defaultDebug === false)
            return;
        if ($debug === false)
            return;

        $reason = ($debug === -1 ? "Default Debug" : "Debug");
        $this->debugQuery($query, $reason);
        if ($result == NULL)
            echo "<p style=\"margin: 2px;\">Number of affected rows: " . mysqli_affected_rows($this->con) . "</p></div>";
        else
            $this->debugResult($result);
    }

    /** Internal function to output a query for debug purpose.\n
     * Should be followed by a call to debugResult() or an echo of "</div>".
     * @param $query The SQL query to debug.
     * @param $reason The reason why this function is called: "Default Debug", "Debug" or "Error".
     */
    function debugQuery($query, $reason = "Debug") {
//        $color = ($reason == "Error" ? "red" : "orange");
//        echo "<div style=\"border: solid $color 1px; margin: 2px;\">" .
//        "<p style=\"margin: 0 0 2px 0; padding: 0; background-color: #DDF;\">" .
//        "<strong style=\"padding: 0 3px; background-color: $color; color: white;\">$reason:</strong> " .
//        "<span style=\"font-family: monospace;\">" . htmlentities($query) . "</span></p>";
    }

    /** Internal function to output a table representing the result of a query, for debug purpose.\n
     * Should be preceded by a call to debugQuery().
     * @param $result The resulting table of the query.
     */
    function debugResult($result) {
        echo "<table border=\"1\" style=\"margin: 2px;\">" .
        "<thead style=\"font-size: 80%\">";
        $numFields = mysqli_num_fields($result);
        // BEGIN HEADER
        $tables = array();
        $nbTables = -1;
        $lastTable = "";
        $fields = array();
        $nbFields = -1;
        while ($column = mysqli_fetch_field($result)) {
            if ($column->table != $lastTable) {
                $nbTables++;
                $tables[$nbTables] = array("name" => $column->table, "count" => 1);
            }
            else
                $tables[$nbTables]["count"]++;
            $lastTable = $column->table;
            $nbFields++;
            $fields[$nbFields] = $column->name;
        }
        for ($i = 0; $i <= $nbTables; $i++)
            echo "<th colspan=" . $tables[$i]["count"] . ">" . $tables[$i]["name"] . "</th>";
        echo "</thead>";
        echo "<thead style=\"font-size: 80%\">";
        for ($i = 0; $i <= $nbFields; $i++)
            echo "<th>" . $fields[$i] . "</th>";
        echo "</thead>";
        // END HEADER
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            for ($i = 0; $i < $numFields; $i++)
                echo "<td>" . htmlentities($row[$i]) . "</td>";
            echo "</tr>";
        }
        echo "</table></div>";
        $this->resetFetch($result);
    }

    /** Get how many time the script took from the begin of this object.
     * @return The script execution time in seconds since the
     * creation of this object.
     */
    function getExecTime() {
        return round(($this->getMicroTime() - $this->mtStart) * 1000) / 1000;
    }

    /** Get the number of queries executed from the begin of this object.
     * @return The number of queries executed on the database server since the
     * creation of this object.
     */
    function getQueriesCount() {
        return $this->nbQueries;
    }

    /** Go back to the first element of the result line.
     * @param $result The resssource returned by a query() function.
     */
    function resetFetch($result) {
        if (mysqli_num_rows($result) > 0)
            mysqli_data_seek($result, 0);
    }

    /** Get the id of the very last inserted row.
     * @return The id of the very last inserted row (in any table).
     */
    function lastInsertedId() {
        return mysqli_insert_id($this->con);
    }

    /** Close the connexion with the database server.\n
     * It's usually unneeded since PHP do it automatically at script end.
     */
    function close() {
        mysqli_close($this->con);
    }

    /** Internal method to get the current time.
     * @return The current time in seconds with microseconds (in float format).
     */
    function getMicroTime() {
        list($msec, $sec) = explode(' ', microtime());
        return floor($sec / 1000) + $msec;
    }

    function array2str($array, $quotes = 0) {
        $data = "";
        foreach ($array as $str) {
            $data .= ( $quotes == 1 ? "'" : "") . htmlspecialchars($str, ENT_QUOTES) . ($quotes == 1 ? "'" : "") . ',';
        }
        return substr($data, 0, -1);
    }

    function arraykey2str($array, $quotes = 0) {
        $data = "";
        foreach ($array as $k => $str) {
            $data .= ( $quotes == 1 ? "'" : "") . $k . ($quotes == 1 ? "'" : "") . ',';
        }
        return substr($data, 0, -1);
    }

    function array2Update($array) {
        $data = "";
        foreach ($array as $key => $str) {
            $data .= "`" . $key . "`" . " = '" . htmlspecialchars($str, ENT_QUOTES) . "', ";
        }
        return substr($data, 0, -2);
    }

    function clean($dirty) {
        // if (get_magic_quotes_gpc()) {
        //     $clean = mysql_real_escape_string(stripslashes($dirty));
        // }
        // else{
        $clean = mysqli_real_escape_string($dirty);
        //}
        return $clean;
    }

}

// class DB
?>
