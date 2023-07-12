<?php
include_once "../library/inc.session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-2">
                <button type="button" class="btn" style="background-color: #FFC0CB;" data-toggle="modal"
                    data-target="#addnew" data-keyboard="false" data-backdrop="static">Tambah Voters</button>
            </div>
            <div class="col-sm-10">
                <form style="margin-left:39.3rem">
                    <div class="form-group">
                        <input list="classlist" type="text" class="form-control" id="search"
                            placeholder="Search Nama Voter">
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (isset($_GET["act"]) && isset($_GET["stats"])) {
            if ($_GET["stats"] == "Berhasil")
                echo "<div class='alert alert-success alert-dismissible'>";
            else
                echo "<div class='alert alert-danger alert-dismissible'>";
            echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
            if ($_GET["stats"] == "Berhasil")
                echo "<strong>$_GET[act] Berhasil</strong>";
            else
                echo "<strong>$_GET[act] Gagal</strong>, Silahkan coba kembali";
            echo "</div>";
        }
        ?>

        <table class="table table-striped table-hover table-responsive-sm" id="voters">
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Vote</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM participants ORDER BY class ASC";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>$row[nis]</td>";
                        echo "<td>$row[name]</td>";
                        echo "<td>$row[tgl]</td>";
                        echo "<td>$row[class]</td>";
                        if ($row["state"] == 0)
                            echo "<td class='bg-danger'>";
                        else
                            echo "<td class='bg-success'>";
                        echo "<td>";
                        echo "<a href='?nav=voters&nis=$row[nis]' class='btn btn-success btn-sm m-2'>Edit</a>";
                        echo "<a href='voterdel.php?nis=$row[nis]' class='btn btn-danger btn-sm m-2'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>

        </table>
        <div class="">
            <h5>Keterangan:</h5>
            <label>Vote : <span class="badge  bg-success">Sudah Voting</span></label><br>
            <label>Vote : <span class="badge  bg-danger">Belum Voting</span></,>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#voters tbody>tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
    <?php
    if (isset($_GET["nis"])) {
        $edit = true;
        $nis = $name = $class = "";
        $query = "SELECT * FROM participants WHERE nis = '$_GET[nis]'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $rows = mysqli_fetch_assoc($result);
            $nis = $rows["nis"];
            $name = $rows["name"];
            $tgl = $rows["tgl"];
            $class = $rows["class"];
        }
    } else
        $edit = false;
    ?>

    <div class="modal" id="addnew">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>
                        <?php
                        if ($edit)
                            echo "Edit";
                        else
                            echo "Tambah Voter";
                        ?>
                    </h4>
                    <?php
                    if ($edit)
                        echo "<a href='index.php?nav=voters' class='close'>&times;</a>";
                    else
                        echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
                    ?>
                </div>
                <div class="modal-body">
                    <form action="<?php if ($edit) echo "voteredit.php";
                                    else echo "votersv.php"; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nis">NISN:</label>
                            <input type="text" class="form-control" name="nis" id="nis" placeholder="Nomor NISN Voter"
                                value="<?php if ($edit) echo $nis;
                                                                                                                                else echo ""; ?>"
                                <?php if ($edit) echo "readonly"; ?>>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Lengkap:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap"
                                value="<?php if ($edit) echo $name;
                                                                                                                            else echo ""; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl">Tanggal Lahir:</label>
                            <input type="date" class="form-control" name="tgl" id="tgl" value="<?php if ($edit) echo $tgl;
                                                                                                else echo ""; ?>">
                        </div>
                        <div class="form-group">
                            <label for="class">Kelas:</label>
                            <input list="classlist" type="text" class="form-control" name="class" id="class"
                                placeholder="Kelas"
                                value="<?php if ($edit) echo $class;
                                                                                                                                        else echo ""; ?>">
                            <?php
                            $query = "SELECT DISTINCT class FROM participants ORDER BY class ASC";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                echo "<datalist id='classlist'>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='$row[0]'>";
                                }
                                echo "</datalist>";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                <?php if ($edit) echo "Update";
                                else echo "Tambahkan"; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($edit) {
        echo "<script type='text/javascript'>";
        echo "$('#addnew').modal ({backdrop: 'static', keyboard: false});";
        echo "$('#addnew').modal('show');";
        echo "</script>";
    }
    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>