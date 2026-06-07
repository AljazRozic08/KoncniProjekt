<?php
    include 'conn.php';
    session_start();
    $id=$_SESSION['id'];
    
    
?>
<html lang="sl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Evidenca treningov</title>

    
    <link rel="stylesheet" href="stil.css">
    <?php include 'nav.php'; ?>
<main>
    <a href="admin_set.php">Izbriši/dodaj Set</a>
    <a href="admin_vaja.php">Izbriši Vajo</a>
    <a href="admin_uporabnik.php">Izbriši Uporabnika</a>
</main>
</head>
<body class="pregled-body">

    
