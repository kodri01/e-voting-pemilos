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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin E-Voting</title>

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
        <ul class="navbar-nav">

            <li class="nav-item"><a href="logout.php" class="nav-link ">LOGOUT</a></li>
        </ul>
    </div>

    <?php
    if (isset($_GET["vote"])) {
    ?>

        <center>
            <div class="alert alert-success rounded alert-dismissible fade show text-center w-50 my-2" role="alert">
                <strong><?php echo $_GET["name"]; ?></strong> Terima kasih telah melakukan Voting
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