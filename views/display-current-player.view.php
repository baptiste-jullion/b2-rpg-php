<section class="grid grid-cols-2 gap-8 mt-16">
    <div class="rounded-xl bg-[var(--bg2)] border border-[var(--border)] p-8 grid grid-cols-3 gap-4">
        <h2 class="text-2xl col-span-full w-full text-center p-4 rounded-lg border border-[var(--border)]">
            <?= $this->player->getName() ?>
        </h2>
        <div class="col-span-2">
            <img class="rounded-lg" src="<?= $this->player->getHeroCharacter()->getImage() ?>" alt="">
        </div>
        <div class="flex flex-col col-span-1 gap-4 *:w-full *:justify-center *:p-4  *:rounded-lg *:flex *:items-center *:gap-2 *:h-full">
            <div class="bg-green-600" title="Health Points">
        <span class="material-symbols-rounded">
          favorite
        </span>
                <?= $this->player->getHeroCharacter()->getHealthPoints() ?>
                / <?= $this->player->getHeroCharacter()->getMaxHealthPoints() ?>
            </div>
            <div class="bg-blue-600" title="Mana Points">
        <span class="material-symbols-rounded">
          experiment
        </span>
                <?= $this->player->getHeroCharacter()->getManaPoints() ?>
            </div>
            <div class="bg-violet-600" title="Experience Points">
        <span class="material-symbols-rounded">
          psychology
        </span>
                <?= $this->player->getHeroCharacter()->getExperiencePoints() ?>
            </div>
            <div class="bg-yellow-600" title="Level (Wins to level up : <?= 'TODO' ?>)">
        <span class="material-symbols-rounded">
          award_star
        </span>
                <?= $this->player->getHeroCharacter()->getLevel() ?>
            </div>
        </div>
        <div class="col-span-full flex flex-col gap-4">
            <h2 class="text-2xl">Actions</h2>
            <form class="grid grid-cols-2 gap-4 *:w-full *:p-4 *:rounded-lg *:flex *:items-center *:justify-between"
                  method="POST">

                <?php
                foreach ($this->player->getHeroCharacter()->getActions() as $action) :
                    $disabled = $action->hasEnoughMoney() && $action->hasRequiredLevel() ? "" : "disabled";
                    $color = $action->getType()->value;
                    $title = $action->hasRequiredLevel() ? $action->getDescription() : "This action requires level " . $action->getRequiredLevel() . " (current: " . $this->player->getHeroCharacter()->getLevel() . ")";
                    ?>
                    <button title="<?= $title ?>" class="<?= $color ?> disabled:opacity-50" type="submit" name="action"
                            value="<?= $action->getName() ?>" <?= $disabled ?>>
                        <?= $action->getName() ?> [<?= $action->getValue() ?>]
                        <span class="p-2 flex items-center w-fit rounded-md gap-2 bg-blue-600">
              <span class="material-symbols-rounded">
                <?= $action->getCostType()->value ?>
              </span> <?= $action->getCost() ?>
            </span>
                    </button>
                <?php endforeach ?>
                <input type="hidden" name="form" value="player-execute-action">
            </form>
        </div>
    </div>
    <div class="rounded-xl h-fit bg-[var(--bg2)] border border-[var(--border)] p-8 grid grid-cols-3 gap-4">
        <h2 class="text-2xl col-span-full h-fit w-full text-center p-4 rounded-lg border border-[var(--border)]">
            <?= $this->enemy->getName() ?> (<?= $this->enemy->getType() ?>)
        </h2>
        <div class="col-span-full aspect-square">
            <img class="rounded-lg w-full h-full object-cover" src="<?= $this->enemy->getImage() ?>" alt="">
        </div>
        <div class="flex flex-col col-span-1 gap-4 *:w-full *:justify-center *:p-4  *:rounded-lg *:flex *:items-center *:gap-2 *:h-full">
            <div class="bg-green-600 w-full">
                <span class="material-symbols-rounded">
                  favorite
                </span>
                <?= $this->enemy->getHealthPoints() ?>/<?= $this->enemy->getMaxHealthPoints() ?>
            </div>
        </div>
</section>