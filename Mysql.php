<?php

namespace Classes;

use PDO;
use PDOException;

class Mysql
{
    public $connection;

    
    public function __construct(){
        $servername = "localhost";
        $username = "username";
        $password = "P@ssword123";

        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=battle_game", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "資料庫連接失敗: " . $e->getMessage();
        }
    }
}

?>