<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle_example;

use pocketmine\utils\SingletonTrait;
use rarkhopper\firework_particle\BurstPattern;
use rarkhopper\firework_particle\FireworkColor;
use rarkhopper\firework_particle\FireworkColorEnum;
use rarkhopper\firework_particle\FireworkTypeEnum;

class FireworkInfo{
	use SingletonTrait;
	
	protected BurstPattern $pattern;
	
	public function __construct(){
		$this->pattern = new BurstPattern(FireworkTypeEnum::SMALL_SPHERE(),  new FireworkColor(FireworkColorEnum::WHITE()));
	}
	
	public function set(BurstPattern $pattern):void{
		$this->pattern = $pattern;
	}
	
	public function get():BurstPattern{
		return clone $this->pattern;
	}
}