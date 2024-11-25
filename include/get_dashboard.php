<?php
include('db.php');  // Koneksi ke database

header('Content-Type: application/json');

// Tanggal hari ini
$today = date('Y-m-d');
$tomorrow = date('Y-m-d', strtotime('+1 day'));

// Query untuk mencari total data pickup yang sudah lewat dari hari ini namun belum di pickup
$sql_past_due = "SELECT COUNT(*) as total_past_due 
                 FROM delivery 
                 WHERE pickup_date < '$today' AND (total_income IS NULL OR total_income = 0)";

$result_past_due = mysqli_query($koneksi, $sql_past_due);
$total_past_due = mysqli_fetch_assoc($result_past_due)['total_past_due'];

// Query untuk mencari total data pickup hari ini
$sql_today = "SELECT COUNT(*) as total_today 
              FROM delivery 
              WHERE pickup_date = '$today'";

$result_today = mysqli_query($koneksi, $sql_today);
$total_today = mysqli_fetch_assoc($result_today)['total_today'];

// Query untuk mencari total data pickup besok
$sql_tomorrow = "SELECT COUNT(*) as total_tomorrow 
                 FROM delivery 
                 WHERE pickup_date = '$tomorrow'";

$result_tomorrow = mysqli_query($koneksi, $sql_tomorrow);
$total_tomorrow = mysqli_fetch_assoc($result_tomorrow)['total_tomorrow'];

// Mengembalikan data dalam format JSON
echo json_encode([
    'total_past_due' => $total_past_due,
    'total_today' => $total_today,
    'total_tomorrow' => $total_tomorrow
]);
?>