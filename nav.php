<?php
include 'conn.php';

if (!isset($_SESSION['id'])) {
    header("Location: prijava.html");
}



$uporabnik_id = $_SESSION['id'];


$sql_nav="SELECT vloga FROM uporabnik
      WHERE id=$uporabnik_id";

$result_nav = mysqli_query($conn, $sql_nav);
$row = mysqli_fetch_row($result_nav);
$vloga = $row[0];




?>
<nav>
  <div class="logo">
    <img src="slike/logo.png" alt="Logo" />
  </div>
  <div>
    <a href="nov_trening.php">Nov trening</a>
    <a href="profil.php">Profil</a>
    <a href="set.php">Set treningov</a>
    <a href="pregled.php">Pregled</a>
    <?php
    if ($vloga == "admin") {
        echo '<a href="admin.php">Admin</a>';
    }
    ?>
  </div>
</nav>
