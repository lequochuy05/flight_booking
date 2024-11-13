<?php
require('../model/database.php');
require('../model/admin.php');
$flight_code = isset($_POST['flight_code']) ? $_POST['flight_code'] : '';
$deaprture_str = isset($_POST['departure_city']) ? $_POST['departure_city'] : '';
list($deaprture_city, $departure_cityName) = !empty($deaprture_str) ? explode(' ', $deaprture_str, 2) : ['', ''];
$arrival_str = isset($_POST['arrival_city']) ? $_POST['arrival_city'] : '';
list($arrival_city, $arrival_cityName) = !empty($arrival_str) ? explode(' ', $arrival_str, 2) : ['', ''];
$deaprture_date = isset($_POST['departure_date']) ? $_POST['departure_date'] : '';
$deaprture_time = isset($_POST['departure_time']) ? $_POST['departure_time'] : '';
$arrival_time = isset($_POST['arrival_time']) ? $_POST['arrival_time'] : '';
$time = isset($_POST['time']) ? $_POST['time'] : '';
$airline = isset($_POST['airline']) ? $_POST['airline'] : '';
$aircraft = isset($_POST['aircraft']) ? $_POST['aircraft'] : '';

$business_Adult = isset($_POST['business_Adult']) ? $_POST['business_Adult'] : '';
$prenium_Adult = isset($_POST['prenium_Adult']) ? $_POST['prenium_Adult'] : '';
$Economy_Adult = isset($_POST['Economy_Adult']) ? $_POST['Economy_Adult'] : '';
$business_Child = isset($_POST['business_Child']) ? $_POST['business_Child'] : '';
$prenium_Child = isset($_POST['prenium_Child']) ? $_POST['prenium_Child'] : '';
$Economy_Child = isset($_POST['Economy_Child']) ? $_POST['Economy_Child'] : '';
$business_infant = isset($_POST['business_infant']) ? $_POST['business_infant'] : '';
$prenium_infant = isset($_POST['prenium_infant']) ? $_POST['prenium_infant'] : '';
$Economy_infant = isset($_POST['Economy_infant']) ? $_POST['Economy_infant'] : '';

