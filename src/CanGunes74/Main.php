<?php
namespace CanGunes74;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use pocketmine\event\player\PlayerChatEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\utils\Config;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener{

    public $economy;
    public $answer;

    public function onEnable(): void{
        $this->economy = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->reloadConfig();
        $this->getScheduler()->scheduleRepeatingTask(new MainTask($this), 6000);
    }

    public function onChat(PlayerChatEvent $event): void{
        $player = $event->getPlayer();
        $msg = mb_strtolower($event->getMessage());
        if($msg == $this->answer){
            $event->setCancelled(true);
            $this->answer = NULL;
            $money = rand(1,500)*10;
            EconomyAPI::getInstance()->addMoney($player, $money);
            $this->getServer()->broadcastMessage("§7" . $player->getName() . " §cisimli §7oyuncu soruya doğru cevap vererek §c" . $money . " §3C§fM§7 kazandı.");
        }
    }
}
