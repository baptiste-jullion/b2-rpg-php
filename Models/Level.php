<?php

namespace Rpg\Models;

abstract class Level
{

  public function __construct(private int $level, private int $progressionNeeded)
  {
    
  }
}
