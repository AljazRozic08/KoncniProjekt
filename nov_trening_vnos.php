<?php
    
	include 'conn.php';
    session_start();
    $id=$_SESSION['id'];
    
        $opis = $_POST['opis'];
        $tezavnost = $_POST['tezavnost'];
        $cas_treninga = $_POST['cas_treninga'];
        $datum = $_POST['datum'];
        $lokacija = $_POST['lokacija'];
        $vrstatreninga = $_POST['vrstatreninga'];

        $ime_slike = $_FILES['slika']['name'];
        $tmp_slike = $_FILES['slika']['tmp_name'];
        $mapa = "slikeTreningov/";
        $pot_slike = $mapa . $ime_slike;
        move_uploaded_file($tmp_slike, $pot_slike);

        if ($opis == "" || $tezavnost == ""|| $cas_treninga == "" || $lokacija == "" || $vrstatreninga == "")
         {
            echo "Izpolni obvezna polja.";
            header("Refresh:3; url=nov_treninga.php");
           

        }
        else
        {
                
                    $sql = "INSERT INTO trening(datum,  cas_treninga, opis, Uporabnik_id, tezavnost, slika, Lokacija_id, VrstaTreninga_id) 
                            VALUES ('$datum','$cas_treninga','$opis','$id','$tezavnost','$pot_slike','$lokacija','$vrstatreninga')";
                
                    if(mysqli_query($conn,$sql))
                    {
                        echo "Nov trening uspešno dodan";
                        header("Refresh:5; url=pregled.php");
                    

                    }else
                    {
                        echo "Napaka pri dodajanju treninga";
                        header("Refresh:3; url=nov_trening.php");
                       
                    }
        }

     
?>