<?php

namespace Rpg\Models;

use Rpg\Models\Characters\Heroes\{Warrior, Witcher, Priest};

class Player
{
  private $heroCharacter;

  public function __construct(private string $name, private string $heroClassName)
  {
    $heroClass = HEROES[$heroClassName]["class"];
    $this->heroCharacter = new $heroClass();
  }

  //? Getters

  public function getName(): string
  {
    return $this->name;
  }

  public function getHeroCharacter()
  {
    return $this->heroCharacter;
  }

  public function getHeroClassName(): string
  {
    return $this->heroClassName;
  }
}
