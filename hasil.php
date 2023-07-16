<?php
include_once "library/inc.connection.php";

$query = "SELECT name, counts FROM candidates ORDER BY no_urut ASC";
$result = mysqli_query($conn, $query);
$sum = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sum += $row["counts"];
    }
}
$query = "SELECT COUNT(*) FROM participants";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    if ($row = mysqli_fetch_array($result)) {
        $allVoters = $row[0];
    }
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
    <title>Beranda E-Voting</title>

</head>

<body>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <div class="navbar navbar-expand-lg navbar-light justify-content-between" style="background-color: #FFC0CB; ">
        <a href="index.php?nav=candidates" class="navbar-brand"><img src="assets/img/2.png" class="rounded" alt="evoting" style="width: 50px; height:50px">
            E-Voting OSIS SMP 2
            Kota Jambi</a>
        <ul class="navbar-nav" style="margin-right: 5rem;">
            <?php
            if (isset($_GET["login"]) || (isset($_GET["vote"]))) {
            ?>

                <li class="nav-item dropdown">
                    <div class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-1" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z">
                            </path>
                            <path d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z">
                            </path>
                        </svg>
                        <a href="" class="nav-link logout dropdown-toggle text-uppercase"><?php echo $_GET["name"]; ?></a>
                    </div>
                    <ul class="dropdown-menu ">
                        <li><a class="dropdown-item " href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path>
                                    <path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z">
                                    </path>
                                </svg> Logout</a></li>
                    </ul>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

    <?php
    if (isset($_GET["vote"])) {
    ?>

        <center>
            <div class="alert alert-success rounded alert-dismissible fade show text-center w-50 my-2" role="alert">
                Terima kasih <strong><?php echo $_GET["name"]; ?></strong>, Kamu sudah melakukan Voting
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </center>


    <?php
    }
    ?>

    <div id="chart" style="min-width: 310px; height: 400px; margin: 0 auto" class="mt-3"></div>
    <script type="text/javascript">
        // Create the chart
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Hasil Sementara E-Voting OSIS SMPN 2 Kota Jambi'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Jumlah Pemilih'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.d:.1f}%'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> votes<br/>'
            },

            "series": [{
                "name": "Candidates",
                "colorByPoint": true,
                "data": [
                    <?php
                    if ($sum != 0) {
                        $query = "SELECT name, counts FROM candidates ORDER BY no_urut ASC";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($i == 0) {
                                    echo "{";
                                } else {
                                    echo ", {";
                                }
                                echo "'name': '$row[name]',";
                                $percent = ($row["counts"] / $sum) * 100;
                                echo "'y': $row[counts],";
                                echo "'d': $percent";
                                echo "}";
                                $i++;
                            }
                        }
                    }
                    ?>
                ]
            }]
        });
    </script>
    <div class="alert alert-secondary">
        <table>
            <?php
            mysqli_data_seek($result, 0); // Kembalikan penunjuk hasil query ke posisi awal
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><strong>{$row["name"]} </strong></td>";
                $percent = round(($row["counts"] / $sum) * 100);
                echo "<td>: {$row["counts"]} ($percent%) </td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td><strong>Voted</strong></td>
                <td>: <?php echo "$sum (" . round(($sum / $allVoters) * 100) . "%)"; ?> from
                    <?php echo "$allVoters Voters"; ?></td>
            </tr>
            <tr>
                <td><strong>Have not voted</strong></td>
                <td>: <?php echo ($allVoters - $sum) . " (" . round(($allVoters - $sum) / $allVoters * 100) . "%)"; ?>
                </td>
            </tr>
        </table>
    </div>

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
            if (!targetElement.classList.contains('dropdown-toggle') && !targetElement.classList.contains(
                    'logout')) {
                // Sembunyikan dropdown jika elemen yang diklik bukan dropdown atau tombol Logout
                var dropdownMenu = document.querySelector('.dropdown-menu');
                dropdownMenu.classList.remove('show');
            }
        });
    </script>