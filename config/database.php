<?php
/**
 * Database connection logic
 */

// DB Credentials
define('DB_HOST', 'localhost');           // Change if DB is elsewhere
define('DB_NAME', 'portfolio_db');        // Database name
define('DB_USER', 'root');                // DB username
define('DB_PASS', '');                    // DB password
define('DB_CHARSET', 'utf8mb4');

// Class to handle database connection
class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $charset = DB_CHARSET;
    public $conn;


    // Get PDO connection

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch(PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());

            // Don't show details in production
            if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
                echo "Connection Error: " . $e->getMessage();
            } else {
                echo "Database connection failed. Please try again later.";
            }
        }

        return $this->conn;
    }

    /**
     * Close connection
     */
    public function closeConnection() {
        $this->conn = null;
    }
}

function getDbConnection() {
    $database = new Database();
    return $database->getConnection();
}


// Check if we can connect
function testDbConnection() {
    try {
        $db = getDbConnection();
        if ($db) {
            return true;
        }
    } catch (Exception $e) {
        error_log("Database test failed: " . $e->getMessage());
        return false;
    }
    return false;
}

// Uncomment this to test your DB connection
// if (testDbConnection()) {
//     echo "Database connection successful!";
// } else {
//     echo "Database connection failed!";
// }