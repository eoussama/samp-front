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

            // Only uncomment this if you want to seed some
            // dummy articles in your database for testing purposes.
            // $this->seed();
        }

        #endregion

        #region Private methods

        /**
         * Seeds the database with dummy data.
         * Used only for testing purposes.
         */
        private function seed() {
            // Creating the query.
            $query = "INSERT INTO `$this->table`(`id`, `title`, `body`) VALUES";
            $query .= "(UUID(), 'Big news!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non est ac augue finibus ultricies quis quis ipsum. Integer accumsan risus sed diam sollicitudin varius. Nam mollis urna vitae dictum consequat. Suspendisse lectus lacus, ultricies sit amet leo eu, tempus gravida dolor. Sed elementum, augue quis bibendum lacinia, mi lorem eleifend felis, a egestas enim lorem nec est. Donec euismod risus mauris, ac pharetra libero condimentum a. Proin porta risus pellentesque nunc scelerisque, a interdum urna imperdiet. Vestibulum fermentum massa sit amet felis maximus, fermentum rutrum magna porta. Etiam eu blandit nibh. Donec sodales sapien sed tellus rutrum, id laoreet augue rhoncus. Nunc purus dolor, volutpat a pretium sed, tincidunt quis arcu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam eu auctor magna, non interdum purus. Morbi quis consequat erat.'),";
            $query .= "(UUID(), 'Something not that interesting.', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc condimentum turpis ut rhoncus interdum. Quisque vel nibh a leo semper elementum. Pellentesque semper aliquam mollis. Ut lorem ex, tempor in tellus non, tincidunt volutpat neque. Nulla blandit dolor sed eros malesuada pulvinar. In ullamcorper bibendum lacus sit amet aliquam. Sed a justo vel lacus eleifend sollicitudin sed id metus. Maecenas sagittis ultricies purus, ut lacinia erat euismod id. Morbi purus neque, mattis ut libero tempor, sollicitudin fermentum enim. Praesent et tortor eu nunc tincidunt volutpat et id nisl. Donec eu ex at justo dictum sollicitudin. Duis euismod tellus quis arcu consectetur, in tincidunt tortor maximus. Aliquam porttitor libero vitae urna pharetra, a porttitor nisi lobortis. Quisque consectetur euismod erat, quis mattis turpis imperdiet commodo. Sed finibus malesuada ipsum, vitae vehicula est feugiat ut.'),";
            $query .= "(UUID(), 'The DDoS attacks are back.', 'Etiam orci elit, egestas eu dui id, ornare mollis sapien. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla sed tortor nibh. Sed euismod in mi et condimentum. Vestibulum id lacinia lacus, ut fringilla metus. In pharetra ac ex ut venenatis. Maecenas gravida ligula eu nunc facilisis egestas at a dolor. In ut ipsum risus. Nunc sit amet rutrum neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus scelerisque semper tellus sit amet varius. Nunc quam eros, porttitor ut consectetur posuere, interdum non ipsum.'),";
            $query .= "(UUID(), 'Free VIP the next month.', 'Vestibulum pharetra orci nec euismod aliquam. Cras pharetra purus neque, eu dignissim nunc ultrices id. Fusce porta elit nunc, ac semper leo tincidunt quis. Morbi at scelerisque nisi, et dignissim sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean tempor condimentum pellentesque. Maecenas cursus nisl ligula, ac sodales turpis sodales eu. Donec blandit molestie lectus ac vehicula. Quisque varius tristique dapibus. Maecenas molestie iaculis nunc, in feugiat nibh volutpat lobortis. Aliquam imperdiet nisl sed massa convallis pellentesque. Fusce laoreet purus ut faucibus tempor. Sed pharetra, mi vel finibus tempus, arcu augue convallis metus, eget ullamcorper metus velit id erat.');";

            // Preparing the statement.
            $stmt = $this->conn->prepare($query);

            // Sanitizing the data.
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));

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

        #endregion

        #region Public methods

        /**
         * Gets all news articles in the database.
         * 
         * @return $stmt: A list of all news articles.
         */
        public function read_all() {
            // Creating the query.
            $query = "SELECT `id`, `title`, DATE_FORMAT(`created_at`, '%D %M, %Y') AS `created_at_formated` FROM $this->table ORDER BY `created_at`;";
            
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
            $query = "SELECT `title`, `body`, `created_at` FROM `$this->table` WHERE `id` = ?";

            // Preparing the statement.
            $stmt = $this->conn->prepare($query);

            // Binding the id parameter.
            $stmt->bindParam(1, $id);

            // Executing the query.
            $stmt->execute();

            // Fetching the data.
            $article = $stmt->fetch(PDO::FETCH_ASSOC);

            // Setting the properties.
            $this->id = $id;
            $this->title = $article['title'];
            $this->body = $article['body'];
            $this->created_at = $article['created_at'];
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