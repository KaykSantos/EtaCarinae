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

$user = $res->fetch_object();

$_SESSION['adm'] = $user->adm;

if($row == 1){
    $_SESSION['email'] = $email;
    echo '<script>'.$_SESSIOn['adm'].'</script>';
    header('Location: ../pages/home.php');
}else{
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../index.php');
    exit();
}