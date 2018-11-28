<?php

    /**
     * The connection class.
     */
    class Database {

        /**
         * The connection object.
         */
        private $conn;

        #region Fields

        /**
         * The hostname.
         */
        private $db_host = 'localhost';

        /**
         * The database's name.
         */
        private $db_name = 'samp_front';

        /**
         * The username.
         */
        private $db_username = 'root';

        /**
         * The database's password.
         */
        private $db_password = '';

        #endregion

        #region Constructors.

        /**
         * Parameterless constructor.
         */
        public function connect() {
            $this->conn = null;

            try { 
                $this->conn = new PDO("mysql: host=$this->db_host; dbname=$this->db_name", $this->db_username, $this->db_password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                throw new Exception('Connection Error: ' . $e->getMessage());
            }

            return $this->conn;
        }

        #endregion
    }