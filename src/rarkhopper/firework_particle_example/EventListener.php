<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle_example;

use pocketmine\event\entity\EntityShootBowEvent;
use pocketmine\event\Listener;

class EventListener implements Listener{
	public function onShotBow(EntityShootBowEvent $ev):void{
		$ev->setProjectile(new FireworkEgg($ev->getProjectile()->getLocation(), $ev->getEntity()));
	}
}