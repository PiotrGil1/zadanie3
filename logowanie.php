<?php

//login: admin
//haslo: test

$mysqli = new mysqli('localhost','root', '', 'sprawdzanie');

if($mysqli->connect_errno){
    echo 'nie udało się połączyć do MySQL: ' . $mysqli->connect_error;
    exit();
}
else{
    $msg='';

    if(!isset($_POST['log'])){
        $msg = '';     
    }
    else{
        if(empty($_POST['username']) || empty($_POST['password'])){
            $msg='brak nazwy użytkownika lub hasła';
        }
        else{

            $sql = "SELECT username, password FROM users WHERE username = ? AND password = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
            $stmt->execute();
            $wynik = $stmt->get_result();
            $znalezione = $wynik->num_rows;
        
            if($znalezione>0){

                 $msg='zalogowałeś się';
                   
            }
            else{
                $msg = 'niepoprawna nazwa użytkownika lub hasło ';
            }

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekran logowania</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name='username' placeholder="username">
    <input type="text" name='password' placeholder="password">
    <input type="submit" name='log' value="zaloguj się">
    <p><?=$msg;?></p>
</form>
</body>
</html>
