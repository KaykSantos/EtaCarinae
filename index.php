<?php 
session_start();
include('php/function.php');
if($_POST){
    if(empty($_POST['email']) || empty($_POST['senha'])){
    header('Location: index.php');
    exit();
    }else{
        $resultado = Login($_POST['email'], $_POST['senha']);
        $user = $resultado['dados'];
        if($resultado['erro'] == true){
            $_SESSION['nao_autenticado'] = true;
            header('Location: index.php');
            exit();
        }else{
            $_SESSION['cd'] = $user->cd;
            $_SESSION['nome'] = $user->nome;
            $_SESSION['email'] = $user->email;
            $_SESSION['senha'] = $user->senha;
            $_SESSION['telefone'] = $user->telefone;
            $_SESSION['adm'] = $user->adm;

            if($user->adm == 0){
                header('Location: pages/home.php');
            }else{
                header('Location: pages/homeUser.php');
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/mobileStyle.css">
</head>
<body id="body-login">
    <main id="main-login">
        <section id="section-login" style="flex-direction: column;">
            <div id="login">
                <p>Eta Carinae</p>
                <form method="POST" id="form-login" autocomplete="off">
                    <label for="email">Digite seu email:</label>
                    <input type="email" name="email" id="email" placeholder="Login">
                    <label for="senha">Digite sua senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                    <button type="submit" name="entrar" id="entrar">Entrar</button>
                    <p class="centralText">Não possui uma conta?</p>
                    <p class="centralText"><a href="cadastro.php">Cadastre-se!</a></p>
                </form>
            </div>
            <?php
                if(isset($_SESSION['nao_autenticado'])):
            ?>   
                <div id="erroLogin">
                    <p>Email e/ou senha inválidos!</p>
                </div>
            <?php
                endif;
                unset($_SESSION['nao_autenticado'])
            ?>
        </section>
    </main>
</body>
</html>