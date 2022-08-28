<?php 
session_start();
include('conn.php');
if(empty($_POST['email']) || empty($_POST['senha'])){
    header('Location: ../index.php');
    exit();
}   

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT * FROM usuario WHERE email = '{$email}' AND senha = '{$senha}'";

$res = mysqli_query($conexao, $query);

$row = mysqli_num_rows($res);
if($row == 1){
    $_SESSION['email'] = $email;
    header('Location: ../painel.php');
}else{
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../index.php');
    exit();
}