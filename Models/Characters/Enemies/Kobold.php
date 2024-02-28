<?php

namespace Rpg\Models\Characters\Enemies;

use Rpg\Models\{Action};
use Rpg\Models\Characters\Enemy;


class Kobold extends Enemy
{
  public function __construct()
  {

    $throwSpell = new Action("Throw Spell", \ACTION_TYPE::ATTACK, 35, $this);
    $healSelf = new Action("Heal", \ACTION_TYPE::HEAL, 8, $this);

    parent::registerActions([$throwSpell, $healSelf]);

    parent::__construct(50);
  }
}
