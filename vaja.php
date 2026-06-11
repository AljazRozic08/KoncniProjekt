<?php
include 'conn.php';
    session_start();

    $id = $_SESSION['id'];

    if (isset($_GET['id'])) {
        $set_id = $_GET['id'];
    } else {
        echo "Manjka ID treninga.";
        exit;
    }

    if (isset($_GET['vaja'])) {
        $trenutna_vaja = $_GET['vaja'];
    } else {
        $trenutna_vaja = 0;
    }

    if ($trenutna_vaja < 0) {
        $trenutna_vaja = 0;
    }

    $sql = "SELECT * FROM set_vaje
            WHERE set_treningov_id = $set_id
            ORDER BY id ASC";

    $result = mysqli_query($conn, $sql);

    $vaje = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $vaje[] = $row;
    }

    $skupaj_vaj = count($vaje);

    if ($skupaj_vaj == 0) {
        echo "Ta trening nima vaj.";
        exit;
    }

    if ($trenutna_vaja >= $skupaj_vaj) {
        $trenutna_vaja = $skupaj_vaj - 1;
    }

    $set_vaja = $vaje[$trenutna_vaja];

    if (isset($set_vaja['cas_izvajanja'])) {
        $cas = $set_vaja['cas_izvajanja'];
    } else {
        $cas = 60;
    }

    if (isset($set_vaja['vaja_id'])) {
        $vaja_id = $set_vaja['vaja_id'];
    } else if (isset($set_vaja['id_vaje'])) {
        $vaja_id = $set_vaja['id_vaje'];
    } else if (isset($set_vaja['vaje_id'])) {
        $vaja_id = $set_vaja['vaje_id'];
    } else {
        $vaja_id = 0;
    }

    if ($vaja_id != 0) {
        $sql2 = "SELECT * FROM vaje WHERE id = $vaja_id";
        $result2 = mysqli_query($conn, $sql2);
        $vaja = mysqli_fetch_assoc($result2);
    } else {
        $vaja = $set_vaja;
    }

    if (!$vaja) {
        echo "Vaja ne obstaja.";
        exit;
    }

    if (isset($vaja['naslov'])) {
        $naslov = $vaja['naslov'];
    } else {
        $naslov = "Brez naslova";
    }

    if (isset($vaja['opis'])) {
        $opis = $vaja['opis'];
    } else {
        $opis = "Opis ni dodan.";
    }

    if (isset($vaja['slika'])) {
        $slika = $vaja['slika'];
    } else {
        $slika = "";
    }
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Vaja</title>
    <link rel="stylesheet" href="stil.css">
</head>
<body class="vaja-body">

    <a href="set.php?id=<?php echo $set_id; ?>" class="set-domov-link">
    <button type="button" class="set-domov-btn">Nazaj na set</button></a>

    <main class="vaja-main">
        <div class="vaja-box">

            <h2>Vaja <?php echo $trenutna_vaja + 1; ?> od <?php echo $skupaj_vaj; ?></h2>

            <h1 id="ura">
            <?php
                $minute = floor($cas / 60);
                $sekunde = $cas % 60;

                if ($sekunde < 10) {
                    $sekunde = "0" . $sekunde;
                }

                echo $minute . ":" . $sekunde;
            ?>
            </h1>

            <?php
                if ($slika != "") {
                    echo "<img class='vaja-slika' src='$slika' alt='Slika vaje'>";
                }
            ?>

            <h2><?php echo $naslov; ?></h2>

            <p><?php echo $opis; ?></p>

            <div class="vaja-gumbi">
                <button type="button" id="start-btn" onclick="startVaja()">Začni vajo</button>
                <?php
                    if ($trenutna_vaja > 0) {
                        echo "<a href='vaja.php?id=$set_id&vaja=" . ($trenutna_vaja - 1) . "'>
                                <button type='button'>Nazaj</button>
                              </a>";
                    }

                    if ($trenutna_vaja < $skupaj_vaj - 1) {
                        echo "<a href='vaja.php?id=$set_id&vaja=" . ($trenutna_vaja + 1) . "'>
                                <button type='button'>Naprej</button>
                              </a>";
                    } else {
                        echo "<a href='nov_trening.php'>
                                <button type='button'>Zaključi trening</button>
                              </a>";
                    }
                ?>
            </div>

        </div>
    </main>

    <script>
    let cas = <?php echo $cas; ?>;
    let ura = document.getElementById("ura");
    let stevec;
    let zacelo = false;

    function startVaja() {
        if (zacelo == false) {
            zacelo = true;

            document.getElementById("start-btn").style.display = "none";

            stevec = setInterval(prikaziCas, 1000);
        }
    }

    function prikaziCas() {
        let minute = Math.floor(cas / 60);
        let sekunde = cas % 60;

        if (sekunde < 10) {
            sekunde = "0" + sekunde;
        }

        ura.innerHTML = minute + ":" + sekunde;

        if (cas > 0) {
            cas--;
        } else {
            ura.innerHTML = "Konec vaje";
            clearInterval(stevec);
        }
    }
</script>

</body>
</html>