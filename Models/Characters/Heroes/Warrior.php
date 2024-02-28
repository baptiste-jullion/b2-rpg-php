<?php

namespace Rpg\Models\Characters\Heroes;

use Rpg\Models\Characters\{Hero, Enemy};

class Warrior extends Hero
{
  public function __construct()
  {
    $this->setImage("https://pics.craiyon.com/2023-10-24/3b5715a5505c43768423365822b94510.webp");
    parent::__construct(140);
  }

  public function emitShout(?Enemy $target): string
  {
    return "I'm shouting!";
  }
}
