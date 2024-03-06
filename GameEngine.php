<?php

namespace Rpg;

use Rpg\Models\Player;
use Rpg\Models\Characters\Enemy;
use Rpg\Models\Characters\Enemies\{Harpy, Kobold, Wraith, Boss};

class GameEngine
{
    public ?Player $player;
    public ?Enemy $enemy;
    public array $logs;
    private SessionStorage $storage;

    public function __construct()
    {
        $this->storage = new SessionStorage();
    }

    // Accède à l"objet storage afin d"alimenter les attributs dans notre moteur

    public function run(): void
    {
        // Récupération des données
        $this->retrieveDataFromSession();

        // Traitement des formulaires
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handleForm($_POST);
        } else {
            $this->render();
        }
    }

    // Ajoute un message à la boîte de log en bas à droite

    private function retrieveDataFromSession(): void
    {
        $this->logs = $this->storage->get("logs") ?: [];
        $this->player = $this->storage->get("player");
        $this->enemy = $this->storage->get("enemy");
    }

    // Réinitialise le storage, associé au bouton en bas à droite

    private function handleForm(array $formData): void
    {
        switch ($formData["form"]) {
            case "reset-storage":
                $this->resetStorage();
                break;
            case "player-initializer":
                $this->handlePlayerInitialization($formData);
                break;
            case "player-execute-action":
                $this->handlePlayerAction($formData);
                break;
            default:
                throw new \Exception("Formulaire pas géré : " . $formData["form"]);
        }

        // Redirection sur la page par défaut
        header("Location: /");
        exit;
    }

    //? Form handlers

    private function resetStorage(): void
    {
        $this->storage->reset();
    }

    private function handlePlayerInitialization(array $formData): void
    {

        $this->player = new Player($formData["player-name"], $formData["player-hero-class"]);
        $this->storage->save("player", $this->player);
        $this->logAction("Joueur créé : " . $this->player->getName());
        $this->logAction("Classe choisie : " . $this->player->getHeroClassName());
    }

    // Méthode appelée lorsqu"on fait soumet un formulaire,
    // utilise le champ caché "form" afin de rediriger sur la méthode associée
    // Une fois la requête traitée, on redirige sur la page par défaut

    private function logAction(string $action): void
    {
        $message = date("H:i:s") . " : " . $action;
        $this->logs[] = $message;
        $this->storage->save("logs", $this->logs);
    }

    //? Enemy handlers

    private function handlePlayerAction(array $formData): void
    {
        $action = $this->player->getHeroCharacter()->getAction($formData["action"]);
        $action->execute($this->enemy);
        $this->logAction($this->player->getName() . " a utilisé " . $action->getName());
        $this->storage->save("player", $this->player);
        $this->storage->save("enemy", $this->enemy);
        $this->enemyActionReply();
    }

    private function enemyActionReply(): void
    {
        if (!$this->enemy->isDead()) {
            $enemyAction = $this->enemy->getAction($this->enemy->getHealthPoints() <= $this->enemy->getMaxHealthPoints() ? "Heal" : "Throw Spell");
            $enemyAction->execute($this->player->getHeroCharacter());
            $this->logAction($this->enemy->getName() . " a utilisé " . $enemyAction->getName());
        }
        $this->storage->save("player", $this->player);
        $this->storage->save("enemy", $this->enemy);
    }

    private function render()
    {
        if (!$this->player) {
            require "views/player-initializer-form.view.php";
        } else if ($this->player->getHeroCharacter()->isDead()) {
            require "views/player-dead.view.php";
            $this->logAction("GAME OVER : " . $this->player->getName() . " is dead...");
        } else if (1) {
            if (!$this->enemy) {
                $this->createEnemy();
            }
            if ($this->enemy->isDead()) {
                //                require "views/enemy-dead.view.php";
                $this->logAction("Round Win : " . $this->player->getName() . " destroyed " . $this->enemy->getName());
                $this->player->getHeroCharacter()->earnMana(60);
                $this->player->getHeroCharacter()->resetHP();
                $this->storage->save("player", $this->player);
                $this->createEnemy();
            }
            require "views/display-current-player.view.php";
        }
    }

    private function createEnemy(): void
    {
        switch ($this->player->getHeroCharacter()->getLevel()) {
            case 1:
                $this->enemy = new Kobold();
                break;
            case 2:
                $this->enemy = new Harpy();
                break;
            case 3:
                $this->enemy = new Wraith();
                break;
            case 4:
                $this->enemy = new Boss();
                break;
            case 5:
                require("views/enemy-dead.view.php");
                break;
        }
        $this->storage->save("enemy", $this->enemy);
    }
}
