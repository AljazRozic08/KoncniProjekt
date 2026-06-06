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
    <a href="">Set</a>
    <a href="admin_set.php">Vaja</a>
    <a href="admin_uporabnik.php">Uporabnik</a>
</main>
</head>
<body class="pregled-body">

    
