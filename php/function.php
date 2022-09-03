<?php
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'db_etacarinae');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar ao banco'); 

    function ProtegePagina(){
        if(!$_SESSION['email']){
            header('Location: ../index.php');
            exit();
        }
    }
    function Login($email, $senha){
        $email = mysqli_real_escape_string($GLOBALS['conexao'], $email);
        $senha = mysqli_real_escape_string($GLOBALS['conexao'], $senha);
        
        $query = "SELECT * FROM usuario WHERE email = '{$email}' AND senha = '{$senha}'";
        
        $res = mysqli_query($GLOBALS['conexao'], $query);

        if($res->num_rows > 0){
            $retorno['erro'] = false;
            $user = $res->fetch_object();
            $retorno['dados'] = $user;
            
        } else{
            $retorno['erro'] = true;
        }
        return $retorno;
    }
    function CadastrarUsuario($nameU, $emailU, $senhaU, $tellU){
        $name = mysqli_real_escape_string($GLOBALS['conexao'], $nameU);
        $email = mysqli_real_escape_string($GLOBALS['conexao'], $emailU);
        $senha = mysqli_real_escape_string($GLOBALS['conexao'], $senhaU);
        $tell = mysqli_real_escape_string($GLOBALS['conexao'], trim(md5($tellU)));
        
        $query = "SELECT COUNT(*) AS total FROM usuario WHERE email = '{$email}'";
        $res = mysqli_query($GLOBALS['conexao'], $query);
        $row = mysqli_fetch_assoc($res);

        if($row['total'] == 1){
            $_SESSION['usuario_existe'] = true;
            header('Location: ../cadastro.php');
            exit;
        }

        $query = "INSERT INTO usuario (nome, email, senha, telefone, adm) VALUES ('$name', '$email', '$senha', '$tell', '1')";
        if($GLOBALS['conexao']->query($query) === TRUE){
            $_SESSION['status_cadastro'] = true;
        }
        $GLOBALS['conexao']->close();
        exit;
    }
?>
