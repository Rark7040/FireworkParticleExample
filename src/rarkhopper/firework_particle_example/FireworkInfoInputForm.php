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
		
		for($i = 1; $i < 7; ++$i){
			if((int) $data[$i] === 0) continue;
			$colors_arr[] = array_values(FireworkColorEnum::getAll())[(int) $data[0]];
		}
		
		if(count($colors_arr) === 0){
			$colors_arr[] = FireworkColorEnum::randomColor();
		}
		$colors = new FireworkColor(...$colors_arr);
		FireworkInfo::getInstance()->set(
			new BurstPattern(
				$type,
				$colors,
				$data[7],
				$data[8]
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
				$this->getTrailToggle() //8
			]
		];
	}
	
	protected function getTypeSelect():array{
		return [
			'type' => 'dropdown',
			'text' => 'type',
			'options' => [
				'SMALL_SPHERE',
				'HUGE_SPHERE',
				'STAR',
				'CREEPER_HEAD',
				'BURST'
			],
			'default' => 0
		];
	}
	
	protected function getColors():array{
		return [
			'type' => 'step_slider',
			'text' => 'color',
			'steps' => [
				'無し',
				'BLACK',
				'RED',
				'DARK_GREEN',
				'BROWN',
				'BLUE',
				'DARK_PURPLE',
				'DARK_AQUA',
				'GRAY',
				'DARK_GRAY',
				'GREEN',
				'YELLOW',
				'LIGHT_AQUA',
				'DARK_PINK',
				'GOLD',
				'WHITE'
			],
			'default' => 0
		];
	}
	
	protected function getFadeColors():array{
		return [
			'type' => 'step_slider',
			'text' => 'fade',
			'steps' => [
				'無し',
				'BLACK',
				'RED',
				'DARK_GREEN',
				'BROWN',
				'BLUE',
				'DARK_PURPLE',
				'DARK_AQUA',
				'GRAY',
				'DARK_GRAY',
				'GREEN',
				'YELLOW',
				'LIGHT_AQUA',
				'DARK_PINK',
				'GOLD',
				'WHITE'
			],
			'default' => 0
		];
	}
	
	protected function getFlickerToggle():array{
		return [
			'type' => 'toggle',
			'text' => 'flicker',
			'default' => false
		];
	}
	
	protected function getTrailToggle():array{
		return [
			'type' => 'toggle',
			'text' => 'flicker',
			'default' => false
		];
	}
}