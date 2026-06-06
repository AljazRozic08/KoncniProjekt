<?php
include 'conn.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: prijava.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $uporabnik_id = $_SESSION['id'];

    $ime = $_POST['ime'];
    $priimek = $_POST['priimek'];
    $email = $_POST['email'];
    $datum_roj = $_POST['datum_roj'];
    $visina = $_POST['visina'];
    $teza = $_POST['teza'];

    $sql = "UPDATE uporabnik
            SET
                ime = '$ime',
                priimek = '$priimek',
                email = '$email',
                datum_roj = '$datum_roj',
                visina = '$visina',
                teza = '$teza'
            WHERE id = '$uporabnik_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: profil.php");
    } else {
        echo mysqli_error($conn);
    }
}
?>