<?php

    /**
     * @name:       Samp Front
     * @version:    0.5.0
     * @author:     EOussama (eoussama.github.io)
     * @license     MIT
     * @source:     github.com/EOussama/samp-front
     * 
     * The database's model.
     */
    
    /**
     * The connection class.
     */
    class Database {

        #region Fields

        /**
         * The connection object.
         */
        private $conn;

        /**
         * The hostname.
         */
        private $db_host = '';

        /**
         * The database's name.
         */
        private $db_name = '';

        /**
         * The username.
         */
        private $db_username = '';

        /**
         * The database's password.
         */
        private $db_password = '';

        #endregion

        #region Constructors.

        /**
         * Constructor with database information.
         * 
         * @param string $host: The host's name.
         * @param string $name: The database's name.
         * @param string $user: The username.
         * @param string $pass: The database's password.
         */
        function __construct ($host, $name, $user, $pass) {

            $this->db_host = $host;
            $this->db_name = $name;
            $this->db_username = $user;
            $this->db_password = $pass;
        }

        #endregion

        #region Public methods

        /**
         * The connection methods.
         * 
         * @return PDO
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