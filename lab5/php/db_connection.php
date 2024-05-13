<?php

class db_connection {
    private string $host;
    private string $database;
    private string $username;
    private string $password;
    private mysqli $connection;

    private static ?db_connection $instance = null;

    private function __construct() {
        if (self::$instance != null) {
            return;
        }

        $this->host = "127.0.0.1";
        $this->database = "keyboards";
        $this->username = "root";
        $this->password = "";
        
        $this->connection = new mysqli(
            hostname: $this->host,
            username: $this->username,
            password: $this->password,
            database: $this->database
        );

        self::$instance = $this;
    }

    public static function getRaw() : mysqli {
        return self::$instance->connection;
    }

    public function query(string $query) : mysqli_result|bool {
        self::$instance->connection->connect(
            hostname: self::$instance->host,
            username: self::$instance->username,
            password: self::$instance->password,
            database: self::$instance->database
        );

        if (!self::$instance->connection) {
            die;
        }

        $result = self::$instance->connection->query($query);
        
        self::$instance->connection->close();

        return $result;
    }

    public function transaction(array $queries) : array|bool {
        self::$instance->connection->connect(
            hostname: self::$instance->host,
            username: self::$instance->username,
            password: self::$instance->password,
            database: self::$instance->database
        );

        if (!self::$instance->connection) {
            die;
        }

        self::$instance->connection->begin_transaction();

        $results = [];

        foreach($queries as $query) {
            $res = self::$instance->connection->query($query);
            array_push($results, $res);
        }

        $result = self::$instance->connection->commit();

        self::$instance->connection->close();

        return $result == false
            ? false
            : $results;
    }

    public static function get_instance() : db_connection {
        return self::$instance == null
            ? new db_connection()
            : self::$instance;
    }

    public static function escape_string(string $raw) : string {
        return self::$instance->connection->escape_string($raw);
    }
}