<?php
include 'conn.php';
session_start();


if (!isset($_SESSION['id'])) {
    header("Location: prijava.html");
}
$id = $_SESSION['id'];

$sql = "SELECT * FROM vaje";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Napaka pri SQL: " . mysqli_error($conn));
}


if (isset($_POST['izbrisi'])) {

    $vaje_id = $_POST['set_vaje_id'];

    $sql_delete_vaje = "DELETE FROM set_vaje
                        WHERE vaje_id = '$vaje_id'";

    $sql_delete = "DELETE FROM vaje
                   WHERE id = '$vaje_id'";

    mysqli_query($conn, $sql_delete_vaje);   
    mysqli_query($conn, $sql_delete);

    header("Location: admin_vaja.php");
}


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
    <table>
        <h2>Prikaz vaj treningov</h2>
        <tr>
            <th>id</th>
            <th>naslov</th>
            <th>opis</th>
            <th>slika</th>
            <th>čas izvajanja</th>
            <th>Izbriši vajo</th>
        </tr>

        <?php 
        if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                         echo "<td class='navbtn'>" . $row['id'] . "</td>";
                        echo "<td class='navbtn'>" . $row['naslov'] . "</td>";
                        echo "<td class='navbtn'>" . $row['opis'] . "</td>";
                        echo '<td><img src="' . $row['slika'] . '" width="50" height="50"></td>';
                        echo "<td class='navbtn'>" . $row['cas_izvajanja'] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action='admin_vaja.php'>";
                        echo "<input type='hidden' name='set_vaje_id' value='".$row['id']."'>";
                        echo "<button type='submit' name='izbrisi'>Izbriši</button>";
                        echo "</form>";
                        echo "</td>";
                    }
            }
    ?>
</table>
    
    </main>

</body>
</html>