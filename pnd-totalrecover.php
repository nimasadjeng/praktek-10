<?php
// Koneksi ke database
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
    <title>Grafik Covid - Pie and Doughnut Chart</title>
    <script type="text/javascript" src="Chart.js"></script>
</head>

<body>
    <div style="width: 800px;height: 800px">
        <canvas id="pieChart"></canvas>
    </div>
  
    <div style="width: 800px;height: 800px">
        <canvas id="doughnutChart"></canvas>
    </div>

    <script>
        var ctxPie = document.getElementById("pieChart").getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [{
                    data: <?php echo json_encode($total_recover); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right'
                }
            }
        });
      
        var ctxDoughnut = document.getElementById("doughnutChart").getContext('2d');
        var doughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($negara); ?>,
                datasets: [{
                    data: <?php echo json_encode($total_recover); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right'
                }
            }
        });
    </script>
</body>

</html>
