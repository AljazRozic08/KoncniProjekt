<?php
    include 'conn.php';
    session_start();
    $id=$_SESSION['id'];
    $sql= "SELECT * FROM set_treningov ";

    $result=mysqli_query($conn,$sql);
?>



<html lang="sl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Set treningov</title>

    
    <link rel="stylesheet" href="stil.css">

</head>
<body class="pregled-body">

    
<?php include 'nav.php'; ?>


    

    <main class="pregled-main">
    <table>
        <tr>
            <th>naslov</th>
            <th>opis</th>
            <th>treniraj</th>
        </tr>

        <?php 
        if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                        echo "<td class='navbtn'>" . $row['naslov'] . "</td>";
                        echo "<td class='navbtn'>" . $row['opis'] . "</td>";
                        echo "<td><a href='vaja.php?id=".$row['id']."&vaja=0'>
                        <button type='button'>treniraj</button></a></td>";
                        echo "</tr>";
                    }
            }
    ?>
</table>

    </main>

</body>
</html>