<p>
    Soyez la bienvenue sur Gab Quest, entrez le nom de votre personnage pour commencer l'aventure.
</p>

<form method="POST">
    <div>
        <label for="player-name">Character name</label>
        <input class="btn" type="text" name="player-name" id="player-name" required minlength="4" />
    </div>
    <?php foreach (HEROES as $key => $hero) : ?>
        <div>
            <input type="radio" name="player-hero-class" id="<?= $key ?>" value="<?= $key ?>" required>
            <label for="<?= $key ?>"><?= $hero["label"] ?></label>
        </div>
    <?php endforeach ?>
    <button type="submit" class="btn">Valider</button>
    <input type="hidden" name="form" value="player-initializer">
</form>