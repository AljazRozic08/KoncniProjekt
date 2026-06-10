<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['id'])) {
    header("Location: prijava.html");

}

$id = $_SESSION['id'];

if (!isset($_GET['set_treningov_id'])) {
    die("Manjka set_treningov_id.");
}

$set_treningov_id = intval($_GET['set_treningov_id']);

if ($set_treningov_id <= 0) {
    die("Neveljaven set_treningov_id.");
}

if (isset($_POST['izbrisi'])) {
    $vaje_id = intval($_POST['vaje_id']);

    $sql_delete_vaje = "DELETE FROM set_vaje
                        WHERE set_treningov_id = $set_treningov_id
                        AND vaje_id = $vaje_id";

    if (!mysqli_query($conn, $sql_delete_vaje)) {
        die("Napaka pri brisanju: " . mysqli_error($conn));
    }

    header("Location: admin_dodaj_izbrisi_vajo.php?set_treningov_id=$set_treningov_id");

}

if (isset($_POST['dodaj'])) {
    $vaje_id = intval($_POST['vaje_id']);

    $sql_insert_vaje = "INSERT INTO set_vaje (set_treningov_id, vaje_id)
                        VALUES ($set_treningov_id, $vaje_id)";

    if (!mysqli_query($conn, $sql_insert_vaje)) {
        die("Napaka pri dodajanju: " . mysqli_error($conn));
    }

    header("Location: admin_dodaj_izbrisi_vajo.php?set_treningov_id=$set_treningov_id");

}

$sql_ni = "SELECT * FROM vaje 
           WHERE id NOT IN (
                SELECT vaje_id
                FROM set_vaje 
                WHERE set_treningov_id = $set_treningov_id
           )";
$result_ni = mysqli_query($conn, $sql_ni);

if (!$result_ni) {
    die("Napaka pri SQL: " . mysqli_error($conn));
}

$sql_in = "SELECT * FROM vaje 
           WHERE id IN (
                SELECT vaje_id
                FROM set_vaje 
                WHERE set_treningov_id = $set_treningov_id
           )";
$result_in = mysqli_query($conn, $sql_in);

if (!$result_in) {
    die("Napaka pri SQL: " . mysqli_error($conn));
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
    <h2>Vaje na treningu</h2>
    <tr>
        <th>id</th>
        <th>naslov</th>
        <th>opis</th>
        <th>slika</th>
        <th>izbriši vajo</th>
    </tr>

    <?php 
    if (mysqli_num_rows($result_in) > 0) {
        while ($row = mysqli_fetch_array($result_in)) {
            echo "<tr>";
            echo "<td class='navbtn'>" . $row['id'] . "</td>";
            echo "<td class='navbtn'>" . $row['naslov'] . "</td>";
            echo "<td class='navbtn'>" . $row['opis'] . "</td>";
            echo "<td><img src='" . $row['slika'] . "' width='50' height='50'></td>";

            echo "<td>
                    <form method='post' action='admin_dodaj_izbrisi_vajo.php?set_treningov_id=" . $set_treningov_id . "'>
                        <input type='hidden' name='vaje_id' value='" . $row['id'] . "'>
                        <button type='submit' name='izbrisi'>Izbriši</button>
                    </form>
                  </td>";

            echo "</tr>";
        }
    }
    ?>
</table>

<br><br>

<table>
    <h2>Vaje v bazi</h2>
    <tr>
        <th>id</th>
        <th>naslov</th>
        <th>opis</th>
        <th>slika</th>
        <th>dodaj vajo</th>
    </tr>

    <?php 
    if (mysqli_num_rows($result_ni) > 0) {
        while ($row = mysqli_fetch_array($result_ni)) {
            echo "<tr>";
            echo "<td class='navbtn'>" . $row['id'] . "</td>";
            echo "<td class='navbtn'>" . $row['naslov'] . "</td>";
            echo "<td class='navbtn'>" . $row['opis'] . "</td>";
            echo "<td><img src='" . $row['slika'] . "' width='50' height='50'></td>";

            echo "<td>
                    <form method='post' action='admin_dodaj_izbrisi_vajo.php?set_treningov_id=" . $set_treningov_id . "'>
                        <input type='hidden' name='vaje_id' value='" . $row['id'] . "'>
                        <button type='submit' name='dodaj'>Dodaj</button>
                    </form>
                  </td>";

            echo "</tr>";
        }
    }
    ?>
</table>

<br><br>

</main>

</body>
</html>
