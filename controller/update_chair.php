<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../model/database.php');
require('../model/flight_list_db.php');

if (isset($_POST['flight_code']) && isset($_POST['chair_type']) && isset($_POST['chair_numbers']) && isset($_POST['status'])) {
    $flightCode = $_POST['flight_code'];
    $chairType = $_POST['chair_type'];
    $status = $_POST['status'];
    $chairNumbers = explode(',', $_POST['chair_numbers']);

    foreach ($chairNumbers as $chairNumber) {
        if (!setReserve($db, $status, $flightCode, $chairType, $chairNumber)) {
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi cập nhật ghế: ' . $chairNumber]);
            exit;
        }
    }
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
