<?php
namespace CanGunes74\AnswerQuestion;

use pocketmine\scheduler\Task;
use pocketmine\{Player, Server};
use pocketmine\plugin\Plugin;
use pocketmine\utils\Config;

class MainTask extends Task{

    public $questions;
    private $plugin;

    public function __construct(Plugin $plugin){
        $this->plugin = $plugin;
    }

    public function onRun($tick){
        $question = $this->plugin->getConfig()->get("Sorular");
        $this->questions = $question;
        $answers = $this->plugin->getConfig()->get("Cevaplar");
        $i = rand(0,33);
        $this->plugin->getServer()->broadcastMessage("§8-------------------------------------------------------------\n\n\n§e" . $this->questions[$i] . "\n§aHızlı Olan soruyu bilir.\n\n\n§8-------------------------------------------------------------");
        $this->plugin->answer = $answers[$i];
    }
}
