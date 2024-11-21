<?php
    session_start();

    $first_name = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : '';
    $last_name = isset($_SESSION['lastName']) ? $_SESSION['lastName'] : '';
    require('../model/database.php');
    require('../model/flight_list_db.php');

    $from = isset($_GET['from']) ? $_GET['from'] : '';
    $to = isset($_GET['to']) ? $_GET['to'] : '';
    $depart = isset($_GET['departure']) ? $_GET['departure'] : '';
    $chairType = isset($_GET['chairType']) ? $_GET['chairType'] : '';
    $return_date = isset($_GET['return-check']) ? (isset($_GET['return_date']) ? $_GET['return_date'] : '') : '';
    $countAdult = isset($_GET['countAdult']) ? $_GET['countAdult'] : '';
    $countChild = isset($_GET['countChild']) ? $_GET['countChild'] : '';
    $countInfant = isset($_GET['countInfant']) ? $_GET['countInfant'] : '';
    $count_ticket = intval($countAdult) + intval($countChild) + intval($countInfant);

    $flights = get_flight($db, $from, $to, $depart, $chairType);
    $flights_return = get_flight($db, $to, $from, $return_date, $chairType);

    // echo htmlspecialchars($to). ' '. htmlspecialchars($from). ' '. htmlspecialchars($return_date). ' '. htmlspecialchars($chairType). ' '. count($flights_return);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight List</title>
    
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/flight_list.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light px-lg-3 py-lg2 shadow-sm sticky-top bg" id="nav-bar">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">DASHBOARD</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link me-2" href="index.php">Trang Chủ</a>
            </li>
            <li class="nav-item">
            <a class="nav-link me-2" href="introduce.php">Giới Thiệu</a>
            </li>
            <li class="nav-item">
            <a class="nav-link me-2" href="contact.php">Liên Hệ</a>
            </li>

        </ul>
        <div class="d-flex">
            
        <?php
                
            define('SITE_URL', 'http://localhost/flight_booking/');
            define('USERS_IMG_PATH', SITE_URL.'image_customer/users/');
            
            if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                $path = USERS_IMG_PATH;
                
                echo<<<data
                
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <img src="$path$_SESSION[uPic]" style="width: 25px; height: 25px;" class="me-1 rounded-circle">
                    Xin Chào, $_SESSION[uName]
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="edit_profile.php"><i class="bi bi-person"></i> Chỉnh sửa hồ sơ</a></li>
                    <li><a class="dropdown-item" href="transaction_list.php"><i class="bi bi-card-list"></i> Danh sách giao dịch</a></li>                  
                    <li><a class="dropdown-item" href="my_bookings.php"><i class="bi bi-box-arrow-in-left"></i> Đặt chỗ của tôi</a></li>                  
                    <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-in-right"></i> Đăng xuất</a></li>
                    </ul>
                </div>

                data;
            }else{
                echo<<<data
                <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Register
                </button>
                data;
            }
            ?>
            
            
            
        </div>
        </div>
    </div>
    </nav>

    <?php
        
        
        require_once __DIR__ . '/../vendor/autoload.php';

    ?>

    <div class="label_list">Danh Sách Chuyến Bay</div>

    <section class="list">
        <div class="list_container">
            <div class="myFlight">
                <div class="myFlight_header">
                    <i class="fa-solid fa-jet-fighter"></i>
                    <p>Chuyến bay của bạn</p>
                </div>
                <div class="myFlight_dep selected_flight">
                    <div class="myFlight_dep-header">
                        <label><span>1</span></label>
                        <div>
                            <?php
                                $datedep = new DateTime($depart);
                                $daydep = $datedep->format('d');
                                $monthdep = $datedep->format('m');
                                $yeardep = $datedep->format('Y');
        
                                $daysOfWeek = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
                                $dayOfWeekdep = $daysOfWeek[$datedep->format('w')];
        
                                echo "<p>$dayOfWeekdep, $daydep thg $monthdep $yeardep</p>";
        
                                foreach (getNameCity($db, $from, $to) as $flight) {
                                    echo '<p>'. $flight['departure_cityName'] .' <i class="fa-solid fa-arrow-right-long"></i> '. $flight['arrival_cityName'] .'</p>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="myFlight_dep-main">
                        <div class="myFlight_dep-main-airline">
                            <img src="../assets/img/vietravel.webp" alt="vietravel">
                            <p>Vietravel Airlines</p>
                        </div>
                        <div class="myFlight_dep-main-info">
                            <div>
                                <p>00:00</p>
                                <label><?php echo htmlspecialchars($from) ?></label>
                            </div>
                            <div>
                                <span></span>
                                <i class="fa-solid fa-plane"></i>
                                <span></span>
                            </div>
                            <div>
                                <p>99:99</p>
                                <label><?php echo htmlspecialchars($to) ?></label>
                            </div>
                            <div>
                                <?php
                                foreach (getNameCity($db, $from, $to) as $flight) {
                                    echo '<p>'. $flight['time'] .'</p>';
                                }
                                ?>
                                <a>Bay thẳng</a>
                            </div>
                        </div>
                        <button>Đổi chuyến bay đi</button>
                    </div>
                </div>
                <?php
                if ($return_date !== '') {
                    echo '
                    <div class="myFlight_return">
                        <div class="myFlight_return-header">
                            <label><span>2</span></label>
                            <div>';
                                $datereturn = new DateTime($return_date);
                                $dayreturn = $datereturn->format('d');
                                $monthreturn = $datereturn->format('m');
                                $yearreturn = $datereturn->format('Y');

                                $dayOfWeekreturn = $daysOfWeek[$datereturn->format('w')];

                                echo "<p>$dayOfWeekreturn, $dayreturn thg $monthreturn $yearreturn</p>";

                                foreach (getNameCity($db, $from, $to) as $flight) {
                                    echo '<p>'. $flight['arrival_cityName'] .' <i class="fa-solid fa-arrow-right-long"></i> '. $flight['departure_cityName'] .'</p>';
                                }
                                echo '
                            </div>
                        </div>
                        <div class="myFlight_return-main">
                            <div class="myFlight_return-main-airline">
                                <img src="../assets/img/vietravel.webp" alt="vietravel">
                                <p>Vietravel Airlines</p>
                            </div>
                            <div class="myFlight_return-main-info">
                                <div>
                                    <p>00:00</p>
                                    <label>'.  htmlspecialchars($from) .'</label>
                                </div>
                                <div>
                                    <span></span>
                                    <i class="fa-solid fa-plane"></i>
                                    <span></span>
                                </div>
                                <div>
                                    <p>99:99</p>
                                    <label>'. htmlspecialchars($to) .'</label>
                                </div>
                                <div>';
                                    foreach (getNameCity($db, $from, $to) as $flight) {
                                        echo '<p>'. $flight['time'] .'</p>';
                                    }
                                    echo '
                                    <a>Bay thẳng</a>
                                </div>
                            </div>
                            <button>Đổi chuyến bay đi</button>
                        </div>
                    </div>';
                }
                ?>
                
            </div>
            <div class="list_filter">
                <h3>Bộ lọc</h3>
                <label class="list_filter-from">Từ</label>
                <select name="" id="list_filter-from">
                    <option value="HAN">Sân bay Nội Bài ( HAN )</option>
                    <option value="SGN">Sân bay Tân Sơn Nhất ( SGN )</option>
                    <option value="DAD">Sân bay Đà Nẵng ( DAD )</option>
                    <option value="VDO">Sân bay Vân Đồn ( VDO )</option>
                    <option value="HPH">Sân bay Cát Bì ( HPH )</option>
                    <option value="VII">Sn bay Vinh ( VII )</option>
                    <option value="HUI">Sân bay Phú Bài ( HUI )</option>
                    <option value="CXR">Sân bay Cam Ranh ( CXR )</option>
                    <option value="DLI">Sân bay Liên Khương ( DLI )</option>
                    <option value="UIH">Sân bay Phù Cát ( UIH )</option>
                    <option value="VCA">Sân bay Cần Thơ ( VCA )</option>
                    <option value="PQC">Sân bay Phú Quốc ( PQC )</option>
                </select>
                <label class="list_filter-to">Đến</label>
                <select name="" id="list_filter-to">
                    <option value="HAN">Sân bay Nội Bài ( HAN )</option>
                    <option value="SGN">Sân bay Tân Sơn Nhất ( SGN )</option>
                    <option value="DAD">Sân bay Đà Nẵng ( DAD )</option>
                    <option value="VDO">Sân bay Vân Đồn ( VDO )</option>
                    <option value="HPH">Sân bay Cát Bì ( HPH )</option>
                    <option value="VII">Sn bay Vinh ( VII )</option>
                    <option value="HUI">Sân bay Phú Bài ( HUI )</option>
                    <option value="CXR">Sân bay Cam Ranh ( CXR )</option>
                    <option value="DLI">Sân bay Liên Khương ( DLI )</option>
                    <option value="UIH">Sân bay Phù Cát ( UIH )</option>
                    <option value="VCA">Sân bay Cần Thơ ( VCA )</option>
                    <option value="PQC">Sân bay Phú Quốc ( PQC )</option>
                </select>
                <label class="list_filter-dateGo">Ngày đi</label>
                <input type="date" name="" id="list_filter-dateGo">
                <div class="list_filter_airline">
                    <div class="list_filter-title" onclick="show_airline()">
                        <label>Hãng hàng không</label>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <?php
                    $unique_airlines = array_unique(array_column($flights, 'airline'));
                    if (!empty($unique_airlines)) {
                        foreach ($unique_airlines as $airline) {
                            if ($airline === "Vietravel Airlines") {
                                echo '
                                    <div class="list_filter_airline-name">
                                        <input type="checkbox" name="vietravel" id="vietravel" class="filter-checkbox" value="vietravel">
                                        <label>Vietravel Airlines</label>
                                    </div>
                                ';
                            } elseif ($airline === "VietJet Air") {
                                echo '
                                    <div class="list_filter_airline-name">
                                        <input type="checkbox" name="vietjet" id="vietjet" class="filter-checkbox" value="vietjet">
                                        <label>VietJet Air</label>
                                    </div>
                                ';
                            } elseif ($airline === "Vietnam Airlines") {
                                echo '
                                    <div class="list_filter_airline-name">
                                        <input type="checkbox" name="vietnam" id="vietnam" class="filter-checkbox" value="vietnam">
                                        <label>Vietnam Airlines</label>
                                    </div>
                                ';
                            }
                        }
                    }
                    ?>
                </div>
                <div class="list_filter_time">
                    <div class="list_filter-title" onclick="flight_time()">
                        <label>Thời gian bay</label>
                        <i class="list_filter-title2 fa-solid fa-angle-down"></i>
                    </div>
                    <div class="list_filter_time-full">
                        <span>Giờ cất cánh</span>
                        <div class="list_filter_time-allDeparture">
                            <div data-time="00:00 - 06:00">
                                <label>Đêm đến Sáng</label>
                                <p>00:00 - 06:00</p>
                            </div>
                            <div data-time="06:00 - 12:00">
                                <label>Sáng đến Trưa</label>
                                <p>06:00 - 12:00</p>
                            </div>
                            <div data-time="12:00 - 18:00">
                                <label>Trưa đến Tuối</label>
                                <p>12:00 - 18:00</p>
                            </div>
                            <div data-time="18:00 - 24:00">
                                <label>Tối đến Đêm</label>
                                <p>18:00 - 24:00</p>
                            </div>
                        </div>
                        <span>Giờ hạ cánh</span>
                        <div class="list_filter_time-allArrival">
                            <div data-time="00:00-06:00">
                                <label>Đêm đến Sáng</label>
                                <p>00:00 - 06:00</p>
                            </div>
                            <div data-time="06:00-12:00">
                                <label>Sáng đến Trưa</label>
                                <p>06:00 - 12:00</p>
                            </div>
                            <div data-time="12:00-18:00">
                                <label>Trưa đến Tối</label>
                                <p>12:00 - 18:00</p>
                            </div>
                            <div data-time="18:00-24:00">
                                <label>Tối đến Đêm</label>
                                <p>18:00 - 24:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($return_date === '') {
            echo '<div class="flight_lists">';
            if (count($flights) > 0) {
                foreach ($flights as $flight) {
                    if ($flight["airline"] === "Vietravel Airlines") {
                        echo '
                        <div class="flight_list vietravel" data-departure="'. htmlspecialchars($flight["departure_time"]) .'" data-arrival="'. htmlspecialchars($flight["arrival_time"]) .'">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="../assets/img/vietravel.webp" alt="">
                                    <p>'. htmlspecialchars($flight["airline"]). '</p>
                                </div>';
                    } elseif ($flight["airline"] === "VietJet Air") {
                        echo '
                        <div class="flight_list vietjet" data-departure="'. htmlspecialchars($flight["departure_time"]) .'" data-arrival="'. htmlspecialchars($flight["arrival_time"]) .'">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="../assets/img/vietjet.webp" alt="">
                                    <p>'. htmlspecialchars($flight["airline"]). '</p>
                                </div>';
                    } elseif ($flight["airline"] === "Vietnam Airlines") {
                        echo '
                        <div class="flight_list vietnam" data-departure="'. htmlspecialchars($flight["departure_time"]) .'" data-arrival="'. htmlspecialchars($flight["arrival_time"]) .'">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="../assets/img/vietnam.webp" alt="">
                                    <p>'. htmlspecialchars($flight["airline"]). '</p>
                                </div>';
                    }
                    echo '
                                <div class="flight_list-info">
                                    <div class="flight_list-from">
                                        <p>'. htmlspecialchars($flight["departure_time"]). '</p>
                                        <p>'. $from. '</p>
                                    </div>
                                    <div class="flight_list-time">
                                        <p>'. htmlspecialchars($flight["time"]). '</p>
                                        <div class="flight_list-timeLength">
                                            <div></div>
                                            <span></span>
                                            <div></div>
                                        </div>
                                        <p>Bay thẳng</p>
                                    </div>
                                    <div class="flight_list-to">
                                        <p>'. htmlspecialchars($flight["arrival_time"]). '</p>
                                        <p>'. $to. '</p>
                                    </div>
                                </div>
                                <div class="flight_list-price">
                                    <p>'. htmlspecialchars($flight["price_adult"]). ' VND<span>/khách</span></p>
                                </div>
                            </div>';
                            if (!function_exists('strToInt')) {
                                function strToInt($str) {
                                    return str_replace('.', '', $str);
                                }
                            }
                            
                            if (!function_exists('intToStr')) {
                                function intToStr($int) {
                                    return number_format((int)$int, 0, '', '.');
                                }
                            }

                            $priceAdult = intToStr(strToInt($flight["price_adult"]) * $countAdult);
                            $priceChild = intToStr(strToInt($flight["price_child"]) * $countChild);
                            $priceInfant = intToStr(strToInt($flight["price_infant"]) * $countInfant);
                            $price = intToStr(strToInt($priceAdult) + strToInt($priceChild) + strToInt($priceInfant));

                        echo '
                            <div class="flight_list-infoOther">
                                <button type="button" onclick="openYourTrip(\''. htmlspecialchars($flight["airline"]) .'\', \''. htmlspecialchars($flight["departure_time"]) .'\', \''. htmlspecialchars($flight["arrival_time"]) .'\', \''. htmlspecialchars($price) .'\', \''. htmlspecialchars($priceAdult) .'\', \''. htmlspecialchars($priceChild) .'\', \''. htmlspecialchars($priceInfant) .'\', \''. htmlspecialchars($flight["flight_code"]) .'\')">Chọn</button>
                            </div>
                        </div>';
                }
            } else {
                echo '<div class="no-result">Không tìm thấy chuyến bay phù hợp</div>';
            }
            echo '
                <div class="no-results">Không tìm thấy chuyến bay phù hợp</div>
            </div>';
        } else {
            if (count($flights) > 0) {
                echo '<div class="flight_lists">';
                foreach ($flights as $flight) {
                    if ($flight["airline"] === "Vietravel Airlines") {
                        echo '
                        <div class="flight_list vietravel" data-departure="'. htmlspecialchars($flight["departure_time"]) .'" data-arrival="'. htmlspecialchars($flight["arrival_time"]) .'">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="../assets/img/vietravel.webp" alt="">
                                    <p>'. htmlspecialchars($flight["airline"]). '</p>
                                </div>';
                    } elseif ($flight["airline"] === "VietJet Air") {
                        echo '
                        <div class="flight_list vietjet" data-departure="'. htmlspecialchars($flight["departure_time"]) .'" data-arrival="'. htmlspecialchars($flight["arrival_time"]) .'">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="../assets/img/vietjet.webp" alt="">
                                    <p>'. htmlspecialchars($flight["airline"]). '</p>
                                </div>';
                    } elseif ($flight["airline"] === "Vietnam Airlines") {
                        echo '
                        <div class="flight_list vietnam" data-departure="'. htmlspecialchars($flight["departure_time"]) .'" data-arrival="'. htmlspecialchars($flight["arrival_time"]) .'">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="../assets/img/vietnam.webp" alt="">
                                    <p>'. htmlspecialchars($flight["airline"]). '</p>
                                </div>';
                    }
                    echo '
                                <div class="flight_list-info">
                                    <div class="flight_list-from">
                                        <p>'. htmlspecialchars($flight["departure_time"]). '</p>
                                        <p>'. $from. '</p>
                                    </div>
                                    <div class="flight_list-time">
                                        <p>'. htmlspecialchars($flight["time"]). '</p>
                                        <div class="flight_list-timeLength">
                                            <div></div>
                                            <span></span>
                                            <div></div>
                                        </div>
                                        <p>Bay thẳng</p>
                                    </div>
                                    <div class="flight_list-to">
                                        <p>'. htmlspecialchars($flight["arrival_time"]). '</p>
                                        <p>'. $to. '</p>
                                    </div>
                                </div>
                                <div class="flight_list-price">
                                    <p>'. htmlspecialchars($flight["price_adult"]). ' VND<span>/khách</span></p>
                                </div>
                            </div>';
                            if (!function_exists('strToInt')) {
                                function strToInt($str) {
                                    return str_replace('.', '', $str);
                                }
                            }
                            
                            if (!function_exists('intToStr')) {
                                function intToStr($int) {
                                    return number_format((int)$int, 0, '', '.');
                                }
                            }

                            $priceAdultdep = intToStr(strToInt($flight["price_adult"]) * $countAdult);
                            $priceChilddep = intToStr(strToInt($flight["price_child"]) * $countChild);
                            $priceInfantdep = intToStr(strToInt($flight["price_infant"]) * $countInfant);
                            $pricedep = intToStr(strToInt($priceAdultdep) + strToInt($priceChilddep) + strToInt($priceInfantdep));

                        echo '
                            <div class="flight_list-infoOther">
                                <button type="button" onclick="chooseFirstFlight(\''. htmlspecialchars($flight["airline"]) .'\', \''. htmlspecialchars($flight["departure_time"]) .'\', \''. htmlspecialchars($flight["arrival_time"]) .'\', \''. htmlspecialchars($pricedep) .'\', \''. htmlspecialchars($priceAdultdep) .'\', \''. htmlspecialchars($priceChilddep) .'\', \''. htmlspecialchars($priceInfantdep) .'\', \''. htmlspecialchars($flight["flight_code"]) .'\')">Chọn</button>
                            </div>
                        </div>';
                }
                echo "</div>";
            } else {
                echo '<div class="no-result dep">Không tìm thấy chuyến bay đi phù hợp</div>';
            }
            if (count($flights_return) > 0) {
                echo '<div class="flight_lists flight_lists-return">';
                foreach ($flights_return as $flight) {
                    if ($flight["airline"] === "Vietravel Airlines") {
                        echo '
                        <div class="flight_list vietravel" data-departure="'. htmlspecialchars($flight["departure_time"]) .'" data-arrival="'. htmlspecialchars($flight["arrival_time"]) .'">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="../assets/img/vietravel.webp" alt="">
                                    <p>'. htmlspecialchars($flight["airline"]). '</p>
                                </div>';
                    } elseif ($flight["airline"] === "VietJet Air") {
                        echo '
                        <div class="flight_list vietjet" data-departure="'. htmlspecialchars($flight["departure_time"]) .'" data-arrival="'. htmlspecialchars($flight["arrival_time"]) .'">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="../assets/img/vietjet.webp" alt="">
                                    <p>'. htmlspecialchars($flight["airline"]). '</p>
                                </div>';
                    } elseif ($flight["airline"] === "Vietnam Airlines") {
                        echo '
                        <div class="flight_list vietnam" data-departure="'. htmlspecialchars($flight["departure_time"]) .'" data-arrival="'. htmlspecialchars($flight["arrival_time"]) .'">
                            <div class="flight_list-main">
                                <div class="flight_list-logo">
                                    <img src="../assets/img/vietnam.webp" alt="">
                                    <p>'. htmlspecialchars($flight["airline"]). '</p>
                                </div>';
                    }
                    echo '
                                <div class="flight_list-info">
                                    <div class="flight_list-from">
                                        <p>'. htmlspecialchars($flight["departure_time"]). '</p>
                                        <p>'. $to. '</p>
                                    </div>
                                    <div class="flight_list-time">
                                        <p>'. htmlspecialchars($flight["time"]). '</p>
                                        <div class="flight_list-timeLength">
                                            <div></div>
                                            <span></span>
                                            <div></div>
                                        </div>
                                        <p>Bay thẳng</p>
                                    </div>
                                    <div class="flight_list-to">
                                        <p>'. htmlspecialchars($flight["arrival_time"]). '</p>
                                        <p>'. $from. '</p>
                                    </div>
                                </div>
                                <div class="flight_list-price">
                                    <p>'. htmlspecialchars($flight["price_adult"]). ' VND<span>/khách</span></p>
                                </div>
                            </div>';
                            if (!function_exists('strToInt')) {
                                function strToInt($str) {
                                    return str_replace('.', '', $str);
                                }
                            }
                            
                            if (!function_exists('intToStr')) {
                                function intToStr($int) {
                                    return number_format((int)$int, 0, '', '.');
                                }
                            }

                            $priceAdultreturn = intToStr(strToInt($flight["price_adult"]) * $countAdult);
                            $priceChildreturn = intToStr(strToInt($flight["price_child"]) * $countChild);
                            $priceInfantreturn = intToStr(strToInt($flight["price_infant"]) * $countInfant);
                            $pricereturn = intToStr(strToInt($priceAdultreturn) + strToInt($priceChildreturn) + strToInt($priceInfantreturn));
                            $priceSum = intToStr(strToInt($pricedep) + strToInt($pricereturn));

                        echo '
                            <div class="flight_list-infoOther">
                                <button type="button" onclick="chooseSecondFlight(\''. htmlspecialchars($flight["airline"]) .'\', \''. htmlspecialchars($flight["departure_time"]) .'\', \''. htmlspecialchars($flight["arrival_time"]) .'\', \''. htmlspecialchars($priceSum) .'\', \''. htmlspecialchars($priceAdultreturn) .'\', \''. htmlspecialchars($priceChildreturn) .'\', \''. htmlspecialchars($priceInfantreturn) .'\', \''. htmlspecialchars($flight["flight_code"]) .'\')">Chọn</button>
                            </div>
                        </div>';
                }
                echo "</div>";
            } else {
                echo '<div class="no-result return">Không tìm thấy chuyến bay về phù hợp</div>';
            }
            echo '<div class="no-results">Không tìm thấy chuyến bay phù hợp</div>';
        }
        ?>

    </section>
    <section class="yourTrip" id="yourTrip">
        <div class="yourTrip_background"></div>
        <form method="get" action="./form_info.php" class="yourTrip_content">
            <div class="yourTrip_content-header">
                <div>
                    <i class="fa-solid fa-xmark yourTrip_content-header-close"></i>
                    <h3 class="yourTrip_content-title">Chuyến đi của bạn</h3>
                </div>
                <div>
                    <i class="fa-regular fa-bookmark"></i>
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
            </div>
            <?php
            if (count($flights_return) != 0) {
                echo '
                <div class="yourTrip_content-myFlight">
                    <p onclick="openMyFlight(this, \''. htmlspecialchars('first-child') .'\', \''. htmlspecialchars('flex') .'\', \''. htmlspecialchars('none') .'\')">Chuyến bay đi</p>
                    <p onclick="openMyFlight(this, \''. htmlspecialchars('last-child') .'\', \''. htmlspecialchars('none') .'\', \''. htmlspecialchars('flex') .'\')">Chuyến bay về</p>
                </div>';
            }
            ?>
            <div class="yourTrip_content-body">
                <div class="yourTrip_content-info">
                    <div class="yourTrip_content-info-content">
                        <div class="yourTrip_content-info-content1">
                            <?php
                                $unique_cityfrom = array_unique(array_column($flights, 'departure_cityName'));
                                if (!empty($unique_cityfrom)) {
                                    foreach ($unique_cityfrom as $city) {
                                        echo '
                                            <p>'. $city. '</p>
                                            <i class="fa-solid fa-arrow-right"></i>';
                                    }
                                }
                                $unique_cityto = array_unique(array_column($flights, 'arrival_cityName'));
                                if (!empty($unique_cityto)) {
                                    foreach ($unique_cityto as $city) {
                                        echo '
                                            <p>'. $city. '</p>';
                                    }
                                }
                                list($year, $month, $day) = explode('-', $depart);
                                echo '<p>Ngày '. $day. ' Tháng ' . $month. ' Năm ' . $year. '</P>';
                            ?>
                        </div>
                        <div class="yourTrip_content-info-content2">
                            <div class="content-info-content2-logo">
                                <img src="../assets/img/vietravel.webp" alt="">
                                <p>Vietravel Airlines</p>
                            </div>
                            <div class="content-info-content2-info">
                                <div class="content2-info-from">
                                    <p>00:00</p>
                                    <p><?php echo htmlspecialchars($from) ?></p>
                                </div>
                                <div class="content2-info-time">
                                    <p><?php echo htmlspecialchars($flight["time"]) ?></p>
                                    <div class="content2-info-timeLength">
                                        <div></div>
                                        <span></span>
                                        <div></div>
                                    </div>
                                    <p>Bay thẳng</p>
                                </div>
                                <div class="content2-info-to">
                                    <p>00:00</p>
                                    <p><?php echo htmlspecialchars($to) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="yourTrip_content-info-content3">Chi tiết</div>
                    </div>
                </div>
                <div class="yourTrip_content-info yourTrip_content-info-return">
                    <div class="yourTrip_content-info-content">
                        <div class="yourTrip_content-info-content1">
                            <?php
                                $unique_cityto = array_unique(array_column($flights, 'arrival_cityName'));
                                if (!empty($unique_cityto)) {
                                    foreach ($unique_cityto as $city) {
                                        echo '
                                            <p>'. $city. '</p>
                                            <i class="fa-solid fa-arrow-right"></i>';
                                    }
                                }
                                $unique_cityfrom = array_unique(array_column($flights, 'departure_cityName'));
                                if (!empty($unique_cityfrom)) {
                                    foreach ($unique_cityfrom as $city) {
                                        echo '
                                            <p>'. $city. '</p>';
                                    }
                                }
                                list($yearReturn, $monthReturn, $dayReturn) = explode('-', $return_date);
                                echo '<p>Ngày '. $dayReturn. ' Tháng ' . $monthReturn. ' Năm ' . $yearReturn. '</P>';
                            ?>
                        </div>
                        <div class="yourTrip_content-info-content2">
                            <div class="content-info-content2-logo">
                                <img src="../assets/img/vietravel.webp" alt="">
                                <p>Vietravel Airlines</p>
                            </div>
                            <div class="content-info-content2-info">
                                <div class="content2-info-from">
                                    <p>00:00</p>
                                    <p><?php echo htmlspecialchars($to) ?></p>
                                </div>
                                <div class="content2-info-time">
                                    <p><?php echo htmlspecialchars($flight["time"]) ?></p>
                                    <div class="content2-info-timeLength">
                                        <div></div>
                                        <span></span>
                                        <div></div>
                                    </div>
                                    <p>Bay thẳng</p>
                                </div>
                                <div class="content2-info-to">
                                    <p>00:00</p>
                                    <p><?php echo htmlspecialchars($from) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="yourTrip_content-info-content3">Chi tiết</div>
                    </div>
                </div>
                <div class="yourTrip_content-info-type">

                </div>
            </div>
            <div class="yourTrip_content-footer">
                <div class="yourTrip_content-footer-left">
                    <i class="fa-solid fa-angle-up"></i>
                    <div>
                        <label>Tổng cộng cho <?php echo htmlspecialchars($count_ticket); ?> khách</label>
                        <p><span></span> VND</p>
                    </div>
                </div>
                <div class="yourTrip_content-footer-btn">
                    <button type="submit">Tiếp tục đặt chỗ</button>
                </div>
            </div>
            <div class="yourTrip_content-footer-list">
                <span></span>
                <?php
                if ($countAdult > 0) {
                    echo '
                        <div class="footer_list-adult">
                            <label>+&nbsp<span></span><p>&nbsp(Người lớn)</p>&nbsp(x'. $countAdult .')</label>
                            <label><p></p>VND</label>
                        </div>';
                }
                if ($countChild > 0) {
                    echo '
                        <div class="footer_list-child">
                            <label>+&nbsp<span></span><p>&nbsp(Trẻ em)</p>&nbsp(x'. $countChild .')</label>
                            <label><p></p>VND</label>
                        </div>';
                }
                if ($countInfant > 0) {
                    echo '
                        <div class="footer_list-infant">
                            <label>+&nbsp<span></span><p>&nbsp(Em bé)</p>&nbsp(x'. $countInfant .')</label>
                            <label><p></p>VND</label>
                        </div>';
                }
                ?>
            </div>
            <?php
            if (count($flights_return) > 0) {
                echo '
                <div class="yourTrip_content-footer-listReturn">
                    <span></span>';
                    if ($countAdult > 0) {
                        echo '
                            <div class="footer_list-adultReturn">
                                <label>+&nbsp<span></span><p>&nbsp(Người lớn)</p>&nbsp(x'. $countAdult .')</label>
                                <label><p></p>VND</label>
                            </div>';
                    }
                    if ($countChild > 0) {
                        echo '
                            <div class="footer_list-childReturn">
                                <label>+&nbsp<span></span><p>&nbsp(Trẻ em)</p>&nbsp(x'. $countChild .')</label>
                                <label><p></p>VND</label>
                            </div>';
                    }
                    if ($countInfant > 0) {
                        echo '
                            <div class="footer_list-infantReturn">
                                <label>+&nbsp<span></span><p>&nbsp(Em bé)</p>&nbsp(x'. $countInfant .')</label>
                                <label><p></p>VND</label>
                            </div>';
                    }
                echo '</div>';
            }
            ?>
            <input type="hidden" name="count_ticket" value="<?php echo htmlspecialchars($count_ticket); ?>">
            <input type="hidden" name="countChild" value="<?php echo htmlspecialchars($countChild); ?>">
            <input type="hidden" name="countAdult" value="<?php echo htmlspecialchars($countAdult); ?>">
            <input type="hidden" name="countInfant" value="<?php echo htmlspecialchars($countInfant); ?>">
            <input type="hidden" name="fromName" value="<?php echo htmlspecialchars($flight["departure_cityName"]); ?>">
            <input type="hidden" name="toName" value="<?php echo htmlspecialchars($flight["arrival_cityName"]); ?>">
            <input type="hidden" name="from" value="<?php echo htmlspecialchars($from); ?>">
            <input type="hidden" name="to" value="<?php echo htmlspecialchars($to); ?>">
            <input type="hidden" name="date" value="<?php echo htmlspecialchars($depart); ?>">
            <input type="hidden" name="airline" id="airline">
            <input type="hidden" name="chairType" value="<?php echo htmlspecialchars($_GET["chairType"]); ?>">
            <input type="hidden" name="time" value="<?php echo htmlspecialchars($flight["time"]); ?>">
            <input type="hidden" name="departure_time" id="departure_time">
            <input type="hidden" name="arrival_time" id="arrival_time">
            <input type="hidden" name="flight_code" id="flight_code">
            <input type="hidden" name="price" id="price">

            <?php
            if (count($flights_return) > 0) {
                echo '
                    <input type="hidden" name="return_date" value="'. htmlspecialchars($return_date) .'">
                    <input type="hidden" name="flight_codeReturn" id="flight_codeReturn">
                    <input type="hidden" name="airlineReturn" id="airlineReturn">';
            }
            ?>
        </form>
    </section>

    <script src="../assets/js/flight_list.js"></script>
</body>
</html>