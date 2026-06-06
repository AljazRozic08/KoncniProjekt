<?php
include 'conn.php';
session_start();


if (!isset($_SESSION['id'])) {
    header("Location: prijava.html");
}
$id = $_SESSION['id'];

$sql = "SELECT * FROM set_treningov";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Napaka pri SQL: " . mysqli_error($conn));
}


if (isset($_POST['izbrisi'])) {
    $set_treningov_id = $_POST['set_treningov_id'];
    $sql_delete_vaje = "DELETE FROM set_vaje 
                        WHERE set_treningov_id = '$set_treningov_id'";

    $sql_delete = "DELETE FROM set_treningov 
                   WHERE id = '$set_treningov_id'";

    mysqli_query($conn, $sql_delete_vaje);    
    mysqli_query($conn, $sql_delete);
    
    header("Location: admin_set.php");
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
        <tr>
            <th>id</th>
            <th>naslov</th>
            <th>opis</th>
            <th>izbriši set</th>
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
                        echo "<td><form method='post' action='admin_set.php'>
                        <input type='hidden' name='set_treningov_id' value='" . $row['id'] . "'>
                        <button type='submit' name='izbrisi'>Izbriši set</button>
                        </form>";
                        echo "</tr>";
                    }
            }
    ?>
</table>
    
    </main>

</body>
</html>