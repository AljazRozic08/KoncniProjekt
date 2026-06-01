<?php
    
	include 'conn.php';
    session_start();
    $trening_id= $_GET['id'];
    $sql_lokacije = "SELECT * FROM lokacija";
    $result_lokacije = mysqli_query($conn,$sql_lokacije);

    $sql_vrstatreninga = "SELECT * FROM vrstatreninga";
    $result_vrstatreninga = mysqli_query($conn,$sql_vrstatreninga);

    $sql_uredi_trening= "SELECT * FROM trening WHERE id=$trening_id";
	$result_uredi_trening = mysqli_query($conn, $sql_uredi_trening);
    $trening = mysqli_fetch_array($result_uredi_trening);

?>
<html lang="sl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Evidenca treningov</title>

    
    <link rel="stylesheet" href="stil.css">

</head>
<body class="pregled-body">

    
<nav>

    
    <div class="logo">

        <img src="slike/logo.png" alt="Logo">
        
    </div>

    
    

</nav>




    

    <main>
    <form method="post" enctype="multipart/form-data" action="uredi_trening_vnos.php?id=<?php echo $trening_id; ?>">
        <h1>Novi trening</h1>
        <label>Opis</label><br><textarea name="opis" required><?php echo $trening['opis']; ?> </textarea><br><br>
        <label >Težavnost (med 1 in 5):</label>
        <input type="number" name="tezavnost" value="<?php echo $trening['tezavnost']; ?>" required >
        <label>Čas treninga(v minutah)</label
        ><input type="number" name="cas_treninga" value="<?php echo $trening['cas_treninga']; ?>" required >
        <label>Datum treninga</label><input type="date" name="datum" value="<?php echo date('Y-m-d', strtotime($trening['datum'])); ?>" required>
        <label for="lokacija">Lokacija:</label>
        <select name="lokacija" id="lokacija">
        <option value="">Izberi lokacijo</option>

        <?php
       while ($lokacija = mysqli_fetch_array($result_lokacije)){
        $selected = "";

        if($lokacija['id'] == $trening['Lokacija_id'])
        {
            $selected = "selected";
        }

        echo '<option value="'.$lokacija['id'].'" '.$selected.'>'.$lokacija['naziv'].'</option>';
        }
        ?>
        </select>

    <br><br>

    <label for="vrstatreninga">Vrsta treninga:</label>
    <select name="vrstatreninga" id="vrstatreninga" required>
        <option value="">Izberi vrsto treninga</option>

        <?php
        while ($vrsta = mysqli_fetch_array($result_vrstatreninga)){
        $selected = "";

        if($vrsta['id'] == $trening['VrstaTreninga_id'])
        {
            $selected = "selected";
        }

        echo '<option value="'.$vrsta['id'].'" '.$selected.'>'.$vrsta['naziv'].'</option>';
        }
        ?>
    </select>
        <br><br><label for="slika">Slika:</label>
        <input type="file" name="slika" id="slika" accept="image/*">
        <button type="submit">Shrani spremembe</button>

    
      </form>

    </main>

</body>
</html>
