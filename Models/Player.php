<?php

namespace Rpg\Models;

class Player {
    public string $name;

    public function __construct($name){
        $this->name = $name;
    }
}