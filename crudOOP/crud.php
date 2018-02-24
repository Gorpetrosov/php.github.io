<?php

class crud
{

    private $username = "root";
    private $password = "";
    private $host = "localhost";
    private $dbname = "crud";
    private static $conn = null;

    public function __construct($host, $dbname, $username, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        try {
            self::$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connected to Database<br/>';

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return self::$conn;
    }


    public function create($crud_table = "", array $crud_table_rows = [], array $crud_table_args = [])
    {
        try {
            if (!empty($crud_table) && !empty($crud_table_rows) && (is_array($crud_table_rows))) {
                $request = "INSERT INTO $crud_table (";
                foreach ($crud_table_rows as $rows) {
                    $request .= $rows . ",";
                }
            } else {
                return false;
            }
            $request = mb_substr($request, 0, -1); //delete last symbols
            $request .= ") VALUES (";
            if ((!empty($crud_table_args) && (is_array($crud_table_args)) && (count($crud_table_args) <= count($crud_table_rows)))) {
                foreach ($crud_table_args as $arg) {
                    $request .= (is_numeric($arg)) ? $arg . "," : "'" . $arg . "'" . ",";
                }
                $request = mb_substr($request, 0, -1);
                $request .= ')';
            } else {
                return false;
            }

            self::$conn->exec($request);
        } catch (PDOException $e) {
            return $request . "<br>" . $e->getMessage();
        }

//        self::deconn();
        return "New record created successfully";
    }


    public function read($crud_table = "", array $read_args = [])
        /**
         * anavart ==arjeqy chi veradarcnum
         */
    {
        try {
            if (!empty($crud_table) && (!empty($read_args))) {
                $query_text = "SELECT ";
                foreach ($read_args as $args) {
                    $query_text .= $args . ",";
                }
            }
            $query_text = mb_substr($query_text, 0, -1);
            $query_text .= " FROM " . $crud_table;

            $request = self::$conn->prepare($query_text);

            $request->execute();
            $result = $request;
//            $result = $request->setFetchMode(PDO::FETCH_ASSOC);


        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }

//        self::deconn();
        return $result;
    }

    public function update($crud_table = "", array $table_new_value = [], array $row_old_val = [])
    {
        /**
         * UPDATE news SET (title = sport) where id = 5;
         */
        try {
            if (!empty($crud_table) && (count($table_new_value) === 1) && count($row_old_val) === 1) {
                $request = "UPDATE $crud_table SET ";
                foreach ($table_new_value as $row => $new_val) {
//                    $request .= $row . "=" . (is_numeric($new_val)) ? $new_val : "'" . $new_val . "'";
                    $request .= $row .'="'. $new_val . '"';
                }
                $request .= " WHERE ";
                foreach ($row_old_val as $row_updated => $old_val) {
//                    $request .= $row_updated . "=".(is_numeric($old_val)) ? $old_val : "'" . $old_val . "'";
                    $request .= $row_updated .'='. $old_val;
                }

            } else {
                return false;
            }
            $result = self::$conn->prepare($request);//to ready the query
//            die($request);
            $result->execute();//execute query

        } catch (PDOException $e) {
            return "ERROR" . "<br>" . $e->getMessage();
        }
//        self::deconn();
        return $result->rowCount() . "Updated Successfully";
    }

    public function delete($crud_table = "", $table_row = "", array $del_args = [])
    {
        try {
            if (!empty($crud_table) && is_array($del_args) && (!empty($table_row))) {
                $request = "DELETE FROM $crud_table WHERE $table_row=";
                foreach ($del_args as $row) {
                    $request .= (is_numeric($row)) ? $row . "," : "'" . $row . "'" . ",";
                }
            }
            $request = mb_substr($request, 0, -1);
            $request .= '"' . $request . '"';
            self::$conn->exec($request);


        } catch (PDOException $e) {
            return "ERROR" . "<br>" . $e->getMessage();
        }
        self::deconn();
        return "Your delete was successfully done";
    }


    function __destruct()
    {
        return (self::$conn = null);
    }
}