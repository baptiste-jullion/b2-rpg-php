<?php

namespace Rpg\Models\Characters\Heroes;

use Rpg\Models\Characters\{Hero, Enemy};
use Rpg\Models\Action;

class Witcher extends Hero
{
  public function __construct()
  {
    $this->setImage("https://pics.craiyon.com/2023-05-23/1f797ed0ced2477ca732063d4d5e1d81.webp");
    parent::__construct(175);

    $punch = new Action("Punch", \ACTION_TYPE::ATTACK, 10, $this, 0, "Punches the target");
    $throwSpell = new Action("Throw Spell", \ACTION_TYPE::ATTACK, 22, $this, 10, "Throws a spell at the target");
    $healSelf = new Action("Heal", \ACTION_TYPE::HEAL, 30, $this, 20, "Heals the caster");
    $bigBoom = new Action("Big Boom", \ACTION_TYPE::ATTACK, 60, $this, 40, "A big explosion that deals a lot of damage", 2);
    $retrieveMana = new Action("Retrieve Mana", \ACTION_TYPE::EARN_MANA, 60, $this, 20, "Retrieves mana points", 3, \COST_TYPE::EXPERIENCE_POINTS);

    parent::registerActions([$punch, $throwSpell, $healSelf, $bigBoom, $retrieveMana]);
  }
}
