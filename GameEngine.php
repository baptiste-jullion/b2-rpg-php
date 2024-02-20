<?php

namespace Rpg;

use Rpg\Models\Player;

class GameEngine {
    private SessionStorage $storage;
    public ?Player $player;
    public array $logs;

    public function __construct(){
        $this->storage = new SessionStorage();
    }

    // Accède à l'objet storage afin d'alimenter les attributs dans notre moteur
    private function retrieveDataFromSession() : void {
        $this->logs = $this->storage->get('logs') ?: [];
        $this->player = $this->storage->get('player');
    }

    // Ajoute un message à la boîte de log en bas à droite
    private function logAction(string $action) : void {
        $message = date("H:i:s") . " : " . $action;
        $this->logs[] = $message;
        $this->storage->save('logs', $this->logs);
    }

    // Réinitialise le storage, associé au bouton en bas à droite
    private function resetStorage() : void {
        $this->storage->reset();
    }

    // Utilisation du formulaire de choix de nom
    private function selectName(array $formData) : void {
        $player = new Player($formData['player-name']);
        $this->storage->save('player', $player);
        $this->logAction("Personnage créé : " . $player->name);
    }

    private function handleCombat(array $data) : void {
        $player = $this->player;
        $ennemy = $this->ennemy;
    }

    // Méthode appelée lorsqu'on fait soumet un formulaire,
    // utilise le champ caché "form" afin de rediriger sur la méthode associée
    // Une fois la requête traitée, on redirige sur la page par défaut
    private function handleForm(array $formData) : void {
        switch($formData['form']){
            case 'reset-storage':
                $this->resetStorage();
                break;
            case 'name-selector':
                $this->selectName($formData);
                break;
            case 'combat':
                $this->handleCombat($formData);
                break;
            default:
                throw new Exception("Formulaire pas géré : " + $formData['form']);
        }

        // Redirection sur la page par défaut
        header('Location: /');
        exit;
    }

    public function run() : void {
        // Récupération des données
        $this->retrieveDataFromSession();

        // Traitement des formulaires
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->handleForm($_POST);
        } else {
            // Choix du template d'affichage selon l'état du jeu
            if($this->player){
                require 'views/example.view.php';
            } else {
                require 'views/player-name-form.view.php';
            }
        }
    }
}