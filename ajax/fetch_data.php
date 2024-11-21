<?php
    // Kết nối đến cơ sở dữ liệu
    require('./model/database.php');

    // Lấy thông tin ngày từ request
    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

    if ($start_date && $end_date) {
        // Truy vấn dữ liệu trong khoảng ngày được chọn
        $query = "SELECT f.flight_code, f.ticket_type, f.price_adult, f.price_child, f.price_infant, f.status, c.first_name, c.last_name, c.phone, a.email 
                FROM flight_list f
                JOIN contact_list c ON f.flight_code = c.flight_code
                JOIN account_user a ON c.no_account = a.id
                WHERE f.flight_date BETWEEN ? AND ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();

        // Trả về dữ liệu dạng JSON
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    } else {
        echo json_encode([]);
    }
    // Lấy tháng từ request
    $month = isset($_GET['month']) ? $_GET['month'] : '';

    if ($month) {
        // Giải mã tháng và năm
        $monthParts = explode('-', $month);
        $monthNumber = $monthParts[0];
        $year = $monthParts[1];

        // Truy vấn dữ liệu trong tháng được chọn
        $query = "SELECT f.flight_code, f.ticket_type, f.price_adult, f.price_child, f.price_infant, f.status, c.first_name, c.last_name, c.phone, a.email 
                FROM flight_list f
                JOIN contact_list c ON f.flight_code = c.flight_code
                JOIN account_user a ON c.no_account = a.id
                WHERE MONTH(f.flight_date) = ? AND YEAR(f.flight_date) = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $monthNumber, $year);
        $stmt->execute();
        $result = $stmt->get_result();

        // Trả về dữ liệu dạng JSON
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    } else {
        echo json_encode([]);
    }

?>
