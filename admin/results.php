<?php
include_once "../library/inc.session.php";
$query_sum = "SELECT SUM(counts) AS total_votes FROM candidates";
$result_sum = mysqli_query($conn, $query_sum);
$row_sum = mysqli_fetch_assoc($result_sum);
$sum = isset($row_sum['total_votes']) ? (int) $row_sum['total_votes'] : 0;

// Calculate the total number of voters
$query_voters = "SELECT COUNT(*) FROM participants";
$result_voters = mysqli_query($conn, $query_voters);
$row_voters = mysqli_fetch_array($result_voters);
$allVoters = isset($row_voters[0]) ? (int) $row_voters[0] : 0;
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
        $query_candidates = "SELECT name, counts FROM candidates ORDER BY no_urut ASC";
        $result_candidates = mysqli_query($conn, $query_candidates);
        $data = array();

        while ($row = mysqli_fetch_assoc($result_candidates)) {
            $percent = ($sum != 0) ? round(($row["counts"] / $sum) * 100) : 0;
            $data[] = array("name" => $row["name"], "counts" => $row["counts"], "percent" => $percent);
        }

        foreach ($data as $row) {
            echo "<tr>";
            echo "<td><strong>{$row["name"]} </strong></td>";
            echo "<td>: {$row["counts"]} ({$row["percent"]}%) </td>";
            echo "</tr>";
        }

        if ($allVoters != 0) {
            echo "<tr>";
            echo "<td><strong>Voted</strong></td>";
            echo "<td>: $sum (" . round(($sum / $allVoters) * 100) . "%) from $allVoters Voters</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td><strong>Have not voted</strong></td>";
            echo "<td>: " . ($allVoters - $sum) . " (" . round(($allVoters - $sum) / $allVoters * 100) . "%)</td>";
            echo "</tr>";
        } else {
            echo "<tr>";
            echo "<td><strong>Voted</strong></td>";
            echo "<td>: 0 (0%) from 0 Voters</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td><strong>Have not voted</strong></td>";
            echo "<td>: 0 (0%)</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>