<?php
    function get_flight($db, $from, $to, $depart, $chairType) {
        $query = "SELECT DISTINCT a.flight_code, a.departure_time, a.arrival_time, a.time, a.airline, b.price_adult, b.price_child, b.price_infant, a.departure_cityName, a.arrival_cityName
                  FROM flight_list b
                  JOIN flight_info a ON a.flight_code = b.flight_code
                  WHERE a.departure_city = :from AND a.arrival_city = :to AND a.flight_date = :depart AND b.ticket_type = :chairType";

        $stmt = $db->prepare($query);
        
        $stmt->bindParam(':from', $from);
        $stmt->bindParam(':to', $to);
        $stmt->bindParam(':depart', $depart);
        $stmt->bindParam(':chairType', $chairType);

        $stmt->execute();
        $flights = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $flights;
    }

    function getNameCity($db, $a, $b) {
        $query = "SELECT DISTINCT departure_cityName, arrival_cityName, time
        FROM flight_info
        WHERE departure_city = :a AND arrival_city = :b";

        $stmt = $db->prepare($query);

        $stmt->bindParam(':a', $a);
        $stmt->bindParam(':b', $b);

        $stmt->execute();
        $flights = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $flights;
    }

    function get_chairType($db, $flight_code, $ticket_type) {
        $query = "SELECT chair_number, status FROM flight_list WHERE flight_code = :flight_code AND ticket_type = :ticket_type";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':flight_code', $flight_code);
        $stmt->bindParam(':ticket_type', $ticket_type);

        $stmt->execute();
        $chairs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $chairs;
    }

    function getFLightInfoByCode($db, $flight_code) {
        $query = "SELECT *
                  FROM flight_list b
                  JOIN flight_info a ON a.flight_code = b.flight_code
                  WHERE a.flight_code = :flight_code
                  GROUP BY a.flight_code";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':flight_code', $flight_code);

        $stmt->execute();
        $flights = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $flights;
    }

    function addInfoContact($db, $userName, $firstName, $lastName, $phone, $email, $flight_code, $image_transfer) {
        $query1 = "INSERT INTO contact_list (userName_Account, first_name, last_name, phone, email, flight_code, image_transfer)
                    VALUES (:userName, :firstName, :lastName, :phone, :email, :flight_code, :image_transfer)";

        $stmt = $db->prepare($query1);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':flight_code', $flight_code);
        $stmt->bindParam(':image_transfer', $image_transfer);

        if($stmt->execute()) {
            $last_id = $db->lastInsertId();
            return $last_id;
        } else {
            echo '<script>alert("Đã xảy ra lỗi")</script>';
            return null;
        }
    }

    function addInfoCustomer($db, $id_last, $customer_type, $title, $first_name, $last_name, $birthday, $chairNumber) {
        $query2 = "INSERT INTO customer_list (id_contact, customer_type, title, first_name, last_name, birthday, chair_number)
                        VALUES (:id, :customer_type, :title, :firstName, :lastName, :birthday, :chairNumber)";

        $stmt2 = $db->prepare($query2);
        $stmt2->bindParam(':id', $id_last);
        $stmt2->bindParam(':customer_type', $customer_type);
        $stmt2->bindParam(':title', $title);
        $stmt2->bindParam(':firstName', $first_name);
        $stmt2->bindParam(':lastName', $last_name);
        $stmt2->bindParam(':birthday', $birthday);
        $stmt2->bindParam(':chairNumber', $chairNumber);

        $stmt2->execute();
    }

    function setReserve($db, $status, $flight_code, $ticket_type, $chair_number) {
        $query = "UPDATE flight_list
                SET status=:status
                WHERE  flight_code=:flight_code AND ticket_type=:ticket_type AND chair_number=:chair_number;";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':flight_code', $flight_code);
        $stmt->bindParam(':ticket_type', $ticket_type);
        $stmt->bindParam(':chair_number', $chair_number);

        return $stmt->execute();
    }
?>