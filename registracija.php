<?php
    include 'conn.php';

    if (isset($_POST['ime']) && isset($_POST['priimek']) && isset($_POST['email']) && isset($_POST['datum_rojstva']) && isset($_POST['visina']) && isset($_POST['teza']) && isset($_POST['geslo']))
     {
        $ime = $_POST['ime'];
        $priimek = $_POST['priimek'];
        $email = $_POST['email'];
        $geslo = $_POST['geslo'];
        $visina = $_POST['visina'];
        $teza = $_POST['teza'];
        $datum_rojstva = $_POST['datum_rojstva'];
    

        if ($ime == "" || $priimek == ""|| $email == "" || $geslo == "" || $visina == "" || $teza == "" || $datum_rojstva == "" )
         {
            echo "Izpolni vsa polja.";
            header("Refresh:3; url=registracija.html");
           

        }
        else
        {
            $preveri = "SELECT * FROM uporabnik WHERE email='$email';";
            $result = mysqli_query($conn,$preveri);
            if(mysqli_num_rows($result)>0)
            {
                echo "Uporabnik s tem emailom že obstaja";
                 header("Refresh:3; url=registracija.html");
                

                
            }
                else
                {
                    $sql = "INSERT INTO uporabnik( ime, priimek, email, geslo, datum_roj, visina, teza) 
                            VALUES ('$ime','$priimek','$email','$geslo','$datum_rojstva','$visina','$teza')";
                
                    if(mysqli_query($conn,$sql))
                    {
                        echo "Registracija uspešna";
                        header("Refresh:3; url=glavna.html");
                    

                    }else
                    {
                        echo "Registracija ni uspela";
                        header("Refresh:3; url=registracija.html");
                       

                    }
                }
        }

     }

?>