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
    <title>Czas na ćwiczenia</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="skrypt.js"></script>
    </head>
    <body onload="init()"> 
        <div id="tlo">
        <?php
            writeMsg();
            if(isset($_POST["submit"]))writeMsg();
            function writeMsg() 
            {
                $wskaz = fopen("slowka.txt", "r");
                $licz=0;
                while($wiersz = @fgets($wskaz, 1024))$licz++;
	            fclose($wskaz);
                $i = (rand(0,($licz-1)/2))*2;
                $t=0;
                $wskaz = fopen("slowka.txt", "r");
                while($wiersz = @fgets($wskaz, 1024))
	            {
                    if($t==$i)echo '<input id="przod" type="hidden" value="'.$wiersz.'">';
                    if($t==$i+1)echo '<input id="tyl" type="hidden" value="'.$wiersz.'">';
                    $t++;
                }
                fclose($wskaz);
            }

        
        
     ?><p id="odpowiedzi">
        
   
     <script> karta();</script>
    </p>
     
<div id="testtylu"></div>
     <input type="button" value="tablica"  size="23" onclick="tablica()" class="przycisk">
     <input type="button" value="pisanie"  size="23" onclick="array()" class="przycisk">
     <input type="button" value="karta"  size="23" onclick="karta()" class="przycisk"><form action="" > <input type="submit" name="submit" id="nastepna" Value=">>> Nastepna fiszka >>>"></form>
               <a  class="loginki" href="index.php">Powrót do strony startowej</a>
        <div class="loginki">Chcesz się wylogować <?php echo $_SESSION['us']; ?>?</div><a class="loginki" href="logout.php">Wyloguj</a>   
        </div>
    </body>
</html>

