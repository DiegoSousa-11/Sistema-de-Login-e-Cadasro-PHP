<?php
    $key = $_GET['key'];
    $connect = mysqli_connect("sql309.epizy.com", "epiz_28814223", "5yhdJFtuR6FmXw", "epiz_28814223_Pizzaria");
    $check = mysqli_query($connect, "SELECT * FROM recover_password WHERE key_recover = '$key'") or die("Erro ao selecionar!!");

    //Get link key and check if it's is empty or not exist in database 
    if(empty($key) || mysqli_num_rows($check) <= 0)
    {
        echo "Página não encontrada";
    }
    else {
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/Icone Ki-pizza.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Sansita+Swashed:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
    <title>Pizzaria</title>
</head>
<body>
    <div class="content">
        <!-- Login screen header -->
        <header>
            <img src="../img/Icone Ki-pizza.png" alt="icon_pizza">
            <h1>Pizzaria</h1>
        </header>

        <!-- Login screen form -->
        <form action="#" method="POST">

            <!-- Password input -->
            <section>
                <label id="text_input" class="text_input">Senha</label>
                <input class="input" type="password" name="password" placeholder="Senha" rel="Senha">
            </section>

            <!-- Confirm password input -->
            <section>
                <label id="text_input" class="text_input input_label_big">Confirmar senha</label>
                <input class="input" type="password" name="Confirmpassword" placeholder="Confirmar senha" rel="Confirmar senha">
            </section>

            <!-- Register button -->
            <input class="button_submit" name="submit" type="submit" value="Redefinir">
        </form>
    </div>
    <script src="../Js/script.js"></script>
</body>
</html>

<?php
    }
    //Check if the inputs already filled
    if(isset($_POST['password']) && isset($_POST['Confirmpassword']))
    {
        $password = md5($_POST['password']);
        $Confirmpassword = md5($_POST['Confirmpassword']);
        
        //Check if the password and password confirmation are equals
        if($password == $Confirmpassword)
        {
            //Search the id user through of your key
            $select = mysqli_query($connect, "SELECT id_user FROM recover_password WHERE key_recover = '$key'") or die("Erro ao selecionar!!");
            $id = mysqli_fetch_array($select)[0];

            //Update the user password
            $query = "UPDATE users set password = '$password' WHERE id_user = '$id'";
            $insert = mysqli_query($connect, $query);

            //Delete the user id of the recover_password table
            $delete = mysqli_query($connect, "DELETE FROM recover_password WHERE id_user = '$id'");

            //Check if the user password goes updated
            if($insert)
            {
                echo "<script language = 'javascript' type = 'text/javascript'>
                        alert('Senha alterada com sucesso!!');
                        window.location.href = '../';
                      </script>";
            }
        }
        else
        {
            echo "<script language = 'javascript' type = 'text/javascript'>
                    alert('As duas senhas inseridas são diferentes, escreva-as novamente!!');
                  </script>";
        }
    }
?>