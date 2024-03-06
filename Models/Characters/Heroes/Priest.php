<?php

namespace Rpg\Models\Characters\Heroes;

use Rpg\Models\Characters\{Hero, Enemy};
use Rpg\Models\Action;

class Priest extends Hero
{
  public function __construct()
  {
    $this->setImage("https://pics.craiyon.com/2023-11-11/zwDZBrtjSuu7Xqh8gKmVkA.webp");
    parent::__construct(200);

    $punch = new Action("Punch", \ACTION_TYPE::ATTACK, 10, $this, 0, "Punches the target");
    $healAlly = new Action("Heal Ally", \ACTION_TYPE::HEAL, 25, $this, 15, "Heals a friendly target");
    $groupHeal = new Action("Group Heal", \ACTION_TYPE::HEAL, 40, $this, 30, "Heals all allies for a smaller amount");
    $manaBurn = new Action("Mana Burn", \ACTION_TYPE::ATTACK, 15, $this, 10, "Burns enemy mana and regains some for yourself");
    $holySmite = new Action("Holy Smite", \ACTION_TYPE::ATTACK, 35, $this, 20, "A powerful smite that deals holy damage");

    parent::registerActions([$punch, $healAlly, $groupHeal, $manaBurn, $holySmite]);
  }
}
