<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.session.php";
if (isset($_GET["nav"])) {
    $nav = $_GET["nav"];
} else {
    $nav = "";
}

if ($nav == "") {
    $nav = "candidates"; // Atur halaman default di sini
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/img/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Admin E-Voting</title>

</head>

<body>

    <div class="navbar navbar-expand-lg navbar-light justify-content-between" style="background-color: #FFC0CB; ">
        <a href="index.php?nav=candidates" class="navbar-brand"><img src="../assets/img/2.png" class="rounded"
                alt="evoting" style="width: 50px; height:50px">
            E-Voting OSIS SMP 2
            Kota Jambi</a>
        <ul class="navbar-nav">
            <li class="nav-item <?php if ($nav == "candidates") echo "active"; ?>"><a href="?nav=candidates"
                    class="nav-link">CANDIDATES</a></li>
            <li class="nav-item <?php if ($nav == "voters") echo "active"; ?>"><a href="?nav=voters"
                    class="nav-link">VOTERS</a></li>
            <li class="nav-item <?php if ($nav == "results") echo "active"; ?>"><a href="?nav=results"
                    class="nav-link">RESULTS</a></li>
            <li class="nav-item <?php if ($nav == "about") echo "active"; ?>"><a href="?nav=about"
                    class="nav-link">TENTANG KAMI</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link ">LOGOUT</a></li>

        </ul>
    </div>



    <?php
    switch ($nav) {
        case "candidates":
            include_once "candidates.php";
            break;
        case "voters":
            include_once "voters.php";
            break;
        case "results":
            include_once "results.php";
            break;
        case "about":
            include_once "about.php";
            break;
    }
    ?>
    </div>

</body>
<footer class="footer">
    <h6 class="pt-4 text-muted text-center">Created by Universitas Dinamika Bangsa 2023</h6>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>



</html>