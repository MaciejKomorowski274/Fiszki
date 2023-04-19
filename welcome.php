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
        <title>Zalogowano</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <div id="tlo">
        <h1 id="text">Wybierz talie fiszek</h1>
        <form method="post" action="" id="upload">
            <label>Twoje talie: 
                <?php
                $test = file_exists($_SESSION['us'].'/talie.db'); 
    if (!$test) 
    {
     echo "Nie posiadasz żadnych tali";   
    }
                
           else
           {
               
                $licz=0;
                    if($db = new SQLite3($_SESSION['us'].'/talie.db'))
                    {
                        
                         echo "<select name='wybor'>";
                    $tablesquery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
                    while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) 
                    {
                        echo "<option value='".$table['name']."'>".$table['name']."</option>";
                        $licz++;
                    }
                    echo "</select>";
                    if($licz==0)echo "Nie posiadasz żadnych tali";    
                    else echo '<br><input type="submit" value="Wybierz talię" name="submit" id="przycisk"> '; 
                    }
                else {
                    echo "Nie posiadasz żadnych tali";    
                }
                   
               
           }
                
              
               ?>
            </label><br>
            
       
        </form>
        <a href="tworzenie_tali.php">Stwórz talię</a>
        <a href="usuwanie_tali.php">Usuń talię</a>

    
           <div class="loginki">Chcesz się wylogować <?php echo $_SESSION['us']; ?>?</div><a class="loginki" href="logout.php">Wyloguj</a> 
        </div>
    </body>
</html>



<?php
    $sciezka=$_SESSION['us'];
    if (!is_dir($sciezka)) 
    {
        if(!file_exists($sciezka))
        {   
            $oldMask = umask(0);
            if (!mkdir($sciezka, 0777, true)) 
            {
                die ('Nie udało sie utworzyć katalogu');
            }
        umask($oldMask);
        }
        else die("Nie udało się utworzyć katalogu użytkownika, ponieważ plik o tej nazwie już istnieje:". $sciezka);
    }
    if(isset($_POST["submit"]))
    {
        $zmienna=$_POST["wybor"];
        $fp = fopen("plik.txt", "w");
        fputs($fp, $zmienna);
        fclose($fp);
        header("location: Dodawanie_stron_fiszek.php"); 
    }
?>

