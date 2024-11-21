<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut icon" href="images/logo.png">
   
    <?php 
            require("inc/links.php");
    ?>
    <link rel="stylesheet" href="assets/css/common.css">
    <title>Đặt chỗ của tôi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .empty-box {
            text-align: center;
            margin: 20px 0;
        }

        .empty-box img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .empty-box p {
            font-size: 16px;
            font-weight: bold;
        }

        .transaction-history {
            border-top: 1px solid #ddd;
            margin-top: 20px;
            padding-top: 10px;
        }

        .transaction-history a {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .transaction-history a:hover {
            text-decoration: underline;
        }
    </style>
   </head>
<body class="bg-light">
    <?php 
        include("inc/header.php");
        if(!(isset($_SESSION['login']) && $_SESSION['login'] == true))
        {
            redirect('index.php');
        }

        $userId = $_SESSION['uId']; // Lấy ID người dùng từ session
        $query = "
            SELECT 
                au.firstName AS account_first_name, 
                au.lastName AS account_last_name, 
                au.email AS account_email, 
                au.phone AS account_phone, 
                cus.chair_number,
                cl.first_name AS contact_first_name, 
                cl.last_name AS contact_last_name, 
                cl.flight_code, 
                fi.flight_name, 
                fi.departure_cityName, 
                fi.arrival_cityname, 
                fi.departure_time, 
                fi.arrival_time, 
                fi.flight_date
            FROM 
                account_user au
            INNER JOIN 
                contact_list cl ON au.id = cl.no_account
            INNER JOIN 
                customer_list cus ON cl.id = cus.id_contact
            INNER JOIN 
                flight_list fl ON cus.chair_number = fl.chair_number
            INNER JOIN 
                flight_info fi ON fl.flight_code = fi.flight_code
            WHERE 
                au.id = ? 
                AND fl.status = 'Đã đặt';
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">Đặt chỗ</h2>
                <div style="font-size: 14px">
                    <a href="index.php" class="text-secondary text-decoration-none">Trang chủ</a>
                    <span class="text-secondary"> ></span>
                    <a href="#" class="text-secondary text-decoration-none">Đặt chỗ của tôi</a>
                </div>            
            </div>

            
            <div class="container">
                <div class="header">
                    <h1>Du lịch dễ dàng</h1>
                    <p>Đổi lịch dễ như trở bàn tay. <a href="#" style="color: yellow;">Tìm hiểu thêm</a></p>
                </div>
                
                <div class="content">
                    <h2>Vé điện tử</h2>
                    <?php if ($result->num_rows > 0): ?>
                        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                            <thead>
                                <tr style="background-color: #007bff; color: white; text-align: left;">
                                    <th style="padding: 10px;">#</th>
                                    <th style="padding: 10px;">Liên hệ</th>
                                    <th style="padding: 10px;">Mã chuyến bay</th>
                                    <th style="padding: 10px;">Tên chuyến bay</th>
                                    <th style="padding: 10px;">Ngày bay</th>
                                    <th style="padding: 10px;">Thời gian</th>
                                    <th style="padding: 10px;">Số ghế</th>
                                    <th style="padding: 10px;">Điểm đi - Điểm đến</th>
                                    
                                    <th style="padding: 10px;">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;
                                
                                while ($row = $result->fetch_assoc()): ?>
                                    <tr style="border-bottom: 1px solid #ddd;">
                                        <td style="padding: 10px;">
                                            <?php echo $i ?>
                                        </td>
                                        
                                        <td style="padding: 10px;">
                                            <?php echo $row['contact_first_name'] . ' ' . $row['contact_last_name'] . '<br>' . $row['account_email'] . '<br>' . $row['account_phone']; ?>
                                        </td>
                                        <td style="padding: 10px;"><?php echo $row['flight_code']; ?></td>
                                        <td style="padding: 10px;"><?php echo $row['flight_name']; ?></td>
                                        <td style="padding: 10px;"><?php echo date('d-m-Y', strtotime($row['flight_date'])); ?></td>
                                        <td style="padding: 10px;">
                                            <?php echo $row['departure_time'] . ' - ' . $row['arrival_time']; ?>
                                        </td>
                                        <td style="padding: 10px;">
                                        <?php echo $row['chair_number']; ?>
                                        </td>
                                        <td style="padding: 10px;">
                                            <?php echo $row['departure_cityName'] . ' - ' . $row['arrival_cityname']; ?>
                                        </td>
                                        <td style="padding: 10px;">
                                            <button class="btn btn-danger">
                                                Cancel
                                            </button>
                                        </td>
                                    </tr>
                                   
                                <?php 
                                    $i++;    
                                endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="empty-box">
                            <img src="https://img.icons8.com/ios-filled/50/000000/sleeping-in-bed.png">
                            <p>Không tìm thấy đặt chỗ</p>
                            <p>Mọi chỗ bạn đặt sẽ được hiển thị tại đây. Hiện bạn chưa có bất kỳ đặt chỗ nào, hãy đặt trên trang chủ ngay!</p>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="transaction-history">
                    <h2>Lịch sử giao dịch</h2>
                    <a href="transaction_list.php">Xem Lịch sử giao dịch của bạn</a>
                </div>
            </div>



        </div>
    </div>    

  
  
   
    <!-- Footer -->
    <?php
    include("inc/footer.php");
    ?>


</body>
</html>

