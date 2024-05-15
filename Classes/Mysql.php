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

    //從資料庫中取出已建好的怪物資料
    public function getEnemyData()
    {

    }

    //將玩家遊戲紀錄儲存進資料庫
    public function savePlayerData()
    {

    }

    //從資料庫中取出玩家遊戲紀錄
    public function getPlayerRecord()
    {

    }
}

?>