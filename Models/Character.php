<?php

namespace Rpg\Models;

abstract class Character
{
    protected int $maxHealthPoints;
    protected string $image = "https://i0.wp.com/nigoun.fr/wp-content/uploads/2022/04/placeholder.png?ssl=1";
    private array $actions = [];

    public function __construct(protected int $healthPoints = 100)
    {
        $this->maxHealthPoints = $healthPoints;
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

    public function getHealthPoints(): int
    {
        return $this->healthPoints;
    }

    public function getMaxHealthPoints(): int
    {
        return $this->maxHealthPoints;
    }

    //? Getters

    public function getAction(string $name): Action
    {
        foreach ($this->getActions() as $action) {
            if ($action->getName() === $name) {
                return $action;
            }
        }
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function isDead(): bool
    {
        return !$this->isAlive();
    }

    //? States

    public function isAlive(): bool
    {
        return $this->healthPoints > 0;
    }

    protected function registerActions(array $actions): void
    {
        $this->actions = $actions;
        $this->actions[] = new Action("Level UP", \ACTION_TYPE::LEVEL_UP, 1, $this, 120, "Level UP", 0, \COST_TYPE::EXPERIENCE_POINTS);
    }
}
