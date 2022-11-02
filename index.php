<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="settings/css/index.css">
    <?php
        include_once('settings/components/head.php');
        require_once('class/player.php');
    ?>
</head>
<body>
<header>
    <?php
        include_once('settings/components/menu.php');
    ?>
</header>
<main>
    <div id="barra">
        <form action="<?php session_destroy(); ?>">
            <button type="submit" id="botaoAtualizar">Atualizar</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th class="head">nick</th>
                <th class="head">foto</th>
                <th class="head">k/d - global</th>
                <th class="head">rank</th>
                <th class="head">mmr</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                    $lista = new player;
                    $lista->listarPlayer();
                ?>
            </tr>
        </tbody>
    </table>
</main>
<footer>
    <p>Ranked List&trade;</p>
</footer>
</body>
</html>