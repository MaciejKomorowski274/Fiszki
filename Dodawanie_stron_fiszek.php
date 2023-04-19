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
        <title>Dodawanie</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
        <div id="tlo">

        <script>
            function myFunction() 
            {
                document.getElementById("demo").innerHTML = "";
            }
        </script>
        <h1 id="text">Modyfikuj fiszki</h1>
        <form method="post" id="upload">
            <label>Pierwsza strona: 
            <input type="text" name="pierwsza" required></label><br>
            <label>Druga strona: 
            <input type="text" name="druga" required></label><br>
            <input type="submit" value="Zapisz" name="submit"  class="przycisk">
            <input type="reset" value="Wyczyść"  class="przycisk">
        </form>
        <a href="tworzenie_tali.php">Stwórz talię</a>
        <a href="index.php">Powrót na strone główna</a>
        <a href="cwicz.php">Ćwicz</a>
        <div class="loginki">Chcesz się wylogować <?php echo $_SESSION['us']; ?>?</div><a class="loginki" href="logout.php">Wyloguj</a>   
        <h1>Pliki znajdujące się na w folderze</h1>
        
            <?php
    $tabela = fread(fopen("plik.txt", "r"), filesize("plik.txt"));
    function writeMsg($tabela) 
    {
        $plik = fopen('slowka.txt','w');
        $db = new SQLite3($_SESSION['us'].'/talie.db');
        $res = $db->query("SELECT * FROM '".$tabela."'");
        echo "<div id='demo'>";
        $ile=0;
        echo '<table>';
        while ($row = $res->fetchArray()) 
        {echo '<tr>';
            echo '<form method="post">';
            echo '<td><input type="hidden" value="'.$row['id'].'" name="delete_file" />    ';
            echo '<input type="submit" value="X " class="x"/></td>';
            echo "<td>".$row['pierwsza']."</td><td>".$row['druga']. "</td>";
            $zawartosc = $row['pierwsza']."\n".$row['druga']. "\n";
            fwrite($plik, $zawartosc);
            echo '</form>';
         echo '</tr>';
            $ile++;
        }
        echo '<table>';
        if($ile==0) echo'<h3>Nie masz w tej tali jeszcze żadnych fiszek</h3>';
        echo "</div>";
    }

    writeMsg($tabela);
    
    if (array_key_exists('delete_file', $_POST)) 
    {
        $db = new SQLite3($_SESSION['us'].'/talie.db'); 
        $filename = $_POST['delete_file'];
        $reszulat = $db->exec("DELETE FROM '".$tabela."' WHERE id = ".$filename."");
        if ($reszulat==true) 
        {
            echo '<script>myFunction();</script>';
            writeMsg($tabela);
            echo '<p class="zielony">Fiszka została usunięta</p>';
        } 
        else 
        {
            echo '<script>myFunction();</script>';
            writeMsg($tabela);
            echo '<p class="czerwony">Fiszka nie została usunięta</p>';
        }
    }


    if(isset($_POST["submit"]))
    {
        $db = new SQLite3($_SESSION['us'].'/talie.db');
        $pierwsza=$_POST['pierwsza'];
        $druga=$_POST['druga'];
        $rezulaty=$db->exec("INSERT INTO '".$tabela."'(pierwsza,druga) VALUES ('".$pierwsza."','".$druga."')");
        if ($rezulaty==true) 
        {
            echo '<script>myFunction();</script>';
            writeMsg($tabela);
            echo '<p class="zielony">Fiszka została dodana</p>';
        } else 
        {
            echo '<script>myFunction();</script>';
            writeMsg($tabela);
            echo '<p class="czerwony">Fiszki nie udało się utworzyć</p>';
        }
        
    }
?>

        </div>
    </body>
</html>


