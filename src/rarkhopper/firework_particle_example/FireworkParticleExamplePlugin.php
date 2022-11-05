<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle_example;

use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\event\Listener;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;

class FireworkParticleExamplePlugin extends PluginBase implements Listener{
	protected function onEnable():void{
		$this->getServer()->getCommandMap()->register($this->getName(), new FireworkSettingCommand('firework_setting'), 'this command can be used to change firework colors and more :)');
		$this->getServer()->getPluginManager()->registerEvents(new EventListener, $this);
		EntityFactory::getInstance()->register(
			FireworkEgg::class,
			function(World $world, CompoundTag $nbt): FireworkEgg{
				return new FireworkEgg(EntityDataHelper::parseLocation($nbt, $world), null, $nbt);
			},
			['FireworkEgg', 'fireworkparticle:FireworkEgg'],
			EntityLegacyIds::EGG
		);
	}
}