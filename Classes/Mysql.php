<?php

namespace Classes;

use PDO;
use PDOException;

class Mysql
{
    public $connection;


    public function __construct()
    {
        //$servername = "localhost";
        //$username = "username";
        //$password = "P@ssword123";
        $servername = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $database = $_ENV['DB_DATABASE'];

        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "資料庫連接失敗: " . $e->getMessage();
        }
    }

    //將玩家遊戲紀錄儲存進資料庫
    public function savePlayerRecord($name, $stage, $startTime, $endTime)
    {
        $statement = $this->connection->prepare("INSERT INTO record(name,stage,start_time,end_time)VALUES(:name,:stage,:start_time,:end_time)");
        $statement->bindParam(':name', $name);
        $statement->bindParam(':stage', $stage);
        $statement->bindParam(':start_time', $startTime);
        $statement->bindParam(':end_time', $endTime);
        $statement->execute();
    }

    //從資料庫中取出玩家遊戲紀錄
    public function getPlayersRecord()
    {
        $statement = $this->connection->prepare("SELECT * FROM record ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}