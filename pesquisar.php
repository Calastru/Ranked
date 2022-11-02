<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="settings/css/pesquisar.css">
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
        <form method="post">
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Nick do player" maxlength="64" autofocus required>
            <button type="submit" id="botaoBuscar">Buscar</button>
        </form>
    </div>
    <div id="info">
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
                <?php
                    $player = new player;
                    $player->pesquisa();
                ?>
            </tbody>
        </table>
    </div>
</main>
<footer>
    <p>Ranked List&trade;</p>
</footer>
</body>
</html>