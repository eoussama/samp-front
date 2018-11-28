<?php

    /**
     * The news model.
     */
    class News {
        
        /**
         * The connection object.
         */
        private $conn;

        /**
         * The table's name.
         */
        private $table = 'news';

       
        #region Fields

        /**
         * The id of the news article.
         */
        public $id;

        /**
         * The title of the news article.
         */
        public $title;

        /**
         * The body of the news article.
         */
        public $body;

        /**
         * The date of creation of the news article.
         */
        public $created_at;

        #endregion

        #region Constructors

        /**
         * Constuctor with database.
         * 
         * @param $conn: The connection object to pass.
         */
        public function __construct($conn) {
            $this->conn = $conn;

            // Creating the query.
            $query = "CREATE TABLE IF NOT EXISTS `$this->table`(";
            $query  .= "id          VARCHAR(36) PRIMARY KEY,";
            $query  .= "title       VARCHAR(50),";
            $query  .= "body        TEXT,";
            $query  .= "created_at  DATETIME DEFAULT CURRENT_TIMESTAMP";
            $query .= ");";
            
            // Preparing the statement.
            $stmt = $this->conn->prepare($query);

            // Executing the query.
            $stmt->execute();
        }

        #endregion

        #region Public methods

        /**
         * Gets all news articles in the database.
         * 
         * @return $stmt: A list of all news articles.
         */
        public function read_all() {
            // Creating the query.
            $query = "SELECT `id`, `title`, `created_at` FROM $this->table;";
            
            // Preparing the statement.
            $stmt = $this->conn->prepare($query);

            // Executing the query.
            $stmt->execute();

            // Returning the news articles.
            return $stmt;
        }

        /**
         * Get a single news article's information.
         * 
         * @param $id: The id of the news article you want to fetch.
         */
        public function read_single($id) {
            // Creating the query.
            $query = "SELECT * FROM `$this->table` WHERE `id` = ?";

            // Preparing the statement.
            $stmt = $this->conn->prepare($query);

            // Binding the id parameter.
            $stmt->bindParam(1, $this->id);

            // Executing the query.
            $stmt->execute();

            // Fetching the data.
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Setting the properties.
            extract($row);

            $this->id = $id;
            $this->title = $title;
            $this->body = $body;
            $this->created_at = $created_at;
        }

        /**
         * Creats a new news article.
         * 
         * @return Boolean: whether or not the news article was created.
         */
        public function create() {
            // Creating the query.
            $query = "INSERT INTO `$this->table`(`id`, `title`, `body`) VALUES(UUID(), :title, :body);";

            // Preparing the statement.
            $stmt = $this->conn->prepare($query);

            // Sanitizing the data.
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));

            // Binding the data.
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);

            try {
                // Executing the query.
                if($stmt->execute()) {
                    return true;
                }
            }
            catch(PDOException $e){
                throw new Exception($stmt->error);
                return false;
            }
        }

        /**
         * Updates a news article.
         */
        public function update() {
            // Creating the query.
            $query = "UPDATE `$this->table` SET ";
            $query .= "`title` = :title,";
            $query .= "`body` = :body";
            $query .= " WHERE `id` = :id;";

            // Preparing the statement.
            $stmt = $this->conn->prepare($query);

            // Sanitizing the data.
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Binding the data.
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':id', $this->id);

            try {
                // Executing the query.
                if($stmt->execute()) {
                    return true;
                }
            }
            catch(PDOException $e) {
                throw new Exception($stmt->error);
                return false;
            }
        }

        /**
         * Deletes a news article.
         */
        public function delete() {
            // Creating the query.
            $query = "DELETE FROM `$this->table` WHERE `id` = :id";

            // Preparing the statement.
            $stmt = $this->conn->prepare($query);

            // Sanitizing the data.
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Binding the data.
            $stmt->bindParam(':id', $this->id);

            try {
                // Executing the query.
                if($stmt->execute()) {
                    return true;
                }
            }
            catch(PDOException $e) {
                throw new Exception($stmt->error);
                return false;
            }
        }
        
        #endregion
    }