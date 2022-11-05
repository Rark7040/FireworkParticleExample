<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle_example;

use pocketmine\entity\projectile\Egg;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\world\Position;
use rarkhopper\firework_particle\FireworkParticle;

class FireworkEgg extends Egg{
	protected function onHit(ProjectileHitEvent $event):void{
		$pos = Position::fromObject($event->getRayTraceResult()->getHitVector(), $event->getEntity()->getWorld());
		$pos->getWorld()->addParticle($pos, new FireworkParticle(FireworkInfo::getInstance()->get()));
	}
}