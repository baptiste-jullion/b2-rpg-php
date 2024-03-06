<?php

namespace Rpg\Models\Characters;

use Rpg\Models\{Character, Action};

abstract class Hero extends Character
{
    private int $experiencePoints = 0;
    private int $manaPoints = 100;
    private int $level = 1;

    public function resetHP(): void
    {
        $this->healthPoints = $this->maxHealthPoints;
    }

    public function levelUP(): void
    {
        $this->level++;
        $mulpicator = 1.333 + $this->level / 1.4;
        $this->maxHealthPoints = round($this->maxHealthPoints * $mulpicator);
        foreach ($this->getActions() as $action) {
            $action->adaptCostAndValue($mulpicator);
        }
    }

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

    public function getExperiencePoints(): int
    {
        return $this->experiencePoints;
    }

    public function setExperiencePoints(int $experiencePoints): void
    {
        $this->experiencePoints = $experiencePoints;
    }

    //? Getters

    public function getManaPoints(): int
    {
        return $this->manaPoints;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

}
