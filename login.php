<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="assets/img/2.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>E-Voting</title>
</head>

<body>

    <div class="row container-fluid" style="margin-top:10rem">
        <div class="col-6">
            <img src="assets/img/evoting.png" class="rounded mx-auto d-block" alt="evoting"
                style="width: auto; height:500px">
        </div>
        <div class="col-6">
            <h1 class="text-center">E-Voting SMPN 2</h1>
            <div class="cards mx-auto" style="max-width: 450px">
                <div class="card-body">
                    <form action="loginsv.php" method="post">
                        <h5 class="text-center font-weight-light pb-3">Login terlebih
                            dahulu untuk Voting</h5>
                        <?php
                        if (isset($_GET["login"])) {
                            if ($_GET["login"] == "voted") {
                        ?>
                        <div class="alert alert-danger alert-dismissible mx-auto" style="max-width: 450px">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Anda sudah memilih, tidak dapat login kembali.
                        </div>
                        <?php
                            } elseif ($_GET["login"] == "salah") {
                            ?>
                        <div class="alert alert-danger alert-dismissible mx-auto" style="max-width: 450px">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Nomor NIK Anda tidak terdaftar
                        </div>
                        <?php
                            }
                        }
                        ?>
                        <?php
                        if (isset($_GET["vote"])) {
                        ?>
                        <div class="alert alert-success alert-dismissible" style="max-width: 450px">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><?php echo $_GET["name"]; ?></strong> Terima kasih telah melakukan Voting : )
                        </div>
                        <?php
                        }
                        ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nis" id="floatingInput"
                                placeholder="Masukan nomor NISN">
                            <label for="floatingInput">Nomor NISN</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="tgl" id="floatingInput"
                                placeholder="Tanggal Lahir">
                            <label for="floatingInput">Tanggal Lahir</label>
                        </div>

                        <button type="submit" class="btn btn-block text-white"
                            style="background-color: #1A00FF;">Login</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="">
        <div>
        </div>


    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</html>