<?php

namespace Rpg\Models\Characters\Heroes;

use Rpg\Models\Characters\{Hero, Enemy};
use Rpg\Models\Action;

class Warrior extends Hero
{
    public function __construct()
    {
        $this->setImage("https://pics.craiyon.com/2023-10-24/3b5715a5505c43768423365822b94510.webp");
        parent::__construct(140);

        $punch = new Action("Punch", \ACTION_TYPE::ATTACK, 10, $this, 0, "Punches the target");
        $cleave = new Action("Cleave", \ACTION_TYPE::ATTACK, 20, $this, 10, "Slashes multiple enemies in front of the Warrior");
        $heroicStrike = new Action("Heroic Strike", \ACTION_TYPE::ATTACK, 30, $this, 20, "A powerful attack that ignores some of the enemy's defense");

        parent::registerActions([$punch, $cleave, $heroicStrike]);
    }
}
