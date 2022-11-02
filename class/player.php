<?php

session_start();
include_once('banco.php');

class player
{
    private function url($nick)
    {
        //$url = "https://r6.tracker.network/api/v1/standard/profile/4/".$nick['nick']."";
        $url = 'json/'.$nick['nick'].'.json';

        return $url;
    }

    public function listarPlayer()
    {
        if (isset($_SESSION['listaOrdenada']))
        {
            $arr = $_SESSION['listaOrdenada'];

            foreach($arr as $show)
            {
                echo "<tr>";
                echo "<th>".$show['nick']."</th>";
                echo "<th><img src='".$show['foto']."'></th>";
                echo "<th>".substr($show['kd'], 0, 4)."</th>";
                echo "<th><img src='".$show['rank']."'></th>";
                echo "<th>".$show['mmr']."</th>";
                echo "</tr>";
            }
        }
        else
        {
            $banco = new connection;

            //Puxa os nicks do banco de dados
            $lista = $banco->listar();
            
            $busca = new player;

            $arr = $busca->buscarPlayers($lista);

            //Ordena o array pelo elemento selecionado
            array_multisort(array_map(function ($elemento)
            {
                return $elemento['mmr'];
            },$arr),SORT_DESC,$arr);

            //Guada o array na sessão do usuario
            $_SESSION['listaOrdenada'] = $arr;

            //Mostra as informações dos players
            foreach($arr as $show)
            {
                echo "<tr>";
                echo "<th>".$show['nick']."</th>";
                echo "<th><img src='".$show['foto']."'></th>";
                echo "<th>".substr($show['kd'], 0, 4)."</th>";
                echo "<th><img src='".$show['rank']."'></th>";
                echo "<th>".$show['mmr']."</th>";
                echo "</tr>";
            }
        }
    }

    public function buscarPlayers($lista)
    {
        //Se lista estiver vazia adiciona um array para exibição
        if($lista == null)
        {
            $lista = $arr[] = [
                "nick" => 'no data',
                "foto" => "no data",
                "kd" => "0000",
                "rank" => "no data",
                "mmr" => "0000",
            ];
        }
        else
        {
            foreach($lista as $nick)
            {
                //Verifica se existe o arquivo com o nick e se existir pega as informações do player
                if(file_get_contents($this->url($nick)) == true)
                {
                    $dados = json_decode(file_get_contents($this->url($nick)), true);

                    foreach($dados as $data)
                    {
                        $death = $data['stats']['3']['value'];
                        $kill = $data['stats']['2']['value'];
                        $arr[] = 
                        [
                            "nick" => $data['metadata']['platformUserHandle'],
                            "foto" => $data['metadata']['pictureUrl'],
                            "rank" => $data['stats']['0']['metadata']['iconUrl'],
                            "mmr" => $data['stats']['0']['displayValue'],
                            "kd" => $kill / $death
                        ];
                    }
                }
                else
                {
                    $arr[] = [
                        "nick" => $nick['nick'],
                        "foto" => "no data",
                        "kd" => "0000",
                        "rank" => "no data",
                        "mmr" => "0000",
                    ];
                }
            }
        }

        return $arr;
    }

    public function pesquisa()
    {
        $busca = new player;

        if(isset($_POST['pesquisa']))
        {
            $arr[] =
            [
                "nick" => $_POST['pesquisa']
            ];

            $info = $busca->buscarPlayers($arr);
        }
        else
        {
            $info = $busca->buscarPlayers(null);
        }

        foreach($info as $show)
        {
            echo "<tr>";
            echo "<th>".$show['nick']."</th>";
            echo "<th><img src='".$show['foto']."'></th>";
            echo "<th>".substr($show['kd'], 0, 4)."</th>";
            echo "<th><img src='".$show['rank']."'></th>";
            echo "<th>".$show['mmr']."</th>";
            echo "</tr>";
        }
    }

    //Teste
    public function teste($teste)
    {
        echo "<h1>Funcionando ".$teste."</h1>";
    }
}

?>