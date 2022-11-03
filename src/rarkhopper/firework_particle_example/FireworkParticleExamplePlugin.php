<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle_example;

use pocketmine\entity\projectile\Egg;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\event\entity\ProjectileHitEntityEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\world\Position;
use rarkhopper\firework_particle\BurstPattern;
use rarkhopper\firework_particle\FireworkColor;
use rarkhopper\firework_particle\FireworkParticle;
use rarkhopper\firework_particle\FireworkType;

class FireworkParticleExamplePlugin extends PluginBase implements Listener{
	protected function onEnable():void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onHit(ProjectileHitBlockEvent $ev):void{
		if(!$ev->getEntity() instanceof Egg) return;
		$pos = Position::fromObject($ev->getRayTraceResult()->getHitVector(), $ev->getEntity()->getWorld());
		$pos->getWorld()->addParticle($pos, new FireworkParticle(
			new BurstPattern(
				FireworkType::randomType(),
				FireworkColor::randomColor()
			)
		));
	}
	
}
