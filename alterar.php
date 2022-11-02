<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="settings/css/alterar.css">
    <?php
        include_once("settings/components/head.php");
        require_once('class/alterar.php');
    ?>
</head>
<body>
<header>
    <?php
        include_once("settings/components/menu.php");
    ?>
</header>
<main>
    <div id="barra">
        <form method="post">
            <input type="text" name="nick" id="nick" placeholder="Nick do player" maxlength="64" autofocus required>
            <button type="submit" id="botaoAdicionar">Adicionar Nick</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th class="head">Nick</th>
                <th class="head">Foto</th>
                <th class="head">Alterar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                    $modificar = new alterar;
                    $modificar->listaModificar();
                ?>
            </tr>
        </tbody>
    </table>
</main>
<footer>
    <p>Ranked List &trade;</p>
</footer>
</body>
</html>