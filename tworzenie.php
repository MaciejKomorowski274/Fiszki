<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Tworzenie konta</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
            <div id="tlo">
        <script>
        </script>
        <h1 id="text">Podaj dane nowego użytkownika: </h1>
        <form method="post"  actioid="tworzenie" id="log">

            <input type="text" name="imie" id="name" placeholder="Login"><br>
           <input type="password" name="haslo" id="pass"  placeholder="Hasło"><br>
            <input type="submit" value="Utwórz" name="submit" class="przycisk">
            <input type="reset" value="Wyczyść" class="przycisk">   
        </form>
        <a href="index.php" id="lewy">Powrót do strony startowej</a>
        <a href="usuwanie.php" id="prawy">Usuń konto</a>
                <?php
    if(isset($_POST["submit"]))
    {
        $db = new SQLite3('database.db');
        $username = trim($_POST["imie"]);
        $password = $_POST["haslo"];     
        $licznik=0;
        $res = $db->query('SELECT * FROM users');
        while ($row = $res->fetchArray()) if($row['username']==$username)$licznik++;
        if($licznik==0)
        {
            $reszulat = $db->exec("INSERT INTO users (username, password)VALUES ( '".$username."', '".$password."')");
            $res= $db->query('SELECT * FROM users');
            if($reszulat==true)
            {
                echo '<p class="zielony">Udało się stworzyć nowego użytkownika</p>';
            }
            else echo '<p class="czerwony">Bład tworzenia użytkownika</p>'; 

        }
        else echo  '<p class="czerwony">Użytkownik o takim loginie już istnieje</p>';
    }

?>


        </div>
    </body>
</html>


















