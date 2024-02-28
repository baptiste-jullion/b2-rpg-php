<?php

namespace Rpg\Models;

abstract class Character
{
    protected int $maxHealthPoints;
    private array $actions = [];

    public function __construct(protected int $healthPoints = 100)
    {
        $this->maxHealthPoints = $healthPoints;
    }


    protected function registerActions(array $actions): void
    {
        $this->actions = $actions;
        $this->actions[] = new Action("Level UP", \ACTION_TYPE::LEVEL_UP, 1, $this, 120, "Level UP", 0, \COST_TYPE::EXPERIENCE_POINTS);
    }

    public function takeDamage(int $damage): void
    {
        $this->healthPoints -= $damage;
    }

    public function receiveHeal(int $heal): void
    {
        $this->healthPoints += $heal;
        if ($this->healthPoints > $this->maxHealthPoints) {
            $this->healthPoints = $this->maxHealthPoints;
        }
    }

    //? Getters

    public function getHealthPoints(): int
    {
        return $this->healthPoints;
    }

    public function getMaxHealthPoints(): int
    {
        return $this->maxHealthPoints;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function getAction(string $name): Action
    {
        foreach ($this->getActions() as $action) {
            if ($action->getName() === $name) {
                return $action;
            }
        }
    }

    //? States

    public function isAlive(): bool
    {
        return $this->healthPoints > 0;
    }

    public function isDead(): bool
    {
        return !$this->isAlive();
    }
}
