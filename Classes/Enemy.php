<?php

namespace Classes;

class Enemy extends Character
{
    public function __construct($stage)
    {
        $this->setNameByStage($stage);
        $this->healthPoint = rand(50, 100);
        $this->physicalAttack = rand(30, 40);
        $this->physicalDefense = rand(10, 20);
        $this->magicalDefense = rand(20, 30);
        $this->setExperiencePointByStage($stage);
    }

    //根據關卡設置敵人名稱
    private function setNameByStage($stage)
    {
        if ($stage < 5) {
            $this->name = 'slime';
        } else {
            $this->name = 'Boss';
        }
    }

    //根據關卡設置敵人經驗值
    private function setExperiencePointByStage($stage)
    {
        if ($stage < 5) {
            $this->experiencePoint = 20;
        } else {
            $this->experiencePoint = 40;
        }
    }
}
