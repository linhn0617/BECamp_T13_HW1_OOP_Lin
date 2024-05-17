<?php

namespace Classes;

class Character
{
    public $name;
    public $healthPoint;
    public $physicalAttack;
    public $physicalDefense;
    public $magicalDefense;
    public $experiencePoint;

    public function physicalAttack($attacker, $target)
    {
        $damage = $attacker->physicalAttack - $target->physicalDefense;
        if ($damage < 0) {
            $damage = 0;
        }
        $target->healthPoint -= $damage;
        echo "{$attacker->name} 對 {$target->name} 造成 {$damage} 點傷害\n";
        //血量不為負數，若血量小於0時設為0
        if ($target->healthPoint < 0) {
            $target->healthPoint = 0;
        }
        echo "{$target->name} 的剩餘 HP：{$target->healthPoint}\n";
    }
}
