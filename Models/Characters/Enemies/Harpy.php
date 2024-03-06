<?php

namespace Rpg\Models\Characters\Enemies;

use Rpg\Models\{Action};
use Rpg\Models\Characters\Enemy;

class Harpie extends Enemy
{
    public function __construct()
    {

        $throwSpell = new Action("Throw Spell", \ACTION_TYPE::ATTACK, 35, $this);
        $healSelf = new Action("Heal", \ACTION_TYPE::HEAL, 8, $this);

        parent::registerActions([$throwSpell, $healSelf]);

        parent::__construct(rand(125, 160));

        $this->setImage("https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/64e788f3-00a1-4c15-95ef-9886ed94f27b/dctuzid-a0809db6-22c8-42d5-a067-a09577ff0cdd.jpg/v1/fill/w_1280,h_1811,q_75,strp/harpy_by_jansoares_dctuzid-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTgxMSIsInBhdGgiOiJcL2ZcLzY0ZTc4OGYzLTAwYTEtNGMxNS05NWVmLTk4ODZlZDk0ZjI3YlwvZGN0dXppZC1hMDgwOWRiNi0yMmM4LTQyZDUtYTA2Ny1hMDk1NzdmZjBjZGQuanBnIiwid2lkdGgiOiI8PTEyODAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.SnwSOVhVxnepidbtETaiiUTvC-SrrAPwcyjBjalepOg");
    }
}
