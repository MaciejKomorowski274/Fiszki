<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Usuwanie konta</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
            <div id="tlo">
        <h1 id="text">Podaj login i hasło użytkownika do usunięcia</h1>
        <form method="post"  actioid="tworzenie" id="log">
         
            <input type="text" name="imie" id="name" placeholder="Login"><br>
             <input type="password" name="haslo" id="pass"  placeholder="Hasło"><br>
            <input type="submit" value="Usuń" name="submit" class="przycisk">
            <input type="reset" value="Wyczyść" class="przycisk"> 
        </form>
        <a href="index.php">Powrót do strony startowej</a>
                <?php
    if(isset($_POST["submit"]))
    {
        $db = new SQLite3('database.db');
        $username = trim($_POST["imie"]);
        $password = $_POST["haslo"];     
        $licznik=0;
        $id=0;
        $res = $db->query('SELECT * FROM users');
        while ($row = $res->fetchArray()) 
        {
            if($row['username']==$username && $row['password']==$password)
            {
                $licznik++;
                $id=$row['id'];
            }
        }           
                 
    if($licznik!=0)
    {
        $reszulat = $db->exec("DELETE FROM users WHERE id = ".$id."");
        $katalog = $username;
        rmdir($katalog);
        if($reszulat==true)echo '<p class="zielony">Usunięcie użytkownika powiodło się</p>';
        else echo '<p class="czerwony">błąd podczas usuwania użytkownika</p>';
    }
        else 
        {
            echo '<p class="czerwony">Podano błędny login lub hasło</p>';
        }
    }

?>
        </div>
    </body>
</html>







