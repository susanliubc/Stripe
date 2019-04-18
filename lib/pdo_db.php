<?php
/* PDO database connection:
connect to database,
use PDO, 
create prepared statement, 
bin params to values
return rows and results
*/

    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh;
        private $error;
        private $stmt;

        public function __construct() {
            //set DSN
            $dsn = 'mysql:host='.$this->host.':dbname='.$this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRORMODE => PDO::ATTR_ERRORMODE_EXCEPTION
            );

            //create a new PDO instance 
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            } //catch any errors
            catch (PDOException $e) {
                $this->error = $e->getMessage();
            }
        }

        //prepare statement with query
        public function query($query) {
            $this->stmt = $this->dbh->prepare($query);
        }

        //bind values
        public function bind($param, $value, $type=null) {
            if(is_null($type)) {
                switch(true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }

        //execute the prepared statement
        public function execute() {
            return $this->stmt->execute();
        }

        //get result set as array of objects
        public function resultset() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //get single result as object
        public function aingle() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //get record row count
        public function rowCount() {
            $this->execute();
            return $this->stmt->rowCount();
        }

        //return the last inserted ID
        public function lastInsertId() {
            $this->execute();
            return $this->dbh->lastInsertId();
        }
    }
?>