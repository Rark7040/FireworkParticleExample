<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle_example;

use pocketmine\form\Form;
use pocketmine\player\Player;
use rarkhopper\firework_particle\BurstPattern;
use rarkhopper\firework_particle\FireworkColor;
use rarkhopper\firework_particle\FireworkColorEnum;
use rarkhopper\firework_particle\FireworkTypeEnum;

class FireworkInfoInputForm implements Form{
	public function handleResponse(Player $player, $data): void{
		if($data === null or !is_array($data)) return;
		$type = array_values(FireworkTypeEnum::getAll())[(int) $data[0]];
		$colors_arr = [];
		$fades_arr = [];
		
		for($i = 1; $i < 4; ++$i){
			$colors_arr[] = array_values(FireworkColorEnum::getAll())[(int) $data[$i]];
		}
		
		for($i = 4; $i < 7; ++$i){
			$fades_arr[] = array_values(FireworkColorEnum::getAll())[(int) $data[$i]];
		}
		
		$colors = new FireworkColor(...$colors_arr);
		$fades = new FireworkColor(...$fades_arr);
		FireworkInfo::getInstance()->set(
			new BurstPattern(
				$type,
				$colors,
				$fades,
				$data[7],
				$data[8],
				$data[9]
			)
		);
	}
	
	public function jsonSerialize():array{
		return [
			'type' => 'custom_form',
			'title' => 'INPUT',
			'content' => [
				$this->getTypeSelect(), //0
				$this->getColors(), //1
				$this->getColors(), //2
				$this->getColors(), //3
				$this->getFadeColors(), //4
				$this->getFadeColors(), //5
				$this->getFadeColors(), //6
				$this->getFlickerToggle(), //7
				$this->getTrailToggle(), //8
				$this->getSoundToggle() //9
			]
		];
	}
	
	protected function getTypeSelect():array{
		return [
			'type' => 'dropdown',
			'text' => 'type',
			'options' => array_keys(FireworkTypeEnum::getAll()),
			'default' => 0
		];
	}
	
	protected function getColors():array{
		return [
			'type' => 'step_slider',
			'text' => 'color',
			'steps' => array_keys(FireworkColorEnum::getAll()),
			'default' => 0
		];
	}
	
	protected function getFadeColors():array{
		return [
			'type' => 'step_slider',
			'text' => 'fade',
			'steps' => array_keys(FireworkColorEnum::getAll()),
			'default' => 0
		];
	}
	
	protected function getFlickerToggle():array{
		return [
			'type' => 'toggle',
			'text' => 'flicker',
			'default' => FireworkInfo::getInstance()->get()->isEnabledFlicker()
		];
	}
	
	protected function getTrailToggle():array{
		return [
			'type' => 'toggle',
			'text' => 'trail',
			'default' => FireworkInfo::getInstance()->get()->isEnabledTrail()
		];
	}
	
	protected function getSoundToggle():array{
		return [
			'type' => 'toggle',
			'text' => 'sound',
			'default' => FireworkInfo::getInstance()->get()->isEnabledSound()
		];
	}
}