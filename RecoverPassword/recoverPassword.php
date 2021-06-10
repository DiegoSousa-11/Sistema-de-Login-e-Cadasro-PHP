<?php
//Get values ​​from the HTML
$submit = $_POST['submit'];
$email = $_POST['email'];
$connect = mysqli_connect("sql309.epizy.com", "epiz_28814223", "5yhdJFtuR6FmXw", "epiz_28814223_Pizzaria"); //Effect the connecting with database

if(isset($submit))
{
    //Submit command to the database execute
    $check = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'") or die("Erro ao selecionar!!");
    //Checks if the written email exist in database
    if(mysqli_num_rows($check) <= 0)
    {
        echo "<script language = 'javascript' type = 'text/javascript'>
                alert('O email escrito acima não existe!!');
                window.location.href = '../RecoverPassword';
              </script>";
    }
    else{
        //Get user id through of written email
        $select = mysqli_query($connect, "SELECT id_user FROM users WHERE email = '$email'") or die("Erro ao selecionar!!");
        //Returns the id obtained from the database
        $id = mysqli_fetch_array($select)[0];
        $key = md5(md5($id));

        //Key and id user are inserted in recover_password table
        $query = "INSERT INTO recover_password(id_user, key_recover) VALUES ('$id', '$key')";
        //The command above is sent to the database to execution
        $insert = mysqli_query($connect, $query);

        //The email with recovery link is sent to the user
        mail($email, "Link para redefinição de sua senha", "Link: " . "https://localhost/Pizzaria/NewPassword?key=$key");
        echo "<script language = 'javascript' type = 'text/javascript'>
                alert('Verifique a caixa de entrada do seu email!!');
                window.location.href = '../';
              </script>";
    }
}

?>