<?php

class connection
{
    private $pdo;
    public $msg_erro;

    public function __construct()
    {
        $nome = 'ranked';
        $user = 'root';
        $senha = '';
        $host = '127.0.0.1';

        try
        {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$user,$senha);
        }
        catch (Exception $e)
        {
            $this->msg_erro = $e->getMessage();
        }
    }

    //Faz a busca dos nicks de jogadores do banco de dados

    public function listar()
    {
        $sql = $this->pdo->query("SELECT nick FROM players");
        return($sql->fetchall());
    }

    //Exclui o nick do jogador do banco de dados

    public function excluir($nick)
    {
        $sql = $this->pdo->query("DELETE FROM `players` WHERE nick = '".$nick."'");

        session_destroy();

        echo
        "<script>
            alert('Player ".$nick." foi excluido da lista');
            document.location='alterar.php';
        </script>";
    }

    //Adiciona um nick ao banco de dados
    public function adicionar($nick)
    {
        //Verifica se o nick ja existe no banco de dados
        $sql = $this->pdo->query("SELECT * FROM players WHERE nick = '".$nick."'");

        if($sql->rowCount() > 0)
        {
            echo
            "<script>
                alert('Player ".$nick." ja esta adicionado a lista');
                document.location='alterar.php';
            </script>";
        }
        else
        {   
            session_destroy();

            $this->pdo->query("INSERT INTO players (`nick`) VALUES ('".$nick."')");

            $_POST['nick'] = null;

            echo
            "<script>
                alert('Player ".$nick." foi adicionado a lista');
                document.location='alterar.php';
            </script>";
        }
    }
}
?>
