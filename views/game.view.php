<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My RPG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link href="public/game.css" rel="stylesheet">
</head>

<body class="bg-[var(--bg)] text-[var(--fg)] font-sans">
<div class="container pt-3 mx-auto min-h-[100vh]">
    <h1 class="text-center text-4xl">My RPG</h1>

    <div>
        <?php $game->run(); ?>
    </div>

    <div class="fixed bottom-0 right-0 mr-4 rounded-t-xl bg-[var(--bg2)] border border-[var(--border)] w-[600px] aspect-video font-mono overflow-y-scroll translate-y-[270px] hover:translate-y-0 transition-transform"
         style="mask-image: linear-gradient(to top, transparent 0%, black 20%) ">
        <ul class="flex flex-col-reverse">
            <div class="h-[56px]"></div>
            <?php foreach ($game->logs as $log) : ?>
                <hr class="border-[var(--border)]">
                <style>
                    li:last-child {
                        animation: fadeOut 2s ease-in-out forwards;
                    }

                    @keyframes fadeOut {
                        0% {
                            background-color: transparent;
                        }

                        10% {
                            background-color: green;
                        }

                        100% {
                            background-color: transparent;
                        }
                    }
                </style>
                <li class="p-4"><?= $log ?></li>
            <?php endforeach ?>
        </ul>
    </div>

    <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir reprendre de 0 ?')">
        <div class="fixed bottom-0 m-4 left-0">
            <input type="hidden" name="form" value="reset-storage" />
            <button type="submit" class="btn">Reset</button>
        </div>
    </form>
</div>
</body>

</html>