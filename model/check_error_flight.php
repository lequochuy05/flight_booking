<?php
require '../model/database.php';
if (isset($_POST['flight_code'])) {
    $flight_code = $_POST['flight_code'];

    if (strpos($flight_code, 'FL') !== 0) {
        echo "Mã chuyến bay phải bắt đầu bằng 'FL'.";
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM flight_info WHERE flight_code = :flight_code");
    $stmt->bindParam(':flight_code', $flight_code);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Mã chuyến bay đã tồn tại.";
    } else {
        echo "Mã chuyến bay hợp lệ.";
    }
}
if (isset($_POST['departure_city']) && isset($_POST['departure_date']) && isset($_POST['departure_time'])) {
    $deaprture_city = $_POST['departure_city'];
    $departure_date = $_POST['departure_date'];
    $departure_time = $_POST['departure_time'];

    $stmt = $db->prepare("SELECT COUNT(*) FROM flight_info WHERE departure_city = :departure_city AND flight_date = :departure_date AND departure_time = :departure_time");
    $stmt->bindParam(':departure_city', $deaprture_city);
    $stmt->bindParam(':departure_date', $departure_date);
    $stmt->bindParam(':departure_time', $departure_time);
    $stmt->execute();

    if ($stmt->fetchColumn() >= 2) {
        echo "Đã có quá 2 chuyến bay cất cánh vào thời gian này.";
    } else {
        echo "Thời gian hợp lệ.";
    }
}
if (isset($_POST['arrival_city']) && isset($_POST['departure_date']) && isset($_POST['arrival_time'])) {
    $arrival_city = $_POST['arrival_city'];
    $departure_date = $_POST['departure_date'];
    $arrival_time = $_POST['arrival_time'];

    $stmt = $db->prepare("SELECT COUNT(*) FROM flight_info WHERE arrival_city = :arrival_city AND flight_date = :departure_date AND arrival_time = :arrival_time");
    $stmt->bindParam(':arrival_city', $arrival_city);
    $stmt->bindParam(':departure_date', $departure_date);
    $stmt->bindParam(':arrival_time', $arrival_time);
    $stmt->execute();

    if ($stmt->fetchColumn() >= 2) {
        echo "Đã có quá 2 chuyến bay hạ cánh vào thời gian này.";
    } else {
        echo "Thời gian hợp lệ.";
    }
}
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $stmt = $db->prepare("SELECT COUNT(*) FROM account_user WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->fetchColumn() > 0) {
        echo "Username đã tồn tại.";
    } else {
        echo "";
    }
}
?>