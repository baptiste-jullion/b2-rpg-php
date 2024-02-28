<?php

namespace Rpg\Models\Characters;

use Rpg\Models\Character;

abstract class Enemy extends Character
{
    private string $name;

    public function __construct(int $health)
    {
        $this->name = ENEMIES_NAMES[array_rand(ENEMIES_NAMES)];
        parent::__construct($health);
    }

    //? Getters

    public function getName(): string
    {
        return $this->name;
    }


    public function getType(): string
    {
        return end(explode("\\", get_called_class()));
    }
}
