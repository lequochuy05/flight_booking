<?php
require('../model/database.php');
require('../model/flight_list_db.php');


for ($i = 0; $i < $_POST['countAdult']; $i++) {
    setReserve($db, 'Chờ thanh toán', $_POST['flight_code'], $_POST['chairType'], $_POST['chair_Adult' . $i]);
}
for ($i = 0; $i < $_POST['countChild']; $i++) {
    setReserve($db, 'Chờ thanh toán', $_POST['flight_code'], $_POST['chairType'], $_POST['chair_Child' . $i]);
}
for ($i = 0; $i < $_POST['countInfant']; $i++) {
    setReserve($db, 'Chờ thanh toán', $_POST['flight_code'], $_POST['chairType'], $_POST['chair_Infant' . $i]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay</title>
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/pay.css">
</head>
<body>
    <header class="header">
        <a href="../index.php" class="header_logo">DINHVUONG</a>
        <nav class="header_step">
            <label>1</label>
            <p>Điền thông tin</p>
            <span></span>
            <label>2</label>
            <p>Đặt chỗ</p>
            <span></span>
            <label>3</label>
            <p>Thanh toán</p>
            <span></span>
            <label>4</label>
            <p>Vé điện tử</p>
        </nav>
    </header>

    <section class="container_main">
        <div class="container_main-cancel" onclick="openItem('pay_detail', 'container_main')">
            <i class="fa-solid fa-arrow-left"></i>
            <p>Hủy</p>
        </div>
        <div class="container_main-header">
            Hoàn tất thanh toán của bạn trước&nbsp;
            <p id="countdown">10:00</p>&nbsp;
            <i class="fa-solid fa-clock"></i>
        </div>
        <div class="container_main-pays">
            <h2>Bạn muốn thanh toán như thế nào?</h2>
            <div class="container_main-pays-qrcode">
                <div>
                    <input type="radio" name="pay" value="qrcode" checked>
                    <label>QR Code</label>
                </div>
                <div>
                    <ul>
                        <li>Đảm bảo bạn có ví điện tử hoặc ứng dụng ngân hàng di động hỗ trợ thanh toán bằng QR Code</li>
                        <li>Mã QR xuất hiện sau khi bạn nhấp vào nút 'Thanh toán'. Chỉ cần lưu hoặc chụp màn hình mã QR để hoàn tất thanh toán của bạn trong thời gian banking của bạn.</li>
                        <li>Vui long sử dụng mã QR mới nhất được cung cấp để hoàn tất thanh toán của bạn.</li>
                    </ul>
                </div>
            </div>
            <div class="container_main-pays-e-wallets">
                <div>
                    <div>
                        <input type="radio" name="pay" value="wallets">
                        <label>Ví điện tử khác</label>
                    </div>
                    <div>
                        <img src="../assets/img/pay_1.webp" alt="">
                        <img src="../assets/img/pay_2.webp" alt="">
                        <img src="../assets/img/pay_3.webp" alt="">
                    </div>
                </div>
                <div class="pays_e-wallets-content">
                    <ul>
                        <li>Thanh toán chỉ có sẵn trên ứng dụng được liệt kê bên dưới. Đảm bảo bạn đã cài đặt ứng dụng ví điện tử của mình trước khi tiếp tục.</li>
                        <li>Sau khi hấp vào nút 'Thanh Toán', bạn sẽ chuyển hướng đến chọn ví điện tử của mình để xem mã QR</li>
                        <li>Các tùy chọn có sẵn: ShoppeePay, ZaloPay, SmartPay và mPay</li>
                    </ul>
                </div>
            </div>
            <div class="container_main-pays-transfer">
                <div>
                    <input type="radio" name="pay" value="transfer">
                    <label>Chuyển khoản ngân hàng</label>
                </div>
                <div class="container_main-pays-transfer-content">
                    <ul>
                        <li>Chuyển khoản ngân hàng chỉ áp dụng từ 8 giờ sáng đến 8 giờ tối. Bạn có thể chuyển khoản từ kênh ngân hàng điện tử của MB Bank và các ngân hàng khác.</li>
                        <li>Chuyển khoản liên ngân hàng qua ATM và Internet Banking không khả dụng </li>
                        <li><strong>Hãy lựu chọn Dịch vụ Chuyển tiền Nhanh 24/7</strong> để chuyển tiền từ các ngân hàng khác ngoài MB Bank</li>
                    </ul>
                    <div>
                        <p>Chọn tài khoản đích</p>
                        <div class="pays_transfer-content pays_transfer-slected">
                            <div>
                                <input type="radio" name="pay-transfer" value="pay-transfer-mbbank" checked>
                                <label>MB Bank</label>
                            </div>
                            <img src="../assets/img/MBBank.png" alt="MBBank">
                        </div>
                        <div class="pays_transfer-content">
                            <div>
                                <input type="radio" name="pay-transfer" value="pay-transfer-vietcom">
                                <label>Vietcombank</label>
                            </div>
                            <img src="../assets/img/vietcombank.png" alt="VietCom">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container_main-btnPay">
            <div class="container_main-btnPay-price">
                <p>Tổng giá tiền</p>
                <div>
                    <p><?php echo htmlspecialchars($_POST['price']) ?> VND</p>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
            <button type="button" onclick="loading()">Thanh toán <span>QR Code</span></button>
        </div>
    </section>
    <section class="loading">
        <svg viewBox="25 25 50 50">
            <circle r="20" cy="50" cx="50"></circle>
        </svg>
        <p>Đang được xử lý, vui lòng đợi !!!</p>
    </section>
    <form method="POST" class="pay_detail" enctype="multipart/form-data" action="../controller/add_ticket.php">
        <div class="pay_detail-cancel" onclick="openItem('pay_detail', 'container_main')">
            <i class="fa-solid fa-arrow-left"></i>
            <p>Hủy</p>
        </div>
        <div class="pay_detail-content">
            <div class="pay_detail-contentLeft">
                <div class="pay_detail-contentLeft-header">
                    <label>Hoàn tất thanh toán của bạn trước&nbsp;</label>
                    <p id="countdown">00:05</p>&nbsp;
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="pay_detail-contentLeft-main">
                    <h2>Quét mã QR để thanh toán</h2>
                    <div>
                        <img src="../assets/img/QR_code.svg" alt="qrcode">
                        <p>Ngân hàng: VietQR</p>
                        <p>Số tài khoản: 000000000000</p>
                        <p>Tên tài khoản: Dinh Vuong</p>
                    </div>
                </div>
                <div class="pay_detail-button">
                    <div>
                        <label>Ảnh chuyển khoản <span>*</span></label>
                        <input type="file" accept="image/*" id="image" name="image_transfer">
                    </div>
                    <button onclick="validateForm(event)">Thanh toán hoàn tất</button>
                </div>
            </div>
            <div class="pay_detail-contentRight">
                <div>
                    <h4>Chi tiết</h4>
                    <p>Mã đặt chỗ:</p>
                </div>
                <div>
                    <p>Số tiền</p>
                    <p>9.999.999 VND</p>
                </div>
            </div>
        </div>


        <input type="hidden" name="userName" value="<?php echo htmlspecialchars($_POST['userName']) ?>">
        <input type="hidden" name="contact_firtName" value="<?php echo htmlspecialchars($_POST['contact_firtName']) ?>">
        <input type="hidden" name="contact_lastName" value="<?php echo htmlspecialchars($_POST['contact_lastName']) ?>">
        <input type="hidden" name="contact_phone" value="<?php echo htmlspecialchars($_POST['contact_phone']) ?>">
        <input type="hidden" name="contact_email" value="<?php echo htmlspecialchars($_POST['contact_email']) ?>">
        <input type="hidden" name="flight_code" value="<?php echo htmlspecialchars($_POST['flight_code']) ?>">
        <input type="hidden" name="customer_type" value="<?php echo htmlspecialchars($_POST['chairType']) ?>">

        <input type="hidden" name="countAdult" value="<?php echo htmlspecialchars($_POST['countAdult']) ?>">
        <input type="hidden" name="countChild" value="<?php echo htmlspecialchars($_POST['countChild']) ?>">
        <input type="hidden" name="countInfant" value="<?php echo htmlspecialchars($_POST['countInfant']) ?>">

        <?php
        for ($i = 0; $i < $_POST['countAdult']; $i++) {
            echo '<input type="hidden" name="title_Adult'. $i .'" value="'. htmlspecialchars($_POST['title_Adult' . $i]) .'">';
            echo '<input type="hidden" name="firstName_Adult'. $i .'" value="'. htmlspecialchars($_POST['firstName_Adult' . $i]) .'">';
            echo '<input type="hidden" name="lastName_Adult'. $i .'" value="'. htmlspecialchars($_POST['lastName_Adult' . $i]) .'">';
            echo '<input type="hidden" name="birthday_Adult'. $i .'" value="'. htmlspecialchars($_POST['year_Adult' . $i]) .'-'. htmlspecialchars($_POST['month_Adult' . $i]) .'-'. htmlspecialchars($_POST['day_Adult' . $i]) .'">';
            echo '<input type="hidden" name="chairNumber_Adult'. $i .'" value="'. htmlspecialchars($_POST['chair_Adult' . $i]) .'">';
        }
        for ($i = 0; $i < $_POST['countChild']; $i++) {
            echo '<input type="hidden" name="title_Child'. $i .'" value="'. htmlspecialchars($_POST['title_Child' . $i]) .'">';
            echo '<input type="hidden" name="firstName_Child'. $i .'" value="'. htmlspecialchars($_POST['firstName_Child' . $i]) .'">';
            echo '<input type="hidden" name="lastName_Child'. $i .'" value="'. htmlspecialchars($_POST['lastName_Child' . $i]) .'">';
            echo '<input type="hidden" name="birthday_Child'. $i .'" value="'. htmlspecialchars($_POST['year_Child' . $i]) .'-'. htmlspecialchars($_POST['month_Child' . $i]) .'-'. htmlspecialchars($_POST['day_Child' . $i]) .'">';
            echo '<input type="hidden" name="chairNumber_Child'. $i .'" value="'. htmlspecialchars($_POST['chair_Child' . $i]) .'">';
        }
        for ($i = 0; $i < $_POST['countInfant']; $i++) {
            echo '<input type="hidden" name="title_Infant'. $i .'" value="'. htmlspecialchars($_POST['title_Infant' . $i]) .'">';
            echo '<input type="hidden" name="firstName_Infant'. $i .'" value="'. htmlspecialchars($_POST['firstName_Infant' . $i]) .'">';
            echo '<input type="hidden" name="lastName_Infant'. $i .'" value="'. htmlspecialchars($_POST['lastName_Infant' . $i]) .'">';
            echo '<input type="hidden" name="birthday_Infant'. $i .'" value="'. htmlspecialchars($_POST['year_Infant' . $i]) .'-'. htmlspecialchars($_POST['month_Infant' . $i]) .'-'. htmlspecialchars($_POST['day_Infant' . $i]) .'">';
            echo '<input type="hidden" name="chairNumber_Infant'. $i .'" value="'. htmlspecialchars($_POST['chair_Infant' . $i]) .'">';
        }
        ?>
    </form>
    <section class="select">
        <svg viewBox="25 25 50 50">
            <circle r="20" cy="50" cx="50"></circle>
        </svg>
        <p>Khi rời khỏi trang này các ghế số 
        <?php
        $array_chair_number = [];
        for ($i = 0; $i < $_POST['countAdult']; $i++) {
            echo $_POST['chair_Adult' . $i] . ', ';
            $array_chair_number[] = htmlspecialchars($_POST['chair_Adult' . $i]);
        }
        for ($i = 0; $i < $_POST['countChild']; $i++) {
            echo $_POST['chair_Child' . $i] . ', ';
            $array_chair_number[] = htmlspecialchars($_POST['chair_Child' . $i]);
        }
        for ($i = 0; $i < $_POST['countInfant']; $i++) {
            echo $_POST['chair_Infant' . $i] . ',    ';
            $array_chair_number[] = htmlspecialchars($_POST['chair_Infant' . $i]);
        }
        ?>    
        mà bạn đã chọn sẽ bị Hủy và bạn phải thực hiện chọn lại ghế. Bạn có chắc muốn hủy thanh toán</p>
        <div>
            <button id="confirmCancel"
                data-flight-code="<?php echo htmlspecialchars($_POST['flight_code']) ?>"
                data-chair-type="<?php echo htmlspecialchars($_POST['chairType']) ?>"
                data-chair-numbers="<?php echo htmlspecialchars(implode(',', $array_chair_number)) ?>"
            >Có</button>
            <button>Không</button>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/pay.js"></script>
</body>
</html>