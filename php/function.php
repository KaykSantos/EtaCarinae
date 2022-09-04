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
            header('Location: cadastro.php');
            exit;
        }

        $query = "INSERT INTO usuario (nome, email, senha, telefone, adm) VALUES ('$name', '$email', '$senha', '$tell', '1')";
        if($GLOBALS['conexao']->query($query) === TRUE){
            $_SESSION['status_cadastro'] = true;
        }
        header('Location: cadastro.php');
        $GLOBALS['conexao']->close();
        exit;
    }
    function EnviarCodigo($emailU){
        $email = mysqli_real_escape_string($GLOBALS['conexao'], $emailU);

        $query = 'SELECT * FROM usuario WHERE email = "'.$email.'"';
        $res = $GLOBALS['conexao']->query($query);
        if($res->num_rows == 0){
            $_SESSION['email-inexistente'] = true;
            header('Location: veriEmail.php');
            exit();
        }else{
            unset ($_SESSION['email-inexistente']);
            $user = $res->fetch_object();
            $_SESSION['cd'] = $user->cd;
            $_SESSION['nome'] = $user->nome;
            $_SESSION['email'] = $user->email;
            $_SESSION['senha'] = $user->senha;
            $_SESSION['telefone'] = $user->telefone;
            $assunto = 'Código de verificação - Eta Carinae';
            $codigo = rand(100000, 999999);
            $_SESSION['codigo'] = $codigo;

            $data_envio = date('d/m/Y');
            $hora_envio = date('H:i:s');
            $arquivo = "
            <html>
            <h3>Eta Carinae</h3>
            <p><b>Olá ".$_SESSION['nome']."</b></p>
            <p>Este é seu código de verificação: ".$codigo."</p>
            <p>Volte ao site e termine o processo.</p>
            <br><br>
            <p>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></p>
            </html>
            ";

            EnviarEmail($assunto, $codigo, $data_envio, $hora_envio, $arquivo);
            header('Location: veriCodigo.php');
            exit();
        }
    }
    function EnviarEmail($assu, $cod, $data_envio, $hora_envio, $corpoEmail){
        //Variáveis
        $codigo = $cod;
        $data = $data_envio;
        $hora = $hora_envio;

        //Corpo E-mail
        $arquivo = $corpoEmail;
        
        //Emails para quem será enviado o formulário
        $destino = $_SESSION['email'];
        $assunto = $assu;

        //Este sempre deverá existir para garantir a exibição correta dos caracteres
        $headers  = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "From: ".$_SESSION['nome']." <".$_SESSION['email'].">";

        //Enviar
        mail($destino, $assunto, $arquivo, $headers);
    }
    function VerificarCodigo($codigo){
        if($codigo == $_SESSION['codigo']){
            $_SESSION['codigoFalse'] = false;
            header('Location: novaSenha.php');
            exit();
        } else{
            unset($_SESSION['codigoFalse']);
            header('Location: veriCodigo.php');
            exit();
        }
    }
    function TrocarSenha($senha){
        $nova_senha = $senha;
        
        $query = 'SELECT * FROM usuario WHERE cd = "'.$_SESSION['cd'].'"';
        $res = $GLOBALS['conexao']->query($query);
        if($res->num_rows == 1){
            $query = 'UPDATE usuario SET senha ="'.$nova_senha.'" WHERE cd = "'.$_SESSION['cd'].'"';
            $res = $GLOBALS['conn']->query($query);
            $_SESSION['trocaSenhaEfetuada'] = true;
            header('Location: index.php');
            exit();
        }else{
            $_SESSION['trocaNaoEfetuada'];
            header('Location: index.php');
            exit();
        }

        
    }
?>
