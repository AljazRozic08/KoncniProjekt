<?php
    session_start();
    include 'conn.php';
    $id=$_SESSION['id'];
    $sql= "SELECT cas_treninga,datum,opis FROM trening 
          WHERE Uporabnik_id=$id";
    $result=mysqli_query($conn,$sql);
?>


<!DOCTYPE html>
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
    <div>
        <a href="pregled.html">Pregled treningov</a>
        <a href="Nov.html">Nov trening</a>
        <a href="statistika.html">Statistika treningov</a>
    </div>

    
    

</nav>




    

    <main>
    <table boredr="1">
        <tr><h2>Seznam treningov</h2>
            <th>datum</th>
            <th>čas treninga</th>
            <th>opis</th>
            <th>uredi</th>
            <th>izbriši</th>

        </tr>

        <?php 
        if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                        echo "<td class='navbtn'>" . $row['datum'] . "</td>";
                        echo "<td class='navbtn'>" . $row['cas_treninga'] . "</td>";
                        echo "<td class='navbtn'>" . $row['opis'] . "</td>";
                        echo "<td><button type='button'>Uredi trening</button></td>";
                        echo "<td><button type='button'>Izbriši trening</button></td>";
                        echo "</tr>";
                    }
            }
    ?>
</table>

    </main>

</body>
</html>