<?php

namespace TestPlugin;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

class main extends PluginBase implements Listener {

	public function onEnable(){

	}

	public function onCommand(CommandSender $sender, Command $cmd, String $Label, Array $args) : bool {

		switch ($cmd->getName()){
			case "bc":
			 if($sender->hasPermission("bc.use")){
			 	if($sender instanceof Player){
			 		$this->bc($sender);
			 	}
			 } else {
			 	$sender->sendMessage("§cYou don't have permission to use this command");
			 }
		}
	return true;
	}

	public function bc($Player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			if($data[0] == null){
				$player->sendMessage("§bYou need to type a message!");
				return true;
			}
			if($data[1] == true){
				$this->getServer()->brodcastMessage("§7[§bServer§7] §a$data[0]");
				return true;
			}
			if($data[2] == true){
				$this->getServer()->brodcastMessage("§7[§bServer§7] §c$data[0]");
				return true;
			}
			if($data[3] == true){
				$this->getServer()->brodcastMessage("§7[§bServer§7] §e$data[0]");
				return true;
			}
			$this->getServer()->brodcastMessage("§7[§bServer§7] $data[0]");
		});
		$form->setTitle("§6Brodcast §aUI");
		$form->addInput("§a>> §bType a message you want to send to all players!");
		$form->addToggle("§aGreen", false);
		$form->addToggle("§cRed", false);
		$form->addToggle("§eYellow", false);
		$form->sendToPlayer($players);
		return $form;
	}
}
