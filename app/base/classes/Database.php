<?php
class Database {
    
    protected $conn;
    protected $stmt;
    protected $result;

    public function __construct() {
        $url = DB_PROVIDER . ":host=" . DB_SERVERNAME . ";dbname=" . DB_NAME;
        try {
            $this->conn = new PDO($url, DB_USERNAME, DB_PASSWORD, [PDO::ATTR_PERSISTENT => true]);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            die;
        }
    }

    public function executePrepared($query = '', $params = [], $all = false) {
        try {
            $this->stmt = $this->conn->prepare($query);

            $this->stmt->execute($params);
            return $all ? $this->stmt->fetchAll() : $this->stmt->fetch();
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function execute($query, $all = false) {
        $this->result = $this->conn->query($query);
        return $all ? $this->result->fetchAll() : $this->result->fetch();
    }
}