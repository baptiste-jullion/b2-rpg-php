<?php

namespace Rpg;

use Rpg\Models\Player;
use Rpg\Models\Characters\Enemy;
use Rpg\Models\Characters\Enemies\{Kobold};

class GameEngine
{
    private SessionStorage $storage;
    public ?Player $player;
    public ?Enemy $enemy;
    public array $logs;

    public function __construct()
    {
        $this->storage = new SessionStorage();
    }

    // Accède à l"objet storage afin d"alimenter les attributs dans notre moteur
    private function retrieveDataFromSession(): void
    {
        $this->logs = $this->storage->get("logs") ?: [];
        $this->player = $this->storage->get("player");
        $this->enemy = $this->storage->get("enemy");
    }

    // Ajoute un message à la boîte de log en bas à droite
    private function logAction(string $action): void
    {
        $message = date("H:i:s") . " : " . $action;
        $this->logs[] = $message;
        $this->storage->save("logs", $this->logs);
    }

    // Réinitialise le storage, associé au bouton en bas à droite
    private function resetStorage(): void
    {
        $this->storage->reset();
    }

    //? Form handlers

    private function handlePlayerInitialization(array $formData): void
    {

        $this->player = new Player($formData["player-name"], $formData["player-hero-class"]);
        $this->storage->save("player", $this->player);
        $this->logAction("Joueur créé : " . $this->player->getName());
        $this->logAction("Classe choisie : " . $this->player->getHeroClassName());
    }

    private function handlePlayerAction(array $formData): void
    {
        $action = $this->player->getHeroCharacter()->getAction($formData["action"]);
        $action->execute($this->enemy);
        $this->storage->save("player", $this->player);
        $this->storage->save("enemy", $this->enemy);
        $this->logAction($this->player->getName() . " a utilisé " . $action->getName());
        $this->enemyActionReply();
    }

    // Méthode appelée lorsqu"on fait soumet un formulaire,
    // utilise le champ caché "form" afin de rediriger sur la méthode associée
    // Une fois la requête traitée, on redirige sur la page par défaut
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

    //? Enemy handlers

    private function createEnemy(): void
    {
        $this->enemy = new Kobold();
        $this->storage->save("enemy", $this->enemy);
    }

    private function enemyActionReply(): void
    {
        if ($this->enemy->isDead()) {
            return;
        }
        $enemyAction = $this->enemy->getAction($this->enemy->getHealthPoints() <= 20 ? "Heal" : "Throw Spell");
        $enemyAction->execute($this->player->getHeroCharacter());
        $this->logAction($this->enemy->getName() . " a utilisé " . $enemyAction->getName());
        $this->storage->save("player", $this->player);
        $this->storage->save("enemy", $this->enemy);
    }

    //? Rendering

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
                require "views/enemy-dead.view.php";
                $this->logAction("Victory : " . $this->player->getName() . " destroyed " . $this->enemy->getName());
                return;
            }
            require "views/display-current-player.view.php";
        }
    }

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
}
