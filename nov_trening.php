<?php
    
	include 'conn.php';
    session_start();
    $id=$_SESSION['id'];
    $sql_lokacije = "SELECT * FROM lokacija";
    $result_lokacije =mysqli_query($conn,$sql_lokacije);

    $sql_vrstatreninga = "SELECT * FROM vrstatreninga";
    $result_vrstatreninga =mysqli_query($conn,$sql_vrstatreninga);
	
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




    

    <main>
    <form method="post"  action="nov_trening_vnos.php" enctype="multipart/form-data" >
        <h1>Novi trening</h1>
        <label>Opis</label><br><textarea name="opis" placeholder="Tukaj opišete trening..." required ></textarea><br><br>
        <label >Težavnost (med 1 in 5):</label>
        <input type="number"  name="tezavnost" min="1" max="5" required>
        <label>Čas treninga(v minutah)</label
        ><input type="number" name="cas_treninga" min="1" required />
        <label>Datum treninga</label><input type="date" name="datum" required />
        <label for="lokacija">Lokacija:</label>
        <select name="lokacija" id="lokacija">
        <option value="">Izberi lokacijo</option>

        <?php
        while ($lokacija = mysqli_fetch_array($result_lokacije)) {
            echo '<option value="'.$lokacija['id'].'">'.$lokacija['naziv'].'</option>';
        }
        ?>
        </select>

    <br><br>

    <label for="vrstatreninga">Vrsta treninga:</label>
    <select name="vrstatreninga" id="vrstatreninga">
        <option value="">Izberi vrsto treninga</option>

        <?php
        while ($vrsta = mysqli_fetch_array($result_vrstatreninga)) {
            echo '<option value="'.$vrsta['id'].'">'.$vrsta['naziv'].'</option>';
        }
        ?>
    </select>
        <br><br><label for="slika">Slika:</label>
        <input type="file" name="slika" id="slika" accept="image/*">
        <br>
        <img id="preview" src="" alt="Predogled slike" width="200" style="display: none;">
        <br>
        <button type="submit">Oddaj trening</button>

    
      </form>
    
    </main>

</body>
</html>
<script>
document.getElementById("slika").addEventListener("change", function () {
    const file = this.files[0];
    const preview = document.getElementById("preview");

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = "block";
    } else {
        preview.src = "";
        preview.style.display = "none";
    }
});
</script>
