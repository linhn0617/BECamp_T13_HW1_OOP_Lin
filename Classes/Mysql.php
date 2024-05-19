<?php

namespace Classes;

use PDO;
use PDOException;

class Mysql
{
    public $connection;


    public function __construct()
    {
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
    public function getPlayerRecord($name)
    {
        $statement = $this->connection->prepare("SELECT FROM record WHERE name = :name");
        $statement->bindParam(':name', $name);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
