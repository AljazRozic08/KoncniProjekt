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

if (isset($_POST['dodaj'])) {

    $naslov = $_POST['naslov'];
    $opis = $_POST['opis'];

    $sql_insert_set = "INSERT INTO set_treningov (naslov, opis)
                   VALUES ('$naslov', '$opis')";

    mysqli_query($conn, $sql_insert_set);

    header("Location: admin_set.php");
  
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
if (isset($_POST['dodaj_izbrisi_vajo'])) {
    $set_treningov_id = $_POST['set_treningov_id'];

    header("Location: admin_dodaj_izbrisi_vajo.php?set_treningov_id=" . $set_treningov_id);

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


<br><br>
    <table>
        <h2>Prikaz setov treninga</h2>
        <tr>
            <th>id</th>
            <th>naslov</th>
            <th>opis</th>
            <th>izbriši/dodaj vaje</th>
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
                        <button type='submit' name='dodaj_izbrisi_vajo'>dodaj/izbriši vaje</button>
                        </form>";
                        echo "<td><form method='post' action='admin_set.php'>
                        <input type='hidden' name='set_treningov_id' value='" . $row['id'] . "'>
                        <button type='submit' name='izbrisi'>Izbriši</button>
                        </form>";
                        echo "</tr>";
                    }
            }
    ?>
</table><br><br>
    <h2>Dodaj set treningov</h2><br>

<form method="post" action="admin_set.php">
    
    <label>Naslov</label><br>
    <input type="text" name="naslov" required><br><br>

    <label>Opis</label><br>
    <textarea name="opis" required></textarea><br><br>

    <button type="submit" name="dodaj">Dodaj set</button>

</form>
    
    </main>

</body>
</html>