<?php
    include 'conn.php';
    session_start();
    $id=$_SESSION['id'];
    
    $sql= "SELECT * FROM uporabnik
           WHERE id = $id";

    $result_uporabnik=mysqli_query($conn,$sql);
    $profil=mysqli_fetch_array($result_uporabnik);
?>
<html lang="sl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Evidenca treningov</title>

    
    <link rel="stylesheet" href="stil.css">

</head>
<body class="pregled-body">

    
<?php include 'nav.php'; ?>




    

    <main class="pregled-main">

      <form method="post" action="uredi_profil.php">
        <h1>Profil uporabnika</h1>
        <label>Ime</label><br><input name="ime" value="<?php echo $profil['ime']; ?>" required></input><br><br>
        <label>Priimek</label><br><input name="priimek" value="<?php echo $profil['priimek']; ?>" required></input><br><br>
        <label>Email</label><br><input name="email" value="<?php echo $profil['email']; ?>" required></input><br><br>
        <label>Datum rojstva</label><br><input name="datum_roj" value="<?php echo $profil['datum_roj']; ?>" required></input><br><br>
        <label>Višina</label><br><input name="visina" value="<?php echo $profil['visina']; ?>" min="1" max="240" required></input><br><br>
        <label>teza</label><br><input name="teza" value="<?php echo $profil['teza']; ?>" min="1" max="240" required></input><br><br>
         <button type="submit">Shrani podatke</button><br><br>
        
      </form>
      <button><a href="odjava.php">Odjava</a></button>


    </main>

</body>
</html>



    