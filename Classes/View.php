<?php

namespace Classes;

class View
{
    //顯示遊戲主畫面
    public static function showMenu()
    {
        echo "1.開始遊戲\n";
        echo "2.新建角色\n";
        echo "3.查看遊戲紀錄\n";
        echo "4.結束遊戲\n";
        echo "請輸入1/2/3/4 以進行選擇\n";
    }

    //清除遊戲畫面
    public static function clearScreen()
    {
        echo "\033[2J\033[H";
    }

    //顯示怪物基本數值
    public static function displayEnemyAttributes($enemy)
    {
        echo "{$enemy->name} 的屬性：\n";
        echo "生命值：{$enemy->healthPoint}\n";
        echo "物理攻擊力：{$enemy->physicalAttack}\n";
        echo "物理防禦力：{$enemy->physicalDefense}\n";
        echo "魔法防禦力：{$enemy->magicalDefense}\n";
        echo "經驗值：{$enemy->experiencePoint}\n";
    }


    //玩家選擇攻擊方式
    public static function getPlayerAttackmethod()
    {
        while (true) {
            $action = readline("請選擇你的攻擊方式（輸入 '1' 表示物理攻擊，輸入 '2' 表示魔法攻擊）：\n");
            $action = (int)$action;
            self::clearScreen();
            if ($action === 1 || $action === 2) {
                return $action;
            } else {
                echo "無效的選擇！請輸入數字1或2以選擇攻擊方式！\n";
            }
        }
    }


    //開始對戰
    public function battle(Player $player, Enemy $enemy, int $stage)
    {
        self::clearScreen();
        echo"=====================\n";
        echo"       第 {$stage} 關   \n";
        echo"=====================\n";
        self::displayEnemyAttributes($enemy);
        echo"=====================\n";
        readline("點擊 enter 鍵開始對戰...");
        self::clearScreen();

        while ($player->healthPoint > 0 && $enemy->healthPoint > 0) {

            $action = self::getPlayerAttackmethod();
            self::clearScreen();
            if ($action === 1) {
                $player->basicAttack($enemy);
            } elseif ($action === 2) {
                $player->magicalAttack($enemy);
            }

            if ($enemy->healthPoint > 0) {
                $enemy->basicAttack($player);
            }
        }
    }

    //顯示遊戲紀錄
    public static function displayPlayersRecord($playersRecord)
    {
        foreach ($playersRecord as $playerRecord) {
            echo "玩家名稱：{$playerRecord['name']} 通關數：{$playerRecord['stage']} 開始遊戲時間：{$playerRecord['start_time']} 結束遊戲時間：{$playerRecord['end_time']}\n";
        }
        readline("點擊 enter 鍵返回主選單...");
    }
}
