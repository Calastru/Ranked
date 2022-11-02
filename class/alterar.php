<?php

require_once('player.php');
require_once('banco.php');

class alterar
{
    public function listaModificar()
    {
        $banco = new connection;

        $busca = new player;

        $lista = $busca->buscarPlayers($banco->listar());

        foreach ($lista as $value)
        {
            //Não exibir se lista vier com valor 'nick' como 'no data'
            if($value['nick'] != 'no data')
            {
                echo "<tr>";
                echo "<th>".$value['nick']."</th>";
                echo "<th><img src='".$value['foto']."'></th>";
                //Editar - Excluir
                echo "<th>
                    <a id='' href='alterar.php?name=true' id='botaoEditar'>Editar</a>
                    <a id='' href='alterar.php?excluir=".$value['nick']."' id='botaoExcluir'>Excluir</a>
                </th>";
                echo "</tr>";
            }
        }

        //Executa se o valor 'excluir' for colocado na URL, utiliza-se o botao excluir para colocar  
        if(isset($_GET['excluir']))
        {
            $banco->excluir($_GET['excluir']);
        }

        if(isset($_POST['nick']))
        {
            if(file_exists('json/'.$_POST['nick'].'.json') == true)
            {
                $banco->adicionar($_POST['nick']);
            }
            else
            {
                echo
                "<script>
                    alert('Não foi possivel achar um jogador com o nick ".$_POST['nick'].", verifique se o nick esta correto.');
                    document.location='alterar.php';
                </script>";
            }
        }
    }

    public function teste($teste)
    {
        echo "<h1>Funcionando ".$teste."</h1>";
    }
}

?>