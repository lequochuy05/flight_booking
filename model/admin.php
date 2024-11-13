<?php
function addFlight1($db, $flight_code, $departure_city, $departure_cityName, $arrival_city, $arrival_cityName, $departure_time, $arrival_time, $time, $flight_date, $flight_name) {
    $query = "INSERT INTO flight_info (flight_code, departure_city, departure_cityName, arrival_city, arrival_cityName, departure_time, arrival_time, time, flight_date, flight_name)
              VALUES (:flight_code, :departure_city, :departure_cityName, :arrival_city, :arrival_cityName, :departure_time, :arrival_time, :time, :flight_date, :flight_name)";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':flight_code', $flight_code);
    $stmt->bindParam(':departure_city', $departure_city);
    $stmt->bindParam(':departure_cityName', $departure_cityName);
    $stmt->bindParam(':arrival_city', $arrival_city);
    $stmt->bindParam(':arrival_cityName', $arrival_cityName);
    $stmt->bindParam(':departure_time', $departure_time);
    $stmt->bindParam(':arrival_time', $arrival_time);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':flight_date', $flight_date);
    $stmt->bindParam(':flight_name', $flight_name);

    $stmt->execute();
}
function addFlight2($db, $flight_code, $airline, $ticket_type, $chair_number, $price_adult, $price_child, $price_infant) {
    $query = "INSERT INTO flight_list (flight_code, airline, ticket_type, chair_number, price_adult, price_child, price_infant, status)
              VALUES (:flight_code, :airline, :ticket_type, :chair_number, :price_adult, :price_child, :price_infant, 'Chưa đặt')";
              
    $stmt = $db->prepare($query);
    $stmt->bindParam(':flight_code', $flight_code);
    $stmt->bindParam(':airline', $airline);
    $stmt->bindParam(':ticket_type', $ticket_type);
    $stmt->bindParam(':chair_number', $chair_number);
    $stmt->bindParam(':price_adult', $price_adult);
    $stmt->bindParam(':price_child', $price_child);
    $stmt->bindParam(':price_infant', $price_infant);
    
    $stmt->execute();
}
function showFlightList($db) {
    $query = "SELECT flight_info.*, flight_list.*
              FROM flight_info
              INNER JOIN flight_list
              ON flight_info.flight_code = flight_list.flight_code
              GROUP BY flight_info.flight_code
              ORDER BY CAST(SUBSTRING(flight_info.flight_code, 3) AS UNSIGNED) ASC";

    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>