<?php

namespace Rpg\Models\Characters\Heroes;

use Rpg\Models\Characters\{Hero, Enemy};

class Priest extends Hero
{
  public function __construct()
  {
    $this->setImage("https://pics.craiyon.com/2023-11-11/zwDZBrtjSuu7Xqh8gKmVkA.webp");
    parent::__construct(200);
  }

  public function throwHealingSpell()
  {
    // TODO: Implement throwHealingSpell() method.
  }

  public function callDeities()
  {
    // TODO: Implement callDeities() method.
  }
}
