<?php
include 'conn.php';
session_start();

if (isset($_POST['email']) && isset($_POST['geslo'])) {
    $email = $_POST['email'];
    $geslo = $_POST['geslo'];

    $sql = "SELECT * FROM uporabnik WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_array($result);

        if (password_verify($geslo, $row['geslo'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['ime'] = $row['ime'];

            header("Location: pregled.php");
            
        } else {
            echo "Email ali geslo ni pravilno.";
            header("Refresh:3; url=prijava.php");
        }
    } else {
        echo "Email ali geslo ni pravilno.";
        header("Refresh:3; url=prijava.php");
    }
}
?>