<?php
    session_start();
    if(isset($_SESSION["loggedin"])== false)
    {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Zalogowano</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<div id="tlo">
        <h1 id="text">Wybierz talie fiszek</h1>
        <form method="post" action="" id="upload">
            <label>Twoje talie: 
                <?php
                 

                    $licz=0;
                    $db = new SQLite3($_SESSION['us'].'/talie.db');
                    echo "<select name='wybor'>";
                    $tablesquery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
                    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) 
                    {
                        echo "<option value=".$table['name'].">".$table['name']."</option>";
                        $licz++;
                    }
                    
                    if($licz==0)echo "<option value='Nie posiadasz żadnych tali'>Nie posiadasz żadnych tali</option>";   
                echo "</select>";
            
                ?>
            </label><br>
            <input type="submit" value="Usuń" name="submit" class="przycisk">
            <input type="reset" value="Wyczyść" class="przycisk">    
        </form>
        <a href="tworzenie_tali.php">Stwórz talię</a>
        <a href="index.php">Powrót na strone główna</a>

        <div class="loginki">Chcesz się wylogować <?php echo $_SESSION['us']; ?>?</div><a class="loginki" href="logout.php">Wyloguj</a>  
        </div>
    </body>
</html>


<?php
    if(isset($_POST["submit"]))
    {
        $sciezka=$_SESSION['us'];
        $db = new SQLite3($_SESSION['us'].'/talie.db');
        $nazwa=$_POST["wybor"];
        $licznik=0;
        $tablesquery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
        while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) 
        {
            if ($table['name']==$nazwa)$licznik++;
        }

        if($licznik==1)
        {
            $db->exec("DROP TABLE ".$nazwa.";");
            if($tablesquery==true)echo '<p class="zielony">Udało się usunąć talię</p>';
            else echo  '<p class="czerwony">Nie udało się usunąć talii</p>';
           header('refresh: 2;');
        
        }
        else echo  '<p class="czerwony">Talia o takiej nazwie nie istnieje</p>';
    }
?>

