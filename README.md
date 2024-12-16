# 對戰遊戲 
![](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) 
![](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

這是一個透過終端機運行的RPG對戰遊戲，透過OOP概念進行設計，一共有10個關卡，玩家可以自行選擇職業以及自由分配能力值與敵人進行對戰，擊敗敵人會獲得經驗值並提升等級強化角色能力。

# 功能
- 支援劍士以及巫師兩種職業類型
- 玩家可以與敵人進行對戰
- 玩家可以查看遊戲紀錄

# 觀念
- OOP
  - Inheritance(繼承)：在 Character.php 中定義基本屬性以及普通攻擊， Player.php 以及 Enemy.php 則是繼承自 Character.php，避免重複的程式碼。
  - Encapsulation(封裝)：將物件的狀態和行為進行包裝，並透過有限的接口操作，避免物件內部的狀態被直接訪問或修改。
- PDO(PHP Data Objects)
  - 透過 PDO 進行資料庫的操作，並透過 prepared statements 以及 bound parameters 以避免 SQL injection。
