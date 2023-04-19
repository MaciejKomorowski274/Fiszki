<?php
    session_start();
    if(isset($_SESSION["loggedin"])== false)
    {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title >Tworzenie talii</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
       <div id="tlo">
        <h1 id="text">Wybierz talie fiszek</h1>
        <form method="post" id="upload">
            <label>Wpisz nazwę nowej tali:<input type="text" name="nazwa"></label><br>
            <input type="submit" value="Utworz" name="submit" class="przycisk">
            <input type="reset" value="Wyczyść" class="przycisk">    
        </form>
                <a href="index.php">Powrót do strony startowej</a>
        <a href="usuwanie_tali.php">Usuwanie tali</a>
        <div class="loginki">Chcesz się wylogować <?php echo $_SESSION['us']; ?>?</div><a class="loginki" href="logout.php">Wyloguj</a>   
        </div>
    </body>
</html>

<?php
    if(isset($_POST["submit"]))
    {
        $sciezka=$_SESSION['us'];
        $db = new SQLite3($_SESSION['us'].'/talie.db');
        $nazwa=$_POST["nazwa"];
        $licznik=0;
        $tablesquery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
        while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) 
        {
            if ($table['name']==$nazwa)$licznik++;
        }

        if($licznik==0)
        {
            $db->exec("CREATE TABLE '".$nazwa."'(id INTEGER PRIMARY KEY, pierwsza TEXT,druga TEXT)");
            if($tablesquery==true)echo '<p class="zielony">Udało się utworzyć talię</p>';
            else echo  '<p class="czerwony">Nie udało się utworzyć talii</p>';
        
        }
        else echo  '<p class="czerwony">Talia o takiej nazwie już istnieje</p>';
    }
?>
