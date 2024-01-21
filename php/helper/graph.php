<!-- Sales statistics -->
<?php
require_once "../php/connect.php"; // for depolyment
// require_once "../connect.php"; // for testing

// TODO: make all statistics call into a single fetch query
$id_outlet = $_SESSION['outlet']['id'];
$query = mysqli_query($conn, "SELECT MONTH(tgl_bayar) FROM transaksi WHERE status='selesai' AND YEAR(tgl_bayar)=date('Y') AND id_outlet = $id_outlet;");
$result = mysqli_fetch_all($query);

$data = [];
foreach ($result as $key => $value) {
    array_push($data, $value[0]);
}

?>
<script>
    (async function() {
        const data = [{
                months: "January",
                count: <?= (!isset(array_count_values($data)[1])) ? 0 : array_count_values($data)[1]; ?>
            },
            {
                months: "February",
                count: <?= (!isset(array_count_values($data)[2])) ? 0 : array_count_values($data)[2]; ?>
            },
            {
                months: "March",
                count: <?= (!isset(array_count_values($data)[3])) ? 0 : array_count_values($data)[3]; ?>
            },
            {
                months: "April",
                count: <?= (!isset(array_count_values($data)[4])) ? 0 : array_count_values($data)[4]; ?>
            },
            {
                months: "May",
                count: <?= (!isset(array_count_values($data)[5])) ? 0 : array_count_values($data)[5]; ?>
            },
            {
                months: "June",
                count: <?= (!isset(array_count_values($data)[6])) ? 0 : array_count_values($data)[1]; ?>
            },
            {
                months: "July",
                count: <?= (!isset(array_count_values($data)[7])) ? 0 : array_count_values($data)[7]; ?>
            },
            {
                months: "August",
                count: <?= (!isset(array_count_values($data)[8])) ? 0 : array_count_values($data)[8]; ?>
            },
            {
                months: "September",
                count: <?= (!isset(array_count_values($data)[9])) ? 0 : array_count_values($data)[9]; ?>
            },
            {
                months: "October",
                count: <?= (!isset(array_count_values($data)[10])) ? 0 : array_count_values($data)[1]; ?>
            },
            {
                months: "November",
                count: <?= (!isset(array_count_values($data)[11])) ? 0 : array_count_values($data)[1]; ?>
            },
            {
                months: "December",
                count: <?= (!isset(array_count_values($data)[12])) ? 0 : array_count_values($data)[1]; ?>
            },
        ];

        new Chart(
            document.getElementById('sales'), {
                type: 'bar',
                data: {
                    labels: data.map(row => row.months),
                    datasets: [{
                        label: 'Sales',
                        data: data.map(row => row.count)
                    }]
                },
                options: {
                    enabled: false
                },
            }
        );
    })();
</script>

<!-- Order statistics -->
<?php
$query = mysqli_query($conn, "SELECT status FROM transaksi WHERE YEAR(tgl_bayar)=date('Y') AND id_outlet = $id_outlet;");
$result = mysqli_fetch_all($query);

$data = [];
foreach ($result as $key => $value) {
    array_push($data, $value[0]);
}
?>
<script>
    (async function() {
        const data = [{
                status: "Baru",
                count: <?= (!isset(array_count_values($data)["baru"])) ? 0 : array_count_values($data)["baru"]; ?>
            },
            {
                status: "Proses",
                count: <?= (!isset(array_count_values($data)["proses"])) ? 0 : array_count_values($data)["proses"]; ?>
            },
            {
                status: "Selesai",
                count: <?= (!isset(array_count_values($data)["selesai"])) ? 0 : array_count_values($data)["selesai"]; ?>
            },
            {
                status: "Diambil",
                count: <?= (!isset(array_count_values($data)["diambil"])) ? 0 : array_count_values($data)["diambil"]; ?>
            },
        ];

        new Chart(
            document.getElementById('order'), {
                type: 'doughnut',
                data: {
                    labels: data.map(row => row.status),
                    datasets: [{
                        label: 'order',
                        data: data.map(row => row.count)
                    }]
                },
            }
        );
    })();
</script>