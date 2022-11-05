<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle_example;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class FireworkSettingCommand extends Command{
	
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender instanceof Player){
			$sender->sendMessage(TextFormat::RED.'this command is must be executed on the server');
			return;
		}
		$sender->sendForm(new FireworkInfoInputForm);
	}
}