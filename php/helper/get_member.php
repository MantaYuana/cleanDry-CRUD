<?php
require_once "../connect.php";

$search_term = !empty($_GET['search']) ? $_GET['search'] : '';
$query = mysqli_query($conn, "SELECT id, nama FROM member WHERE id LIKE '%" . $search_term . "%' OR nama LIKE '%" . $search_term . "%';");

$memberData = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data['id'] = $row['id'];
    $data['text'] = $row['nama'];
    array_push($memberData, $data);
}

echo json_encode($memberData);
