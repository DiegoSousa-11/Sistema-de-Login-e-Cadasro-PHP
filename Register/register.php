<?php

$fullname = $_POST['fullname'];    
$email = $_POST['email'];
$password = md5($_POST['password']); //md5 is used for encrypt user password
$confirmPassword = md5($_POST['Confirmpassword']);
$connect = mysqli_connect("sql309.epizy.com", "epiz_28814223", "5yhdJFtuR6FmXw", "epiz_28814223_Pizzaria"); //Connect site with database
$query_select = "SELECT email FROM users WHERE email = '$email' "; //Command to the database execute
$select = mysqli_query($connect, $query_select); //Is done the requested to database execute the command above
$array = mysqli_fetch_array($select); //The database send the reply
$logarray = isset($array['email']); 

//Remove blank spaces in the user data and check if it's null
if(trim($fullname) == null || trim($email) == null || trim($password) == null || trim($confirmPassword) == null)
{
    echo "<script language = 'javascript' type = 'text/javascript'>
            alert('Preencha todos os campos corretamente !!');
            window.location.href = 'index.html'; 
          </script>";
}
else{
    //Check if the email inserted, already exists
    if($logarray)
    {
        echo "<script language = 'javascript' type = 'text/javascript'>
                alert('Esse email já está cadastrado!');
                window.location.href = 'index.html';
              </script>";
        die();
    }
    else{
        //Check if the password is accordingly with the confirmation password
        if($confirmPassword == $password)
        {
            $query = "INSERT INTO users(fullname, email, password) VALUES ('$fullname', '$email', '$password')";
            $insert = mysqli_query($connect, $query);

            //Check if the insertion it worked out
            if($insert)
            {
                echo "<script language = 'javascript' type = 'text/javascript'>
                        alert('Usuário cadastrado com sucesso!');
                        window.location.href = '../';
                      </script>";
            }
            else{
                echo "<script language = 'javascript' type = 'text/javascript'>
                        alert('Não foi possível cadastrar esse usuário');
                        window.location.href = 'index.html';
                      </script>";
            }
        }
    }
}

?>