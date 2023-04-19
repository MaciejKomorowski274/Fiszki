<?php
    session_start();
    if(isset($_SESSION["loggedin"])== true)
    {
        header("location: welcome.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="tlo">
        <h1 id="text">Logowanie</h1>
        <form action="" method="POST">
            
            <input type="text" name="username" placeholder="Login"required><br/>
            <input type="password" name="password"/ placeholder="Hasło"required><br>
            
            <input type="submit" value="Zaloguj"/ name="submit" id="przycisk">
        </form>
        <a href="tworzenie.php" id="lewy">Utwórz konto</a>
        <a href="usuwanie.php" id="prawy">Usuń konto</a>
    </div>
</body>
</html>

<?php

    if(isset($_POST["submit"]))
    {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $database = new SQLite3('database.db');
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $statement = $database->prepare($sql);
        $statement->bindValue(':username', $username, SQLITE3_TEXT); 
        $statement->bindValue(':password', $password, SQLITE3_TEXT); 
        $result = $statement->execute()->fetchArray(SQLITE3_ASSOC);
        
        if($result==false)
        {
            echo '<script>';
            echo 'alert("Podałeś niepoprawny login lub hasło")';
            echo '</script>';
        }
        else
        {   
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION['us'] = $username;
            header("Location: welcome.php");
        }
    }

?>