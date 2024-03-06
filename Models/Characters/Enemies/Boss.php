<?php

namespace Rpg\Models\Characters\Enemies;

use Rpg\Models\{Action};
use Rpg\Models\Characters\Enemy;

class Boss extends Enemy
{
    public function __construct()
    {

        $throwSpell = new Action("Throw Spell", \ACTION_TYPE::ATTACK, rand(500, 750), $this);
        $healSelf = new Action("Heal", \ACTION_TYPE::HEAL, 500, $this);

        parent::registerActions([$throwSpell, $healSelf]);

        parent::__construct(2000);

        $this->setImage("https://static.wikia.nocookie.net/secret-rp/images/3/34/Hydra3.jpg/revision/latest?cb=20140714214659");
    }
}
