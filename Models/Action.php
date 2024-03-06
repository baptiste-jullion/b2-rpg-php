<?php

namespace Rpg\Models;

use Rpg\Models\Character;
use Rpg\Models\Characters\{Enemy, Hero};

class Action
{

    public function __construct(
        private string       $name,
        private \ACTION_TYPE $type,
        private int          $value = 0,
        private Hero|Enemy   $source,
        private ?int         $cost = 0,
        private ?string      $description = null,
        private ?int         $requiredLevel = 0,
        private ?\COST_TYPE  $costType = \COST_TYPE::MANA
    )
    {
    }

    public function execute(Character $target): void
    {
        if ($this->source instanceof Hero) {
            if ($this->costType === \COST_TYPE::MANA) {
                $this->source->spendMana($this->cost);
                $this->source->earnExperiencePoints(round($this->cost / 2));
            } else if ($this->costType === \COST_TYPE::EXPERIENCE_POINTS) {
                $this->source->spendExperiencePoints($this->cost);
            }
        }

        if ($this->type === \ACTION_TYPE::ATTACK) {
            $target->takeDamage($this->value);
        } else if ($this->type === \ACTION_TYPE::HEAL) {
            $this->source->receiveHeal($this->value);
        } else if ($this->type === \ACTION_TYPE::EARN_MANA) {
            $this->source->earnMana($this->value);
        } else if ($this->type === \ACTION_TYPE::LEVEL_UP) {
            $this->source->levelUP();
        }
    }

    public function hasEnoughMoney(): bool
    {
        if ($this->costType === \COST_TYPE::MANA) {
            return $this->source->getManaPoints() >= $this->cost;
        } else if ($this->costType === \COST_TYPE::EXPERIENCE_POINTS) {
            return $this->source->getExperiencePoints() >= $this->cost;
        }
        return false;
    }

    public function hasRequiredLevel(): bool
    {
        return $this->source->getLevel() >= $this->getRequiredLevel();
    }

    public function getRequiredLevel(): int
    {
        return $this->requiredLevel;
    }

    public function adaptCostAndValue(float $mulpicator): void
    {
        if ($this->getType() !== \ACTION_TYPE::LEVEL_UP) {
            $this->value = round($this->value * $mulpicator);
        }
        $this->cost = round($this->cost * $mulpicator);

    }

    //? Getters

    public function getType(): \ACTION_TYPE
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function getDescription(): ?string
    {
        return $this->description ?: "No description available";
    }

    public function getCostType(): \COST_TYPE
    {
        return $this->costType;
    }
}
