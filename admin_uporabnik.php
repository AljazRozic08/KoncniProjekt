<?php
include 'conn.php';
session_start();


if (!isset($_SESSION['id'])) {
    header("Location: prijava.html");
}
$id = $_SESSION['id'];

$sql = "SELECT * FROM uporabnik
        WHERE id!=$id";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Napaka pri SQL: " . mysqli_error($conn));
    
}

if (isset($_POST['izbrisi'])) {
    $uporabnik_id = $_POST['uporabnik_id'];

    $sql_delete = "DELETE FROM uporabnik 
                   WHERE id = '$uporabnik_id'";

    mysqli_query($conn, $sql_delete);

    header("Location: admin_uporabnik.php");
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
        <h2>Prikaz uporabnikov</h2>
        <tr>
            <th>id</th>
            <th>ime</th>
            <th>priimek</th>
            <th>email</th>
            <th>datum rojstva</th>
            <th>višina</th>
            <th>teža</th>
            <th>izbriši uporabnika</th>
        </tr>

        <?php 
        if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                        echo "<td class='navbtn'>" . $row['id'] . "</td>";
                        echo "<td class='navbtn'>" . $row['ime'] . "</td>";
                        echo "<td class='navbtn'>" . $row['priimek'] . "</td>";
                        echo "<td class='navbtn'>" . $row['email'] . "</td>";
                        echo "<td class='navbtn'>" . $row['datum_roj'] . "</td>";
                        echo "<td class='navbtn'>" . $row['visina'] . "</td>";
                        echo "<td class='navbtn'>" . $row['teza'] . "</td>";
                        echo "<td><form method='post' action='admin_uporabnik.php'>
                        <input type='hidden' name='uporabnik_id' value='" . $row['id'] . "'>
                        <button type='submit' name='izbrisi'>Izbriši</button>
                        </form>";
                        echo "</tr>";
                    }
            }
    ?>
</table>
    
    </main>

</body>
</html>