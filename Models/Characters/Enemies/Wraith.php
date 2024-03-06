<?php

namespace Rpg\Models\Characters\Enemies;

use Rpg\Models\{Action};
use Rpg\Models\Characters\Enemy;

class Wraith extends Enemy
{
    public function __construct()
    {

        $throwSpell = new Action("Throw Spell", \ACTION_TYPE::ATTACK, 250, $this);
        $healSelf = new Action("Heal", \ACTION_TYPE::HEAL, 200, $this);

        parent::registerActions([$throwSpell, $healSelf]);

        parent::__construct(750);

        $this->setImage("https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/89a5dbac-600c-4ec6-886f-bf464a8f8ea1/dfv1vxt-e3c86176-3c05-4764-b1ae-1f8e55ea5ca7.jpg/v1/fill/w_1920,h_1108,q_75,strp/wraith_by_nostalgicsuperfan_dfv1vxt-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTEwOCIsInBhdGgiOiJcL2ZcLzg5YTVkYmFjLTYwMGMtNGVjNi04ODZmLWJmNDY0YThmOGVhMVwvZGZ2MXZ4dC1lM2M4NjE3Ni0zYzA1LTQ3NjQtYjFhZS0xZjhlNTVlYTVjYTcuanBnIiwid2lkdGgiOiI8PTE5MjAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.M4nWBZMCuCs1awK4Hu0MzW9_xqhMDhFnbKt9xeQLz7k");
    }
}
