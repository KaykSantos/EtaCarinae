<?php 
session_start();
include('php/function.php');
if($_POST){
    if(empty($_POST['codigo'])){
        header('Location: veriCodigo.php');
        exit();
    }else{
        VerificarCodigo($_POST['codigo']);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar senha</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="body-codigo">
    <main id="main-codigo">
        <section id="section-codigo" style="flex-direction: column;">
            <div id="div-codigo">
                <p>Eta Carinae</p>
                <form action="" method="POST" id="form-codigo" autocomplete="off">
                    <p class="centralText">Um código de verificação foi enviado para seu email. Não se esqueça de olhar a caixa de spam!</p>
                    <label for="codigo">Código de verificação: </label>
                    <input type="text" id="codigo" name="codigo" placeholder="Codigo">
                    <button type="submit" name="entrar" id="entrar">Enviar</button>
                    <p class="centralText"><a href="index.php">Cancelar</a></p>
                </form>
            </div>
            <?php
                if(isset($_SESSION['codigoFalse'])):
            ?> 
                <div id="codigoInvalido">
                    <p>Código inválido! Tente novamente.</p>
                </div>
            <?php
                endif;
                unset($_SESSION['codigoFalse']);
            ?>
        </section>
    </main>
</body>
</html>