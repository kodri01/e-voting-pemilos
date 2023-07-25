<?php
session_start();

// Periksa apakah pengguna telah login dengan mengecek session
if (isset($_SESSION["votername"]) && isset($_SESSION["state"])) {
    // Akses data dari session
    $name = $_SESSION["votername"];
    $state = $_SESSION["state"];
    // Selain mencetak, Anda bisa melakukan operasi lain sesuai kebutuhan aplikasi Anda
} else {
    // Jika pengguna belum login, Anda bisa mengarahkan mereka kembali ke halaman login
    header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <?php if ($state == 0) {
    ?>
    <div class="container">
        <h1 class="text-center my-3">Silahkan Pilih Kandidat di bawah ini </h1>
        <div class="row">
            <?php
                $query = "SELECT * FROM candidates";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-12 col-sm-6 col-md-4 col-lg-4 pt-3'>";
                        echo "<div class='card'>";
                        echo "<img src='assets/img/$row[photo]' alt='$row[name]' class='card-img-top image-fluid' style='height:300px'>";
                        echo "<div class='card-body'>";
                        echo "<h4 class='card-title text-center'>$row[name]</h4>";
                        echo "<p class='card-text'>";
                        echo "<table class='table-borderless'>";
                        echo "<tr>";
                        echo "<td><b>Kelas</b></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>$row[class]</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td><b>Motto</b></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>$row[motto]</td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</p>";
                        echo "<a href='vote.php?nis=$row[nis]' class='btn btn-lg btn-primary btn-block'>Nomor Urut $row[no_urut]</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                ?>
        </div>
        <br>
    </div>
    <?php
    } else {
    ?>
    <center>
        <div class="card text-white bg-success my-2 " style="max-width: 75%;">
            <div class="card-body">
                <h3 class="card-title">Terima Kasih <?= $name ?>,<br> Kamu sudah berpartisipasi dalam pemilihan Ketua
                    OSIS
                    SMP Negeri 2 Kota Jambi</h3>
            </div>
        </div>
    </center>
    <?php
    } ?>




</body>

</html>