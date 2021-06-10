<?php

$email = $_POST['email'];
$enter = $_POST['enter'];
$password = md5($_POST['password']);
$connect = mysqli_connect("localhost", "root", "", "pizzaria"); 

if(isset($enter))
{
    //Checks if the email and password exists in database 
    $check = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email' AND password = '$password'") or die("Erro ao selecionar!!");
    //Checks if the rows number is decrease or equal to zero, if yes, don't log in
    if(mysqli_num_rows($check) <= 0 )
    {
        echo "<script language = 'javascript' type = 'text/javascript'>
                alert('Email e/ou senha incorretos');
                window.location.href = './'; 
              </script>";
        die();
    }
    else{
        echo "<script language = 'javascript' type = 'text/javascript'>
                alert('Logado com sucesso!!');
                window.location.href = './'; 
              </script>";
    }
}

?>
