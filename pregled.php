<?php
    include 'conn.php';
    session_start();
    $id=$_SESSION['id'];
    $sql= "SELECT * FROM trening 
          WHERE uporabnik_id=$id";

    if (isset($_POST['izbrisi'])) {
    $id_treninga = $_POST['id_treninga'];

    $sql_delete = "DELETE FROM trening WHERE id = '$id_treninga'";
    mysqli_query($conn, $sql_delete);

    header("Location: pregled.php");
}
    $result=mysqli_query($conn,$sql);
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
    <div>
        <a href="nov_trening.php">Nov trening</a>
        <a href="statistika.php">Statistika treningov</a>
    </div>

    
    

</nav>




    

    <main>
    <table>
        <tr>
            <th>datum</th>
            <th>čas treninga</th>
            <th>opis</th>
            <th>slika</th>
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
                        echo '<td><img src="' . $row['slika'] . '" width="50" height="50"></td>';
                        echo "<td><a href='uredi_trening.php?id=".$row['id']."'>
                        <button type='button'>Uredi trening</button></a></td>";
                        echo "<td><form method='post' action='pregled.php'>
                        <input type='hidden' name='id_treninga' value='" . $row['id'] . "'>
                        <button type='submit' name='izbrisi'>Izbriši trening</button>
                        </form>
                        </td>";
                        echo "</tr>";
                    }
            }
    ?>
</table>

    </main>

</body>
</html>