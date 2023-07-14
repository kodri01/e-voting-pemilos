<?php
include_once "../library/inc.session.php";
// if ($_SESSION["usersmecon"] != "admin") {
//     exit();
// }
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<div id="chart" style="min-width: 310px; height: 400px; margin: 0 auto" class="mt-3"></div>
<script type="text/javascript">
// Create the chart
Highcharts.chart('chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Hasil Pemilihan E-Voting OSIS SMPN 2 Kota Jambi'
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
            <td>: <?php echo ($allVoters - $sum) . " (" . round(($allVoters - $sum) / $allVoters * 100) . "%)"; ?></td>
        </tr>
    </table>
</div>