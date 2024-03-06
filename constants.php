<?php
 
use Rpg\Models\Characters\{Heroes, Enemies};


const HEROES = [
    "warrior" => [
        "label" => "Warrior",
        "class" => Heroes\Warrior::class,
    ],
    "witcher" => [
        "label" => "Witcher",
        "class" => Heroes\Witcher::class,
    ],
    "priest" => [
        "label" => "Priest",
        "class" => Heroes\Priest::class,
    ]
];

const ENEMIES = [
    1 => [
        "type" => Enemies\Kobold::class,
        "modifiers" => [
            5 => [
                "health" => 50,
                "damage" => 10,
                "heal" => 10
            ],
            10 => [
                "health" => 90,
                "damage" => 20,
                "heal" => 20
            ],
            12 => [
                "health" => 130,
                "damage" => 40,
                "heal" => 40
            ]
        ]
    ]
];

const ENEMIES_NAMES = [
    "Cryptsinger",
    "Wyrmeater",
    "Emberling",
    "Moonstalker",
    "Frostweaver",
    "Stonekin",
    "Gloomdweller",
    "Cinderhound",
    "Stormwraith",
    "Mosslurker",
    "Shadowcrawler",
    "Bonegnawer",
    "Starshroud",
    "Ironmaw",
    "Nightsinger",
    "Whisperwood",
    "Bloodseeker",
    "Skyterror",
    "Earthshaker",
    "Sandwraith",
    "Dreamweaver",
    "Stormspawn",
    "Mindflayer",
    "BoneNaga",
    "Dreadknight",
    "Fleshripper",
    "Moonbeast",
    "SunEater",
    "Soulforge",
    "Silverwing",
];

enum ACTION_TYPE: string
{
    case ATTACK = "bg-red-600";
    case HEAL = "bg-green-600";
    case EARN_MANA = "bg-violet-600";
    case LEVEL_UP = "bg-yellow-600";
}

enum COST_TYPE: string
{
    case MANA = "experiment";
    case EXPERIENCE_POINTS = "psychology";
}
