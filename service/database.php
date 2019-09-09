<?php

class Database
{

    // specify your own database credentials
    private $host = "127.0.0.1";
    private $db_name = "Project1";
    private $username = "root";
    private $password = "mysql";
    public $conn;
    public $code = array("success" => 200, "failed" => 503, "bad_request" => 400, "not_found" => 404);

    public function getConnection()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            http_response_code(500);
            echo stripslashes(
                json_encode(
                    array(
                        "status" => "failed",
                        "status_code" => 500,
                        "description" => $exception->getMessage(),
                        "data" => null,
                    )
                    , JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                )
            );
            die();
        }

        return $this->conn;
    }
}

