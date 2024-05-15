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

    //開始遊戲
    public function startGame()
    {

    }


}