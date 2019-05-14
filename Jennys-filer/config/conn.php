<?php 
    class Database {
        private $host = 'localhost';
        private $db_name = 'tester';
        private $username = 'root';
        private $password = '';
        private $conn;

        //Connection
        public function connection() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8',
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOExpcetion $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
            }
        }

    