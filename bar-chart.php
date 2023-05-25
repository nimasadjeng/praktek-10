<?php
include('koneksi.php');

// Ambil data dari database untuk 10 negara
$label = mysqli_query($koneksi, "SELECT * FROM tb_covid19 LIMIT 10");

// Inisialisasi array untuk menyimpan data
$negara = array();
$total_cases = array();
$totaldeath = array();
$total_recover = array();
$active_cases = array();
$total_tests = array();

// Looping untuk mengambil data dari setiap negara
while ($row = mysqli_fetch_array($label)) {
    $negara[] = $row['negara'];
    $total_cases[] = $row['total_cases'];
    $totaldeath[] = $row['totaldeath'];
    $total_recover[] = $row['total_recover'];
    $active_cases[] = $row['active_cases'];
    $total_tests[] = $row['total_tests'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Grafik Covid - Bar Chart</title>
    <script type="text/javascript" src="Chart.js"></script>
</head>

<body>
    <div style="width: 1000px;height: 1000px">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [{
                        label: 'Total Cases',
                        data: <?php echo json_encode($total_cases); ?>,
                        borderWidth: 1,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)'
                    },
                    {
                        label: 'Total Death',
                        data: <?php echo json_encode($totaldeath); ?>,
                        borderWidth: 1,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)'
                    },
                    {
                        label: 'Total Recovered',
                        data: <?php echo json_encode($total_recover); ?>,
                        borderWidth: 1,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)'
                    },
                    {
                        label: 'Active Cases',
                        data: <?php echo json_encode($active_cases); ?>,
                        borderWidth: 1,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)'
                    },
                    {
                        label: 'Total Tests',
                        data: <?php echo json_encode($total_tests); ?>,
                        borderWidth: 1,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)'
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>
