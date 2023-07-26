<?php
include_once "library/inc.sessionvoter.php";

if (isset($_GET["nis"])) {
    // Perbarui state pada tabel participants menjadi '1' berdasarkan nilai voternis di session
    $query = "UPDATE participants SET state='1' WHERE nis = $_SESSION[voternis]";
    if (mysqli_query($conn, $query)) {
        // Ambil nilai state terbaru dari tabel participants setelah diperbarui
        $query = "SELECT state FROM participants WHERE nis = $_SESSION[voternis]";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $state = $row['state'];

        // Perbarui counts pada tabel candidates dengan menambahkan 1 berdasarkan nis yang diambil dari parameter GET
        $query = "UPDATE candidates SET counts = (counts + 1) WHERE nis = '$_GET[nis]'";
        if (mysqli_query($conn, $query)) {
            // Perbarui nilai state di session dengan nilai terbaru dari database
            $_SESSION["state"] = $state;
            header("location:beranda.php?vote=berhasil&name=$_SESSION[votername]");
        } else {
            // Jika gagal memperbarui counts pada tabel candidates, kembalikan state pada tabel participants menjadi '0'
            $query = "UPDATE participants SET state='0' WHERE nis = $_SESSION[voternis]";
            mysqli_query($conn, $query);
            header("location:beranda.php?vote=gagal");
        }
    } else {
        header("location:index.php");
    }
} else {
    header("location:index.php");
}
