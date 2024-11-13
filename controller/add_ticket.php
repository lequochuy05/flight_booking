<?php
require('../model/database.php');
require('../model/flight_list_db.php');

$userName = $_POST['userName'];
$contact_firtName = $_POST['contact_firtName'];
$contact_lastName = $_POST['contact_lastName'];
$contact_phone = $_POST['contact_phone'];
$contact_email = $_POST['contact_email'];
$flight_code = $_POST['flight_code'];
$customer_type = $_POST['customer_type'];

$image = null;
if (isset($_FILES['image_transfer']) && $_FILES['image_transfer']['error'] === UPLOAD_ERR_OK) {
    $image_name = $_FILES['image_transfer']['name'];
    $image_temp = $_FILES['image_transfer']['tmp_name'];
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_info = pathinfo($image_name);
    $extension = strtolower($file_info['extension']);
    
    if (in_array($extension, $allowed_extensions) && $_FILES['image_transfer']['size'] <= 5000000) { // Giới hạn 5MB
        $destination = "../image_customer/" . $image_name;
        $counter = 1;

        while (file_exists($destination)) {
            $image_name = $file_info['filename'] . "_$counter." . $extension;
            $destination = "../image_customer/" . $image_name;
            $counter++;
        }

        if (move_uploaded_file($image_temp, $destination)) {
            $image = $image_name;
        } else {
            die("Đã xảy ra lỗi khi di chuyển file.");
        }
    } else {
        die("File không hợp lệ hoặc vượt quá dung lượng cho phép.");
    }
}

$id_contact = addInfoContact($db, $userName, $contact_firtName, $contact_lastName, $contact_phone, $contact_email, $flight_code, $image);

for ($i = 0; $i < $_POST['countAdult']; $i++) {
    addInfoCustomer($db, $id_contact, $customer_type, $_POST['title_Adult' . $i], $_POST['firstName_Adult' . $i], $_POST['lastName_Adult' . $i], $_POST['birthday_Adult' . $i], $_POST['chairNumber_Adult' . $i]);
    setReserve($db, 'Đã đặt', $flight_code, $customer_type, $_POST['chairNumber_Adult' . $i]);
}
for ($i = 0; $i < $_POST['countChild']; $i++) {
    addInfoCustomer($db, $id_contact, $customer_type, $_POST['title_Child' . $i], $_POST['firstName_Child' . $i], $_POST['lastName_Child' . $i], $_POST['birthday_Child' . $i], $_POST['chairNumber_Child' . $i]);
    setReserve($db, 'Đã đặt', $flight_code, $customer_type, $_POST['chairNumber_Child' . $i]);
}
for ($i = 0; $i < $_POST['countInfant']; $i++) {
    addInfoCustomer($db, $id_contact, $customer_type, $_POST['title_Infant' . $i], $_POST['firstName_Infant' . $i], $_POST['lastName_Infant' . $i], $_POST['birthday_Infant' . $i], $_POST['chairNumber_Infant' . $i]);
    setReserve($db, 'Đã đặt', $flight_code, $customer_type, $_POST['chairNumber_Infant' . $i]);
}
echo '<script>Thanh toán hoàn tất</script>';
header("Location: /flight_booking/");
exit();
?>