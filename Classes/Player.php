<?php

namespace Classes;

use Classes\View;

class Player extends Character
{
    public $career;
    public $magicPoint;
    public $magicalAttack;
    public $luckPoint = 0;
    public $level = 1;
    public $maxHealthPoint;
    public $rivivalFactor;

    //魔法攻擊
    public function magicalAttack(Character $target)
    {
        $damage = $this->magicalAttack - $target->magicalDefense;
        if ($damage < 0) {
            $damage = 0;
        }
        $target->healthPoint -= $damage;
        echo "{$this->name} 對 {$target->name} 造成 {$damage} 點傷害\n";
        //血量不為負數，若血量小於0時設為0
        if ($target->healthPoint < 0) {
            $target->healthPoint = 0;
        }
        echo "{$target->name} 的剩餘 HP：{$target->healthPoint}\n";
    }

    //確認是否已建立玩家角色
    public function ensurePlayerCreated()
    {
        View::clearScreen();
        if (!$this->name) {
            echo "尚未創建角色，請先建立角色以開始遊戲！\n";
            readline("點擊 enter 鍵以建立角色...");
            $this->createNewPlayer();
            return false; // 玩家角色尚未創建
        }
        return true; // 玩家角色已創建
    }


    //建立新玩家角色
    public function createNewPlayer()
    {
        View::clearScreen();
        echo "請輸入名稱：\n";
        $this->name = readline();
        $this->selectCareer();
        $this->setPlayerAttributesByCareer($this->career);
        $this->maxHealthPoint = $this->healthPoint;
        $this->displayPlayerAttributes();
        $this->allocateAttributePoints();
        $this->displayPlayerAttributes();
        readline("點擊enter鍵以返回主選單...");
    }

    //玩家選擇職業
    public function selectCareer()
    {
        $validCareer = false;
        while (!$validCareer) {
            echo "請輸入數字以選擇職業(1.劍士 2.法師): \n";
            $chosenCareer = readline();
            $chosenCareer = (int)$chosenCareer;

            if ($chosenCareer === 1) {
                $this->career = "劍士";
                $validCareer = true;
            } elseif ($chosenCareer === 2) {
                $this->career = "法師";
                $validCareer = true;
            } else {
                echo "請輸入1或2以選擇職業！\n";
            }
        }
    }

    //根據選擇的職業設置玩家基本屬性
    public function setPlayerAttributesByCareer($selectedCareer)
    {
        if ($selectedCareer === "劍士") {
            $this->healthPoint = 100;
            $this->magicPoint = 20;
            $this->physicalAttack = 30;
            $this->magicalAttack = 10;
            $this->physicalDefense = 35;
            $this->magicalDefense = 20;
        } elseif ($selectedCareer === "法師") {
            $this->healthPoint = 90;
            $this->magicPoint = 40;
            $this->physicalAttack = 10;
            $this->magicalAttack = 50;
            $this->physicalDefense = 30;
            $this->magicalDefense = 25;
        }
    }
    //顯示玩家基本屬性
    public function displayPlayerAttributes()
    {
        View::clearScreen();
        echo "   角色屬性    \n";
        echo "===============\n";
        echo "名稱：$this->name\n";
        echo "等級：$this->level\n";
        echo "職業：$this->career\n";
        echo "生命值：$this->healthPoint\n";
        echo "魔力值：$this->magicPoint\n";
        echo "物理攻擊力：$this->physicalAttack\n";
        echo "魔法攻擊力：$this->magicalAttack \n";
        echo "物理防禦力：$this->physicalDefense\n";
        echo "魔法防禦力：$this->magicalDefense\n";
        echo "幸運值：$this->luckPoint\n";
        echo "===============\n";
    }

    //玩家分配10點屬性點
    public function allocateAttributePoints()
    {
        echo "您有10點屬性點可分配\n";
        readline("點擊enter鍵以進行點數分配");
        View::clearScreen();
        $remainingPoints = 10;
        while ($remainingPoints > 0) {
            echo "剩餘點數：$remainingPoints\n";
            echo "請選擇要分配的屬性(1.物理攻擊力 2.魔法攻擊力 3.物理防禦力 4.魔法防禦力 5.幸運值)：\n";
            $chosenAttribute = readline();
            $chosenAttribute = (int)$chosenAttribute;
            if ($chosenAttribute === 1) {
                $this->physicalAttack++;
                $remainingPoints--;
            } elseif ($chosenAttribute === 2) {
                $this->magicalAttack++;
                $remainingPoints--;
            } elseif ($chosenAttribute === 3) {
                $this->physicalDefense++;
                $remainingPoints--;
            } elseif ($chosenAttribute === 4) {
                $this->magicalDefense++;
                $remainingPoints--;
            } elseif ($chosenAttribute === 5) {
                $this->luckPoint++;
                $remainingPoints--;
            } else {
                echo "無效的輸入！請重新選擇！\n";
            }
            View::clearScreen();
        }
    }

    //根據幸運值決定是否滿血復活
    public function isFullHealthPointRivival()
    {
        $this->rivivalFactor = rand(1, 100);
        return $this->luckPoint * 10 > ($this->rivivalFactor);
    }

    //玩家擊敗敵人後獲得經驗值
    public function gainExperience($exp)
    {
        $this->experiencePoint += $exp;
        echo "{$this->name} 獲得了 {$exp} 點經驗值！\n";

        //累計經驗值超過70就升1等
        while ($this->experiencePoint >= 70) {
            $this->levelUp();
            $this->experiencePoint -= 70;
        }
    }

    //升等調整屬性
    private function levelUp()
    {
        $this->level++;
        echo "{$this->name} 升級了！現在等級為 {$this->level}。\n";
        $this->maxHealthPoint += 10;
        $this->restoreHealth();

        $updatedAttributes = [
            '等級' => $this->level,
            '血量' => $this->maxHealthPoint
        ];
        if ($this->career === "劍士") {
            $this->physicalAttack += 5;
            $this->physicalDefense += 5;
            $updatedAttributes['物理攻擊力'] = $this->physicalAttack;
            $updatedAttributes['物理防禦力'] = $this->physicalDefense;
        } else {
            $this->magicalAttack += 5;
            $this->magicalDefense += 5;
            $updatedAttributes['魔法攻擊力'] = $this->magicalAttack;
            $updatedAttributes['魔法防禦力'] = $this->magicalDefense;
        }

        echo "等級提升後屬性變更如下：\n";
        foreach ($updatedAttributes as $key => $value) {
            echo "$key: $value\n";
        }
    }
    //通關後恢復滿血
    public function restoreHealth()
    {
        $this->healthPoint = $this->maxHealthPoint;
    }
}
