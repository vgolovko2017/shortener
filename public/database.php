<?php
	class Database {
		private $connection;
		private static $instance; //The single instance
		private $host = HOST;
		private $username = USERNAME;
		private $password = PASSWORD;
		private $db = DB;

        /*
        Get an instance of the Database
        @return Instance
        */
        public static function getInstance()
        {
            if (!self::$instance) { /* If no instance then make one */
                self::$instance = new self();
            }

            return self::$instance;
        }

		// Constructor
		public function __construct() {
			try {
				$this->connection = new PDO("mysql:dbname=" . $this->db . ";host="
					. $this->host, $this->username, $this->password);

			} catch (PDOException $e) {
				$this->connection = false;
			}
		}

		/* Magic method clone is empty to prevent duplication of connection */
		private function __clone() { }

		/* Get mysqli connection */
		public function getConnection() {
			return $this->connection !== false ? $this->connection : false;
		}
	}