if ($aircraft == 'A321') {
    for ($i = 1; $i <= 2; $i++) {
        addFlight2($db, $flight_code, $airline, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
    }
    for ($i = 1; $i <= 30; $i++) {
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
    }

    addFlight2($db, $flight_code, $airline, 'Economy Class', 'A31', $Economy_Adult, $Economy_Child, $Economy_infant);
    addFlight2($db, $flight_code, $airline, 'Economy Class', 'B31', $Economy_Adult, $Economy_Child, $Economy_infant);
    addFlight2($db, $flight_code, $airline, 'Economy Class', 'C31', $Economy_Adult, $Economy_Child, $Economy_infant);
    addFlight2($db, $flight_code, $airline, 'Economy Class', 'D31', $Economy_Adult, $Economy_Child, $Economy_infant);

    addFlight1($db, $flight_code, $deaprture_city, $departure_cityName, $arrival_city, $arrival_cityName, $deaprture_time, $arrival_time, $time, $deaprture_date, $aircraft);
} else if ($aircraft == 'A320') {
    for ($i = 1; $i <= 2; $i++) {
        addFlight2($db, $flight_code, $airline, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
    }
    for ($i = 1; $i <= 27; $i++) {
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
    }

    addFlight1($db, $flight_code, $deaprture_city, $departure_cityName, $arrival_city, $arrival_cityName, $deaprture_time, $arrival_time, $time, $deaprture_date, $aircraft);
} else if ($aircraft == 'Boeing737') {
    for ($i = 1; $i <= 33; $i++) {
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
    }

    addFlight2($db, $flight_code, $airline, 'Economy Class', 'A34', $Economy_Adult, $Economy_Child, $Economy_infant);
    addFlight2($db, $flight_code, $airline, 'Economy Class', 'B34', $Economy_Adult, $Economy_Child, $Economy_infant);

    addFlight1($db, $flight_code, $deaprture_city, $departure_cityName, $arrival_city, $arrival_cityName, $deaprture_time, $arrival_time, $time, $deaprture_date, $aircraft);
} else if ($aircraft == 'Boeing787') {
    for ($i = 1; $i <= 7; $i++) {
        addFlight2($db, $flight_code, $airline, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
    }

    for ($i = 1; $i <= 5; $i++) {
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'A'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'B'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'C'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'D'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'E'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'F'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
    }
    addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'A6', $prenium_Adult, $prenium_Child, $prenium_infant);
    addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'B6', $prenium_Adult, $prenium_Child, $prenium_infant);
    addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'C6', $prenium_Adult, $prenium_Child, $prenium_infant);
    addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'D6', $prenium_Adult, $prenium_Child, $prenium_infant);
    addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'E6', $prenium_Adult, $prenium_Child, $prenium_infant);

    for ($i = 1; $i <= 35; $i++) {
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
    }
    addFlight2($db, $flight_code, $airline, 'Economy Class', 'I36', $Economy_Adult, $Economy_Child, $Economy_infant);
    
    addFlight1($db, $flight_code, $deaprture_city, $departure_cityName, $arrival_city, $arrival_cityName, $deaprture_time, $arrival_time, $time, $deaprture_date, $aircraft);
} else if ($aircraft == 'A350') {
    for ($i = 1; $i <= 7; $i++) {
        addFlight2($db, $flight_code, $airline, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
    }
    addFlight2($db, $flight_code, $airline, 'Business Class', 'A8', $business_Adult, $business_Child, $business_infant);

    for ($i = 1; $i <= 7; $i++) {
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'A'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'B'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'C'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'D'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'E'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'F'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
    }
    addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'A8', $prenium_Adult, $prenium_Child, $prenium_infant);
    addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'B8', $prenium_Adult, $prenium_Child, $prenium_infant);
    addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'C8', $prenium_Adult, $prenium_Child, $prenium_infant);

    for ($i = 1; $i <= 38; $i++) {
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'A'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'B'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'C'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'D'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'E'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
        addFlight2($db, $flight_code, $airline, 'Economy Class', 'F'.$i, $Economy_Adult, $Economy_Child, $Economy_infant);
    }
    addFlight2($db, $flight_code, $airline, 'Economy Class', 'I39', $Economy_Adult, $Economy_Child, $Economy_infant);
    addFlight2($db, $flight_code, $airline, 'Economy Class', 'J39', $Economy_Adult, $Economy_Child, $Economy_infant);
    addFlight2($db, $flight_code, $airline, 'Economy Class', 'K39', $Economy_Adult, $Economy_Child, $Economy_infant);

    addFlight1($db, $flight_code, $deaprture_city, $departure_cityName, $arrival_city, $arrival_cityName, $deaprture_time, $arrival_time, $time, $deaprture_date, $aircraft);
} else if ($aircraft == 'A330') {
    for ($i = 1; $i <= 7; $i++) {
        addFlight2($db, $flight_code, $airline, 'Business Class', 'A'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'B'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'C'.$i, $business_Adult, $business_Child, $business_infant);
        addFlight2($db, $flight_code, $airline, 'Business Class', 'D'.$i, $business_Adult, $business_Child, $business_infant);
    }
    addFlight2($db, $flight_code, $airline, 'Business Class', 'A8', $business_Adult, $business_Child, $business_infant);

    for ($i = 1; $i <= 40; $i++) {
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'A'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'B'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'C'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'D'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'E'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
        addFlight2($db, $flight_code, $airline, 'Prenium Economy', 'F'.$i, $prenium_Adult, $prenium_Child, $prenium_infant);
    }

    addFlight1($db, $flight_code, $deaprture_city, $departure_cityName, $arrival_city, $arrival_cityName, $deaprture_time, $arrival_time, $time, $deaprture_date, $aircraft);
}

echo '<script>alert("Thêm chuyến bay hoàn tất")</script>';
header("Location: ../admin");
?>