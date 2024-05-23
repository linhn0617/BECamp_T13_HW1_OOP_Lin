<?php
require 'vendor/autoload.php';


use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Classes\Mysql;
use Classes\Character;
use Classes\Player;
use Classes\Enemy;
use Classes\View;

$mysql = new Mysql();
$player = new Player();
$view = new View();


while (true) {
    View::clearScreen();
    View::showMenu();
    $choice = (int)readline();

    if ($choice === 1) {
        //確認角色是否已建立
        if (!$player->ensurePlayerCreated()) {
            continue;
        }
        $startTime = date('Y-m-d H:i:s');
        $stage = 1;

        while ($stage <= 5) {
            View::clearScreen();
            $enemy = new Enemy($stage);
            $view->battle($player, $enemy, $stage);

            if ($player->healthPoint > 0) {
                echo "恭喜過關！\n";
                $player->gainExperience($enemy->experiencePoint);
                $player->restoreHealth();
                if ($stage == 5) {
                    $endTime = date('Y-m-d H:i:s');
                    $mysql->savePlayerRecord($player->name, $stage, $startTime, $endTime);
                    echo "恭喜通過全部關卡！\n";
                    readline("點擊 enter 鍵返回主選單...");
                    break;
                } else {
                    $stage++;
                    readline("點擊 enter 鍵進入下一關...");
                }
            } else {
                $endTime = date('Y-m-d H:i:s');
                $mysql->savePlayerRecord($player->name, $stage, $startTime, $endTime);
                echo "很遺憾，你被第 {$stage} 關的敵人打敗了...\n";
                readline("點擊 enter 鍵返回主選單...");
                break;
            }
        }
    } elseif ($choice === 2) {
        $player->createNewPlayer();
    } elseif ($choice === 3) {
        View::clearScreen();
        $playersRecord = $mysql->getPlayersRecord();
        View::displayPlayersRecord($playersRecord);
    } elseif ($choice === 4) {
        exit;
    } else {
        echo "請輸入1/2/3以進行選擇!\n";
        sleep(2);
        View::clearScreen();
        continue;
    }
}
