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