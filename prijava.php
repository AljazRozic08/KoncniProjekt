<?php
    
	include 'conn.php';
    if (isset($_POST['email']) && isset($_POST['geslo'])) 
    {
        $email=$_POST['email'];
        $geslo=$_POST['geslo'];
        
        $sql= "SELECT * FROM uporabnik WHERE email='$email' AND geslo='$geslo';";
        $result=mysqli_query($conn,$sql);
        $st=mysqli_num_rows($result);
        if($st===1){
            $row=mysqli_fetch_array($result);
            $_SESSION['id']= $row['id'];
            $_SESSION['ime']= $row['ime'];
            
            header("Location: pregled.php");
        }
        else{
            header("Refresh:3; url=prijava.php");
            echo "Ime ali geslo ni pravilno.";
	    }
    }
	
?>