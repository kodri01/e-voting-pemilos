<?php
// Periksa apakah pengguna telah login dengan mengecek session
if (isset($_SESSION["votername"])) {
    // Akses data dari session
    $name = $_SESSION["votername"];
    // Selain mencetak, Anda bisa melakukan operasi lain sesuai kebutuhan aplikasi Anda
} else {
    // Jika pengguna belum login, Anda bisa mengarahkan mereka kembali ke halaman login
    header("location:index.php");
}


?>

<center>
    <div class="card text-white bg-success my-2 " style="max-width: 50%;">
        <div class="card-body">
            <h3 class="card-title"><?= $name ?>, Kamu Sudah Berpartisipasi Dalam <br>Pemilihan <strong>Ketua
                    OSIS
                    SMP Negeri 2 Kota Jambi</strong></h3>
        </div>
    </div>
</center>