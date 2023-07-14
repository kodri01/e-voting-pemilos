<?php
include_once "../library/inc.session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>


    <div class="container-fluid">
        <button type="button" style="background-color: #FFC0CB;" class="btn my-3" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#addnew">Tambah Kandidat</button>

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
        <table class="table table-striped table-hover table-responsive-sm">
            <thead>
                <td>NISN</td>
                <td>Nama Kandidat</td>
                <td>Kelas</td>
                <td>Motto</td>
                <td>Photo</td>
                <td>Action</td>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM candidates ORDER BY no_urut";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>$row[nis]</td>";
                        echo "<td>$row[name]</td>";
                        echo "<td>$row[class]</td>";
                        echo "<td>$row[motto]</td>";
                        echo "<td style='width: 100px;'><img src='../assets/img/$row[photo]' class='img-fluid img-rounded' alt='$row[photo]'></td>";
                        echo "<td>";
                        // echo "<a href='?nav=candidates&nis=$row[nis]' class='btn btn-warning btn-sm m-2'>Edit</a>";
                        // echo "<a href='candidatedel.php?nis=$row[nis]' class='btn btn-danger btn-sm m-2'>Delete</a>";

                        if ($_SESSION["akses"] == "admin") {

                            echo "<a href='?nav=candidates&nis=$row[nis]' class='btn btn-warning btn-sm m-2'>Edit</a>";
                            echo "<a href='candidatedel.php?nis=$row[nis]' class='btn btn-danger btn-sm m-2'>Delete</a>";
                        } else {

                            echo "<a href='?nav=candidates&nis=$row[nis]' class='btn btn-warning btn-sm m-2'>Edit</a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                }

                ?>
            </tbody>

        </table>
    </div>


    <?php
    if (isset($_GET["nis"])) {
        $edit = true;
        $nis = $name = $photo = $class = $motto = "";
        $query = "SELECT * FROM candidates WHERE nis = '$_GET[nis]'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $rows = mysqli_fetch_assoc($result);
            $no = $rows["no_urut"];
            $nis = $rows["nis"];
            $name = $rows["name"];
            $photo = $rows["photo"];
            $class = $rows["class"];
            $motto = $rows["motto"];
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
                            echo "Edit Kandidat";
                        else
                            echo "Tambah Kandidat";
                        ?>
                    </h4>
                    <?php
                    if ($edit)
                        echo "<a href='index.php?nav=candidates' class='close'>&times;</a>";
                    else
                        echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
                    ?>
                </div>
                <div class="modal-body">
                    <form action="<?php if ($edit) echo "candidateedit.php";
                                    else echo "candidatesv.php"; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="no">Nomor Urut:</label>
                            <input type="text" class="form-control" name="no" id="no" placeholder="Nomer Urut Kandidat" value="<?php if ($edit) echo $no;
                                                                                                                                else echo ""; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nis">NISN:</label>
                            <input type="text" class="form-control" name="nis" id="nis" placeholder="Nomor NISN Kandidat" value="<?php if ($edit) echo $nis;
                                                                                                                                    else echo ""; ?>" <?php if ($edit) echo "readonly"; ?>>
                        </div>
                        <label for="photo">Photo:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo" id="photo">
                            <label for="photo" class="custom-file-label">Choose photo</label>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Kandidat:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Kandidat" value="<?php if ($edit) echo $name;
                                                                                                                                else echo ""; ?>">
                        </div>
                        <div class="form-group">
                            <label for="class">Class:</label>
                            <input list="classlist" type="text" class="form-control" name="class" id="class" placeholder="Kelas" value="<?php if ($edit) echo $class;
                                                                                                                                        else echo ""; ?>">
                            <?php
                            $query = "SELECT DISTINCT class FROM participants";
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
                            <label for="motto">Motto:</label>
                            <input type="text" class="form-control" name="motto" id="motto" placeholder="Motto" value="<?php if ($edit) echo $motto;
                                                                                                                        else echo ""; ?>">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>