<?php

namespace Rpg\Models\Characters;

use Rpg\Models\{Character, Action};

abstract class Hero extends Character
{
    private int $experiencePoints = 0;
    private int $manaPoints = 100;
    private int $level = 1;
    private string $image = "https://i0.wp.com/nigoun.fr/wp-content/uploads/2022/04/placeholder.png?ssl=1";

    public function spendMana(int $amount): void
    {
        $this->manaPoints -= $amount;
    }

    public function earnMana(int $amount): void
    {
        $this->manaPoints += $amount;
    }

    public function spendExperiencePoints(int $amount): void
    {
        $this->experiencePoints -= $amount;
    }

    public function earnExperiencePoints(int $amount): void
    {
        $this->experiencePoints += $amount;
    }

    //? Setters

    public function setMaxHealthPoints(int $maxHealthPoints): void
    {
        $this->maxHealthPoints = $maxHealthPoints;
    }

    public function setExperiencePoints(int $experiencePoints): void
    {
        $this->experiencePoints = $experiencePoints;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    //? Getters

    public function getExperiencePoints(): int
    {
        return $this->experiencePoints;
    }

    public function getManaPoints(): int
    {
        return $this->manaPoints;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
