<?php
require('../model/database.php');
require('../model/admin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header class="header">
        <h3>iDashboard</h3>
        <nav>
            <i class="fa-solid fa-envelope"></i>
            <i class="fa-solid fa-bell"></i>
            <div>
                <p>admin</p>
                <a href="../controller/logout.php">Đăng xuất</a>
            </div>
        </nav>
    </header>
    
    <section class="controller">

        

        <div class="controller_ticket">
            <div class="controller_ticket-title" onclick="openItem('controller_ticket nav')">
                <i class="fa-solid fa-ticket"></i>
                <p>Vé máy bay</p>
            </div>
            <nav>
                <p onclick="openAddFlight()">Thêm mới</p>
                <p onclick="openFlightList()">Danh sách</p>
            </nav>
        </div>
        <div class="controller_customer" onclick="openItem('controller_customer nav')">
            <div class="controller_customer-title">
                <i class="fa-solid fa-person"></i>
                <p>Khách hàng</p>
            </div>
            <nav>
                <p>Thêm mới</p>
                <p>Danh sách</p>
            </nav>
        </div>

        <!-- <div class="controller_statistical" onclick="openItem('controller_statistical nav')">
            <div class="controller_statistical-title">
                <p><i class="fa-solid fa-house"></i>
                 Thống kê</p>
            </div>
            <nav>
                <p>Doanh thu</p>
                <p>Chuyến bay</p>
            </nav>
        </div> -->
        
    </section>
    <section class="main">
        <div class="main_header">
            <h3>Vé Máy Bay</h3>
        </div>
        <div class="main_content">
            <h3>THÊM CHUYẾN BAY</h3>
            <form action="../controller/admin_add.php" method="post">
                <div class="main_content-error code">
                    <p id="error-flight_code"></p>
                </div>
                <div class="main_content-div">
                    <label>Mã chuyến bay</label>
                    <input type="text" name="flight_code" id="flight_code">
                </div>
                <div class="main_content-error address">
                    <p id="error-address"></p>
                </div>
                <div class="main_content-div">
                    <label>Điểm đi</label>
                    <select name="departure_city" id="departure_city">
                        <option value="">Chọn</option>
                        <option value="HAN Hà Nội">Sân bay Nội Bài ( HAN )</option>
                        <option value="SGN TP HCM">Sân bay Tân Sơn Nhất ( SGN )</option>
                        <option value="DAD Đà Nẵng">Sân bay Đà Nẵng ( DAD )</option>
                        <option value="VDO Quảng Ninh">Sân bay Vân Đồn ( VDO )</option>
                        <option value="HPH Hải Phòng">Sân bay Cát Bì ( HPH )</option>
                        <option value="VII Nghệ An">Sn bay Vinh ( VII )</option>
                        <option value="HUI Huế">Sân bay Phú Bài ( HUI )</option>
                        <option value="CXR Khánh Hòa">Sân bay Cam Ranh ( CXR )</option>
                        <option value="DLI Lâm Đồng">Sân bay Liên Khương ( DLI )</option>
                        <option value="UIH Bình Định">Sân bay Phù Cát ( UIH )</option>
                        <option value="VCA Cần Thơ">Sân bay Cần Thơ ( VCA )</option>
                        <option value="PQC Kiên Giang">Sân bay Phú Quốc ( PQC )</option>
                    </select>
                </div>
                <div class="main_content-div">
                    <label>Điểm đến</label>
                    <select name="arrival_city" id="arrival_city">
                        <option value="">Chọn</option>
                        <option value="HAN Hà Nội">Sân bay Nội Bài ( HAN )</option>
                        <option value="SGN TP HCM">Sân bay Tân Sơn Nhất ( SGN )</option>
                        <option value="DAD Đà Nẵng">Sân bay Đà Nẵng ( DAD )</option>
                        <option value="VDO Quảng Ninh">Sân bay Vân Đồn ( VDO )</option>
                        <option value="HPH Hải Phòng">Sân bay Cát Bì ( HPH )</option>
                        <option value="VII Nghệ An">Sn bay Vinh ( VII )</option>
                        <option value="HUI Huế">Sân bay Phú Bài ( HUI )</option>
                        <option value="CXR Khánh Hòa">Sân bay Cam Ranh ( CXR )</option>
                        <option value="DLI Lâm Đồng">Sân bay Liên Khương ( DLI )</option>
                        <option value="UIH Bình Định">Sân bay Phù Cát ( UIH )</option>
                        <option value="VCA Cần Thơ">Sân bay Cần Thơ ( VCA )</option>
                        <option value="PQC Kiên Giang">Sân bay Phú Quốc ( PQC )</option>
                    </select>
                </div>
                <div class="main_content-div">
                    <label>Ngày bay</label>
                    <input type="date" name="departure_date" id="departure_date">
                </div>
                <div class="main_content-error timeFrom">
                    <p id="error-timeFrom"></p>
                </div>
                <div class="main_content-div">
                    <label>Thời gian đi</label>
                    <input type="text" placeholder="HH:MM" id="departure_time" name="departure_time">
                </div>
                <div class="main_content-error timeTo">
                    <p id="error-timeTo"></p>
                </div>
                <div class="main_content-div">
                    <label>Thời gian đến</label>
                    <input type="text" placeholder="HH:MM" id="arrival_time" name="arrival_time">
                </div>
                <div class="main_content-div">
                    <label>Thời gian bay</label>
                    <input type="text" id="time" name="time">
                </div>
                <div class="main_content-div">
                    <label>Hãng bay</label>
                    <select name="airline" id="airline">
                        <option value="">Chọn</option>
                        <option value="Bamboo Airways">Bamboo Airways</option>
                        <option value="VietJet Air">VietJet Air</option>
                        <option value="Vietnam Airlines">Vietnam Airlines</option>
                        <option value="Vietravel Airlines">Vietravel Airlines</option>
                    </select>
                </div>
                <span class="main_content-div">Đội bay</span>
                <div class="main_content-ChairType">
                    <div class="content-airlineBamboo">
                        <label><input type="radio" name="aircraft" value="A321">Airbus A321CEO</label>
                        <label><input type="radio" name="aircraft" value="A320">Airbus A320CEO</label>
                    </div>
                    <div class="content-airlineVietJet">
                        <label><input type="radio" name="aircraft" value="Boeing737">Boeing 737</label>
                        <label><input type="radio" name="aircraft" value="A321">Airbus A321NEO</label>
                        <label><input type="radio" name="aircraft" value="A320">Airbus A320NEO</label>
                    </div>
                    <div class="content-airlineVietnam">
                        <label><input type="radio" name="aircraft" value="Boeing787">Boeing 787</label>
                        <label><input type="radio" name="aircraft" value="A350">Airbus A350</label>
                        <label><input type="radio" name="aircraft" value="A330">Airbus A330</label>
                        <label><input type="radio" name="aircraft" value="A321">Airbus A321</label>
                    </div>
                    <div class="content-airlineVietravel">
                        <label><input type="radio" name="aircraft" value="A321">Airbus A321</label>
                    </div>
                    <div class="content-airlineA321">
                        <label>Economy Class: 184 ghế</label>
                        <label>Business Class: 8 ghế</label>
                    </div>
                    <div class="content-airlineA320">
                        <label>Economy Class: 162 ghế</label>
                        <label>Business Class: 8 ghế</label>
                    </div>
                    <div class="content-airlineBoeing737">
                        <label>Economy Class: 200 ghế</label>
                    </div>
                    <div class="content-airlineBoeing787">
                        <label>Business Class: 28 ghế</label>
                        <label>Prenium Economy: 35 ghế</label>
                        <label>Economy Class: 211 ghế</label>
                    </div>
                    <div class="content-airlineA350">
                        <label>Business Class: 29 ghế</label>
                        <label>Prenium Economy: 45 ghế</label>
                        <label>Economy Class: 231 ghế</label>
                    </div>
                    <div class="content-airlineA330">
                        <label>Business Class: 29 ghế</label>
                        <label>Prenium Economy: 240 ghế</label>
                    </div>
                </div>
                <span class="main_content-div">Giá vé</span>
                <div class="main_content-ticketType-business">
                    <p class="main_content-ticketType">Business Class</p>
                    <div class="main_content-div ticket">
                        <label>Người lớn:</label>
                        <div>
                            <input type="text" name="business_Adult">
                            <p>VND</p>
                        </div>
                    </div>
                    <div class="main_content-div ticket">
                        <label>Trẻ em:</label>
                        <div>
                            <input type="text" name="business_Child">
                            <p>VND</p>
                        </div>
                    </div>
                    <div class="main_content-div ticket">
                        <label>Sơ sinh:</label>
                        <div>
                            <input type="text" name="business_infant">
                            <p>VND</p>
                        </div>
                    </div>
                </div>
                <div class="main_content-ticketType-prenium">
                    <p class="main_content-ticketType">Prenium Economy</p>
                    <div class="main_content-div ticket">
                        <label>Người lớn:</label>
                        <div>
                            <input type="text" name="prenium_Adult">
                            <p>VND</p>
                        </div>
                    </div>
                    <div class="main_content-div ticket">
                        <label>Trẻ em:</label>
                        <div>
                            <input type="text" name="prenium_Child">
                            <p>VND</p>
                        </div>
                    </div>
                    <div class="main_content-div ticket">
                        <label>Sơ sinh:</label>
                        <div>
                            <input type="text" name="prenium_infant">
                            <p>VND</p>
                        </div>
                    </div>
                </div>
                <div class="main_content-ticketType-economy">
                    <p class="main_content-ticketType">Economy Class</p>
                    <div class="main_content-div ticket">
                        <label>Người lớn:</label>
                        <div>
                            <input type="text" name="Economy_Adult">
                            <p>VND</p>
                        </div>
                    </div>
                    <div class="main_content-div ticket">
                        <label>Trẻ em:</label>
                        <div>
                            <input type="text" name="Economy_Child">
                            <p>VND</p>
                        </div>
                    </div>
                    <div class="main_content-div ticket">
                        <label>Sơ sinh:</label>
                        <div>
                            <input type="text" name="Economy_infant">
                            <p>VND</p>
                        </div>
                    </div>
                </div>
                <div class="main_content-btn">
                    <button type="submit">Thêm</button>
                </div>
            </form>
        </div>
        <div class="flight_list">
            <h3>Danh sách chuyến bay</h3>
            <table>
                <thead>
                    <tr>
                        <th>Mã chuyến bay</th>
                        <th>Điểm đi</th>
                        <th>Điểm đến</th>
                        <th>Thời gian cất cánh</th>
                        <th>Thời gian hạ cánh</th>
                        <th>Ngày bay</th>
                        <th>Hãng bay</th>
                        <th>Tên máy bay</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $flights = showFlightList($db);

                    foreach ($flights as $flight) {
                        echo '
                        <tr>
                            <td>'. htmlspecialchars($flight['flight_code']) .'</td>
                            <td>'. htmlspecialchars($flight['departure_cityName']) .'</td>
                            <td>'. htmlspecialchars($flight['arrival_cityName']) .'</td>
                            <td>'. htmlspecialchars($flight['departure_time']) .'</td>
                            <td>'. htmlspecialchars($flight['arrival_time']) .'</td>
                            <td>'. htmlspecialchars($flight['flight_date']) .'</td>
                            <td>'. htmlspecialchars($flight['airline']) .'</td>
                            <td>'. htmlspecialchars($flight['flight_name']) .'</td>
                        </tr>';
                    }
                    ?>
                </tbody>
                
            </table>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/admin.js"></script>
</body>
</html>