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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Admin E-Voting</title>

</head>

<body>

    <div class="navbar navbar-expand-lg navbar-light justify-content-between" style="background-color: #FFC0CB; ">
        <a href="index.php?nav=candidates" class="navbar-brand"><img src="../assets/img/2.png" class="rounded" alt="evoting" style="width: 50px; height:50px">
            E-Voting OSIS SMP 2
            Kota Jambi</a>
        <ul class="navbar-nav" style="margin-right: 5rem;">
            <li class="nav-item <?php if ($nav == "candidates") echo "active"; ?>"><a href="?nav=candidates" class="nav-link">CANDIDATES</a></li>
            <li class="nav-item <?php if ($nav == "voters") echo "active"; ?>"><a href="?nav=voters" class="nav-link">VOTERS</a></li>
            <li class="nav-item <?php if ($nav == "results") echo "active"; ?>"><a href="?nav=results" class="nav-link">RESULTS</a></li>
            <li class="nav-item <?php if ($nav == "about") echo "active"; ?>"><a href="?nav=about" class="nav-link">TENTANG KAMI</a></li>
            <li class="nav-item dropdown">
                <div class="d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-1" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z">
                        </path>
                        <path d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z">
                        </path>
                    </svg>
                    <a href="" class="nav-link logout dropdown-toggle text-uppercase"><?php echo $_SESSION["username"] = $username; ?></a>
                </div>
                <ul class="dropdown-menu ">
                    <li><a class="dropdown-item " href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                <path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path>
                                <path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z">
                                </path>
                            </svg> Logout</a></li>
                </ul>
            </li>

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
    <h6 class="pt-4 text-muted text-center">Created by Peri 2023</h6>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

<script>
    // Ambil elemen tombol Logout
    var logoutButton = document.querySelector('.nav-link.logout');

    // Tambahkan event listener untuk mengatur tampilan dropdown saat tombol Logout diklik
    logoutButton.addEventListener('click', function(event) {
        // Hentikan aksi default dari tombol Logout
        event.preventDefault();

        // Toggle class "show" pada dropdown menu
        var dropdownMenu = document.querySelector('.dropdown-menu');
        dropdownMenu.classList.toggle('show');
    });

    // Tambahkan event listener untuk menyembunyikan dropdown saat mengklik di luar dropdown
    document.addEventListener('click', function(event) {
        // Periksa apakah elemen yang diklik bukan dropdown atau tombol Logout
        var targetElement = event.target;
        if (!targetElement.classList.contains('dropdown-toggle') && !targetElement.classList.contains('logout')) {
            // Sembunyikan dropdown jika elemen yang diklik bukan dropdown atau tombol Logout
            var dropdownMenu = document.querySelector('.dropdown-menu');
            dropdownMenu.classList.remove('show');
        }
    });
</script>



</html>