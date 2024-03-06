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

        parent::__construct(rand(45, 75));

        $this->setImage("https://i1.sndcdn.com/artworks-000149204317-wgy4ge-t500x500.jpg");
    }
}
