<?php

	include 'conn.php';
    session_start();
    $id_trening= $_GET['id'];

        $opis = $_POST['opis'];
        $tezavnost = $_POST['tezavnost'];
        $cas_treninga = $_POST['cas_treninga'];
        $datum = $_POST['datum'];
        $Lokacija_id = $_POST['lokacija'];
        $VrstaTreninga_id = $_POST['vrstatreninga'];

        $ime_slike = $_FILES['slika']['name'];
        $tmp_slike = $_FILES['slika']['tmp_name'];
        $mapa = "slikeTreningov/";
        $pot_slike = $mapa . $ime_slike;
        move_uploaded_file($tmp_slike, $pot_slike);

         $sql="UPDATE trening
        SET
        opis='$opis',
        tezavnost='$tezavnost',
        cas_treninga='$cas_treninga',
        datum='$datum',
        Lokacija_id='$Lokacija_id',
        VrstaTreninga_id='$VrstaTreninga_id',
        slika='$pot_slike'
        WHERE id= '$id_trening'";
    
        if(mysqli_query($conn,$sql))
        {
            header("Location: pregled.php");
        }
        else
        {
            echo mysqli_error($conn);
        }

?>





    

 