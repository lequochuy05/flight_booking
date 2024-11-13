<?php
session_start();
require('../model/database.php');
require('../model/flight_list_db.php');

$countAdult = $_GET['countAdult'];
$countChild = $_GET['countChild'];
$countInfant = $_GET['countInfant'];
$fromName = $_GET['fromName'];
$toName = $_GET['toName'];
$date = $_GET['date'];
$airline = $_GET['airline'];
$chairType = $_GET['chairType'];
$from = $_GET['from'];
$to = $_GET['to'];
$time = $_GET['time'];
$departure_time = $_GET['departure_time'];
$arrival_time = $_GET['arrival_time'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Infomation</title>
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/form_info.css">
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

    <form method="post" style="display: flex; background-color: rgb(247 249 250);" action="./pay.php" id="form_info">
        <div>
            <section class="title">
                <h2>Đặt chỗ của tôi</h2>
                <p>Điền thông tin và xem lại đặt chỗ</p>
            </section>
            <section class="contact_info">
                <h2 class="contact_info-title">Thông tin liên hệ</h2>
                <div class="contact_info-content">
                    <div class="contact_info-content-header">
                        <h4>Thông tin liên hệ (nhận vé/phiếu thanh toán)</h4>
                        <p onclick="saveContact()">Lưu</p>
                    </div>
                    <div class="contact_info-content-main">
                        <div class="contact_info-content-firtName">
                            <p>Họ (vd:Nguyen)<span>*</span></p>
                            <input type="text" name="contact_firtName" id="contact_firtName">
                            <p>như trên CCCD (không dấu)</p>
                        </div>
                        <div class="contact_info-content-lastName">
                            <p>Tên Đệm và Tên (vd: Van A)<span>*</span></p>
                            <input type="text" name="contact_lastName" id="contact_lastName">
                            <p>như trên CCCD (không dấu)</p>
                        </div>
                        <div class="contact_info-content-phone">
                            <p>Điện thoại di động<span>*</span></p>
                            <input type="text" name="contact_phone">
                            <p>VD: +84 981669045 trong đó (+84) là mã vùng quốc gia và 981669045 là số di động</p>
                        </div>
                        <div class="contact_info-content-email">
                            <p>Email<span>*</span></p>
                            <input type="text" name="contact_email">
                            <p>VD: email@example.com</p>
                        </div>
                    </div>
                </div>
                <div class="contact_info-content1">
                    <div class="contact_info-content1-header">
                        <h4>None</h4>
                        <p onclick="openItem('.contact_info-content', '.contact_info-content1')">Chỉnh sửa chi tiết</p>
                    </div>
                    <div class="contact_info-content1-main">
                        <div class="contact_info-content1-phone">
                            <p>Số di động</p>
                            <label>None</label>
                        </div>
                        <div class="contact_info-content1-email">
                            <p>Email</p>
                            <label>None</label>
                        </div>
                    </div>
                </div>
            </section>
            <section class="customer_info">
                <h2>Thông tin khách hàng</h2>
                <input type="hidden" name="countAdult" value="<?php echo $countAdult; ?>">
                <input type="hidden" name="countChild" value="<?php echo $countChild; ?>">
                <input type="hidden" name="countInfant" value="<?php echo $countInfant; ?>">
                <?php
                for ($i = 0; $i < $countAdult; $i++) {
                    echo '
                    <div class="customer_info-content Adult'. $i .'">
                        <div class="customer_info-content-header">
                            <h4>Người lớn '. $i +1 .'</h4>
                            <p onclick="saveCustomer(\'Adult'. $i .'\')">Lưu</p>
                        </div>
                        <div class="customer_info-content-main">
                            <div class="customer_info-content1">
                                <p>Danh xưng<span>*</span></p>
                                <select name="title_Adult'. $i .'" class="customer_info-content1Input title_Adult'. $i .'">
                                    <option value="Ông">Ông</option>
                                    <option value="Bà">Bà</option>
                                    <option value="Cô">Cô</option>
                                </select>
                            </div>
                            <div class="customer_info-content-main2">
                                <div>
                                    <p>Họ (vd:Nguyen)<span>*</span></p>
                                    <input type="text" name="firstName_Adult'. $i .'" class="firstName_Adult'. $i .'">
                                    <p>như trên CCCD (không dấu)</p>
                                </div>
                                <div>
                                    <p>Tên Đệm và Tên (vd: Van A)<span>*</span></p>
                                    <input type="text" name="lastName_Adult'. $i .'" class="lastName_Adult'. $i .'">
                                    <p>như trên CCCD (không dấu)</p>
                                </div>
                                <div class="customer_info-content-main2Date">
                                    <p>Ngày sinh<span>*</span></p>
                                    <div>
                                        <select name="day_Adult'. $i .'" class="day_Adult'. $i .'">
                                            <option value=""></option>';
                                            for ($j = 1; $j < 32; $j++) {
                                                echo '<option value="'.$j.'">'.$j.'</option>';
                                            }
                    echo '
                                        </select>
                                        <select name="month_Adult'. $i .'" class="month_Adult'. $i .'">
                                            <option value=""></option>';
                                            for ($k = 1; $k < 13; $k++) {
                                                echo '<option value="'.$k.'">Tháng '.$k.'</option>';
                                            }
                    echo '
                                        </select>
                                        <select name="year_Adult'. $i .'" class="year_Adult'. $i .'">
                                            <option value=""></option>';
                                            for ($h = 1924; $h < 2013; $h++) {
                                                echo '<option value="'.$h.'">'.$h.'</option>';
                                            }
                    echo '
                                        </select>
                                    </div>
                                    <p>Hành khách người lớn (trên 12 tuổi)</p>
                                </div>
                                <div class="customer_info-content-main2nation">
                                    <p>Quốc tịch<span>*</span></p>
                                    <select name="nation_Adult'. $i .'" class="nation_Adult'. $i .'">
                                        <option value=""></option>
                                        <option value="Viet Nam">Viet Nam</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customer_info-content2 Adult'. $i .'">
                        <div class="customer_info-content2-header Adult'. $i .'">
                            <h4>None</h4>
                            <p onclick="openItem(\'.customer_info-content.Adult'. $i .'\', \'.customer_info-content2.Adult'. $i .'\')">Chỉnh sửa chi tiết</p>
                        </div>
                        <div class="customer_info-content2-main">
                            <div class="customer_info-content2-main1Adult'. $i .'">
                                <p>Ngày sinh</p>
                                <label>None</label>
                            </div>
                            <div class="customer_info-content2-main2Adult'. $i .' ">
                                <p>Quốc tịch</p>
                                <label>None</label>
                            </div>
                        </div>
                    </div>';
                }
                for ($i = 0; $i < $countChild; $i++) {
                    echo '
                    <div class="customer_info-content Child'. $i .'">
                        <div class="customer_info-content-header">
                            <h4>Trẻ em '. $i +1 .'</h4>
                            <p onclick="saveCustomer(\'Child'. $i .'\')">Lưu</p>
                        </div>
                        <div class="customer_info-content-main">
                            <div class="customer_info-content1">
                                <p>Danh xưng<span>*</span></p>
                                <select name="title_Child'. $i .'" class="customer_info-content1Input title_Child'. $i .'">
                                    <option value="Ông">Ông</option>
                                    <option value="Cô">Cô</option>
                                </select>
                            </div>
                            <div class="customer_info-content-main2">
                                <div>
                                    <p>Họ (vd:Nguyen)<span>*</span></p>
                                    <input type="text" name="firstName_Child'. $i .'" class="firstName_Child'. $i .'">
                                    <p>như trên CCCD (không dấu)</p>
                                </div>
                                <div>
                                    <p>Tên Đệm và Tên (vd: Van A)<span>*</span></p>
                                    <input type="text" name="lastName_Child'. $i .'" class="lastName_Child'. $i .'">
                                    <p>như trên CCCD (không dấu)</p>
                                </div>
                                <div class="customer_info-content-main2Date">
                                    <p>Ngày sinh<span>*</span></p>
                                    <div>
                                        <select name="day_Child'. $i .'" class="day_Child'. $i .'">
                                            <option value=""></option>';
                                            for ($j = 1; $j < 32; $j++) {
                                                echo '<option value="'.$j.'">'.$j.'</option>';
                                            }
                    echo '
                                        </select>
                                        <select name="month_Child'. $i .'" class="month_Child'. $i .'">
                                            <option value=""></option>';
                                            for ($k = 1; $k < 13; $k++) {
                                                echo '<option value="'.$k.'">Tháng '.$k.'</option>';
                                            }
                    echo '
                                        </select>
                                        <select name="year_Child'. $i .'" class="year_Child'. $i .'">
                                            <option value=""></option>';
                                            for ($h = 2012; $h < 2022; $h++) {
                                                echo '<option value="'.$h.'">'.$h.'</option>';
                                            }
                    echo '
                                        </select>
                                    </div>
                                    <p>Hành khách trẻ em (từ 2 - 11 tuổi)</p>
                                </div>
                                <div class="customer_info-content-main2nation">
                                    <p>Quốc tịch<span>*</span></p>
                                    <select name="nation_Child'. $i .'" class="nation_Child'. $i .' ">
                                        <option value=""></option>
                                        <option value="Việt Nam">Viet Nam</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customer_info-content2 Child'. $i .'">
                        <div class="customer_info-content2-header Child'. $i .'">
                            <h4>None</h4>
                            <p onclick="openItem(\'.customer_info-content.Child'. $i .'\', \'.customer_info-content2.Child'. $i .'\')">Chỉnh sửa chi tiết</p>
                        </div>
                        <div class="customer_info-content2-main">
                            <div class="customer_info-content2-main1Child'. $i .'">
                                <p>Ngày sinh</p>
                                <label>None</label>
                            </div>
                            <div class="customer_info-content2-main2Child'. $i .' ">
                                <p>Quốc tịch</p>
                                <label>None</label>
                            </div>
                        </div>
                    </div>';
                }
                for ($i = 0; $i < $countInfant; $i++) {
                    echo '
                    <div class="customer_info-content Infant'. $i .'">
                        <div class="customer_info-content-header">
                            <h4>Em bé '. $i +1 .'</h4>
                            <p onclick="saveCustomer(\'Infant'. $i .'\')">Lưu</p>
                        </div>
                        <div class="customer_info-content-main">
                            <div class="customer_info-content1">
                                <p>Danh xưng<span>*</span></p>
                                <select name="title_Infant'. $i .'" class="customer_info-content1Input title_Infant'. $i .'">
                                    <option value="Ông">Ông</option>
                                    <option value="Cô">Cô</option>
                                </select>
                            </div>
                            <div class="customer_info-content-main2">
                                <div>
                                    <p>Họ (vd:Nguyen)<span>*</span></p>
                                    <input type="text" name="firstName_Infant'. $i .'" class="firstName_Infant'. $i .'">
                                    <p>như trên CCCD (không dấu)</p>
                                </div>
                                <div>
                                    <p>Tên Đệm và Tên (vd: Van A)<span>*</span></p>
                                    <input type="text" name="lastName_Infant'. $i .'" class="lastName_Infant'. $i .'">
                                    <p>như trên CCCD (không dấu)</p>
                                </div>
                                <div class="customer_info-content-main2Date">
                                    <p>Ngày sinh<span>*</span></p>
                                    <div>
                                        <select name="day_Infant'. $i .'" class="day_Infant'. $i .'">
                                            <option value=""></option>';
                                            for ($j = 1; $j < 32; $j++) {
                                                echo '<option value="'.$j.'">'.$j.'</option>';
                                            }
                    echo '
                                        </select>
                                        <select name="month_Infant'. $i .'" class="month_Infant'. $i .'">
                                            <option value=""></option>';
                                            for ($k = 1; $k < 13; $k++) {
                                                echo '<option value="'.$k.'">Tháng '.$k.'</option>';
                                            }
                    echo '
                                        </select>
                                        <select name="year_Infant'. $i .'" class="year_Infant'. $i .'">
                                            <option value=""></option>';
                                            for ($h = 2022; $h < 2024; $h++) {
                                                echo '<option value="'.$h.'">'.$h.'</option>';
                                            }
                    echo '
                                        </select>
                                    </div>
                                    <p>Hành khách trẻ sơ sinh (dưới 2 tuổi)</p>
                                </div>
                                <div class="customer_info-content-main2nation">
                                    <p>Quốc tịch<span>*</span></p>
                                    <select name="nation_Infant'. $i .'" class="nation_Infant'. $i .'">
                                        <option value=""></option>
                                        <option value="Viet Nam">Viet Nam</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customer_info-content2 Infant'. $i .'">
                        <div class="customer_info-content2-header Infant'. $i .'">
                            <h4>None</h4>
                            <p onclick="openItem(\'.customer_info-content.Infant'. $i .'\', \'.customer_info-content2.Infant'. $i .'\')">Chỉnh sửa chi tiết</p>
                        </div>
                        <div class="customer_info-content2-main">
                            <div class="customer_info-content2-main1Infant'. $i .'">
                                <p>Ngày sinh</p>
                                <label>None</label>
                            </div>
                            <div class="customer_info-content2-main2Infant'. $i .' ">
                                <p>Quốc tịch</p>
                                <label>None</label>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </section>
            <section class="btn customer_info-btn">
                <button type="button" onclick="<?php 
                for ($i = 0; $i < $countAdult; $i++) {
                    echo 'saveCustomer(\'Adult'. $i .'\');';
                }
                for ($i = 0; $i < $countChild; $i++) {
                    echo 'saveCustomer(\'Child'. $i .'\');';
                }
                for ($i = 0; $i < $countInfant; $i++) {
                    echo 'saveCustomer(\'Infant'. $i .'\');';
                }
                ?> saveContact(); openbuttonChair();">Tiếp tục</button>
            </section>
            <section class="choose_chair">
                <div class="choose_chair-main">
                    <h2>Chọn ghế</h2>
                    <div class="choose_chair-content-header">
                        <div>
                            <i class="fa-solid fa-wheelchair"></i>
                            <h4>Số ghế</h4>
                        </div>
                        <p onclick="openselectedChair()">Chọn ghế</p>
                    </div>
                    <div class="choose_chair-content-main">
                        <p>Cửa sổ hay lối đi? Chọn chỗ ngồi tốt nhất giúp bạn thoải mái suốt chuyến đi.</p>
                    </div>
                </div>
                <div class="choose_chair-main btn">
                    <button onclick="checkChooseChair(<?php echo htmlspecialchars($countAdult) ?>, <?php echo htmlspecialchars($countChild) ?>, <?php echo htmlspecialchars($countInfant) ?>, event)">Tiếp tục</button>
                </div>
            </section>
        </div>
        <section class="choose_chairDetail">
            <div class="choose_chairDetail-content">
                <div class="choose_chairDetail-content-header">
                    <div>
                        <i class="fa-solid fa-wheelchair"></i>
                        <h2>Số ghế</h2>
                    </div>
                    <i onclick="closeSelectedChair()" class="fa-solid fa-xmark"></i>
                </div>
                <div class="choose_chairDetail-content-info">
                    <?php
                    if (isset($_GET['return_date'])) {
                        echo '
                        <div class="chairDetail-content-infoAddress">
                            <p>Chuyến bay 1 trong 2</p>
                            <p>'. $_GET['fromName'] . ' (' . $_GET['from'] . ')</p>
                            <i class="fa-solid fa-arrow-right-long"></i>
                            <p>'. $_GET['toName'] . ' (' . htmlspecialchars($_GET['to']) . ')</p>
                        </div>
                        <div class="chairDetail-content-infoAirline">
                            <p>'. htmlspecialchars($_GET['airline']) .'</p>
                            <label></label>
                            <p>'. htmlspecialchars($_GET['chairType']) .'</p>
                            <label></label>
                            <p>'. htmlspecialchars($_GET['time']) .'</p>
                        </div>
                        <div class="chairDetail-content-infoAddress chairDetail-content-infoAddressReturn">
                            <p>Chuyến bay 1 trong 2</p>
                            <p>'. $_GET['toName'] . ' (' . $_GET['to'] . ')</p>
                            <i class="fa-solid fa-arrow-right-long"></i>
                            <p>'. $_GET['fromName'] . ' (' . htmlspecialchars($_GET['from']) . ')</p>
                        </div>
                        <div class="chairDetail-content-infoAirline chairDetail-content-infoAirlineReturn">
                            <p>'. htmlspecialchars($_GET['airlineReturn']) .'</p>
                            <label></label>
                            <p>'. htmlspecialchars($_GET['chairType']) .'</p>
                            <label></label>
                            <p>'. htmlspecialchars($_GET['time']) .'</p>
                        </div>';
                    } else {
                        echo '
                        <div class="chairDetail-content-infoAddress">
                            <p>Chuyến bay 1 trong 1</p>
                            <p>'. $_GET['fromName'] . ' (' . $_GET['from'] . ')</p>
                            <i class="fa-solid fa-arrow-right-long"></i>
                            <p>'. $_GET['toName'] . ' (' . htmlspecialchars($_GET['to']) . ')</p>
                        </div>
                        <div class="chairDetail-content-infoAirline">
                            <p>'. htmlspecialchars($_GET['airline']) .'</p>
                            <label></label>
                            <p>'. htmlspecialchars($_GET['chairType']) .'</p>
                            <label></label>
                            <p>'. htmlspecialchars($_GET['time']) .'</p>
                        </div>';
                    }
                    ?>
                </div>
                <div class="choose_chairDetail-content-main">
                    <div class="chairDetail_content-main-left">
                        <?php
                        $customerSTT = 1;
                        echo '
                        <div class="chairDetail_content-main-leftAdult0 selected_chair" onclick="selectedChair(this)">
                            <article><p>1</p>. <span></span></article>
                            <label>Không chọn</label>
                            <input type="hidden" name="chair_Adult0">
                        </div>';
                        for ($i = 1; $i < $countAdult; $i++) {
                            $customerSTT ++;
                            echo '
                            <div class="chairDetail_content-main-leftAdult'. $i .'" onclick="selectedChair(this)">
                                <article><p>'. $customerSTT .'</p>. <span></span></article>
                                <label>Không chọn</label>
                                <input type="hidden" name="chair_Adult'. $i .'">
                            </div>';
                        }
                        for ($i = 0; $i < $countChild; $i++) {
                            $customerSTT ++;
                            echo '
                            <div class="chairDetail_content-main-leftChild'. $i .'" onclick="selectedChair(this)">
                                <article><p>'. $customerSTT .'</p>. <span></span></article>
                                <label>Không chọn</label>
                                <input type="hidden" name="chair_Child'. $i .'">
                            </div>';
                        }
                        for ($i = 0; $i < $countInfant; $i++) {
                            $customerSTT ++;
                            echo '
                            <div class="chairDetail_content-main-leftInfant'. $i .'" onclick="selectedChair(this)">
                                <article><p>'. $customerSTT .'</p>. <span></span></article>
                                <label>Không chọn</label>
                                <input type="hidden" name="chair_Infant'. $i .'">
                            </div>';
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($_GET['return_date'])) {
                        $customerSTT = 1;
                        echo '
                        <div class="chairDetail_content-main-left chairDetail_content-main-leftReturn">
                            <div class="chairDetail_content-main-leftAdult0 selected_chair2" onclick="selectedChair2(this)">
                                <article><p>1</p>. <span></span></article>
                                <label>Không chọn</label>
                                <input type="hidden" name="chair_Adult0">
                            </div>';
                            for ($i = 1; $i < $countAdult; $i++) {
                                $customerSTT ++;
                                echo '
                                <div class="chairDetail_content-main-leftAdult'. $i .'" onclick="selectedChair2(this)">
                                    <article><p>'. $customerSTT .'</p>. <span></span></article>
                                    <label>Không chọn</label>
                                    <input type="hidden" name="chair_Adult'. $i .'">
                                </div>';
                            }
                            for ($i = 0; $i < $countChild; $i++) {
                                $customerSTT ++;
                                echo '
                                <div class="chairDetail_content-main-leftChild'. $i .'" onclick="selectedChair2(this)">
                                    <article><p>'. $customerSTT .'</p>. <span></span></article>
                                    <label>Không chọn</label>
                                    <input type="hidden" name="chair_Child'. $i .'">
                                </div>';
                            }
                            for ($i = 0; $i < $countInfant; $i++) {
                                $customerSTT ++;
                                echo '
                                <div class="chairDetail_content-main-leftInfant'. $i .'" onclick="selectedChair2(this)">
                                    <article><p>'. $customerSTT .'</p>. <span></span></article>
                                    <label>Không chọn</label>
                                    <input type="hidden" name="chair_Infant'. $i .'">
                                </div>';
                            }
                        echo '</div>';
                    }
                    ?>
                    <div class="chairDetail_content-main-right">
                        <?php
                        if (isset($_GET['return_date'])) {
                            echo '
                            <div class="chairDetail_content-main-right-myFlight">
                                <p onclick="openChairMyFlight(this, \''. htmlspecialchars('last-child') .'\', \''. htmlspecialchars('inline-block') .'\', \''. htmlspecialchars('none') .'\', \''. htmlspecialchars('flex') .'\', \''. htmlspecialchars('none') .'\')">Chuyến bay đi</p>
                                <p onclick="openChairMyFlight(this, \''. htmlspecialchars('first-child') .'\', \''. htmlspecialchars('none') .'\', \''. htmlspecialchars('inline-block') .'\', \''. htmlspecialchars('none') .'\', \''. htmlspecialchars('flex') .'\')">Chuyến bay về</p>
                            </div>';
                        }
                        ?>
                        <div class="chairDetail_content-main-right-note">
                            <div class="chairDetail_content-main-right-noteItem">
                                <div class="squareX">X</div>
                                <p>Đã đặt</p>
                            </div>
                            <div class="chairDetail_content-main-right-noteItem">
                                <div class="square"></div>
                                <p>Chưa đặt</p>
                            </div>
                            <div class="chairDetail_content-main-right-noteItem">
                                <div class="squareV"></div>
                                <p>Đang chờ thanh toán</p>
                            </div>
                        </div>
                        <?php
                        if ($_GET['chairType'] === 'Business Class') {
                            echo '
                            <table class="chairDetail_content-main-right-chairDep">
                                <thead>
                                    <tr>
                                        <td>A</td>
                                        <td>B</td>
                                        <td></td>
                                        <td>C</td>
                                        <td>D</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>';
                                        $count = 0;
                                        $stt = 1;
                                        $temp = 1;
                                        $chair_numbers = get_chairType($db, $_GET['flight_code'], $_GET['chairType']);
                                        foreach ($chair_numbers as $chair_number) {
                                            $count++;
                                            if ($chair_number['status'] == 'Đã đặt') {
                                                echo '<td><span class="squareX">X</span></td>';
                                            } else if ($chair_number['status'] == 'Chưa đặt') {
                                                echo '<td><span onclick="chooseChair(\''. $chair_number['chair_number'] .'\')" class="square '. $chair_number['chair_number'] .'"></span></td>';
                                            } else if ($chair_number['status'] == 'Chờ thanh toán') {
                                                echo '<td><span class="squareV"></span></td>';
                                            }
                                        
                                            if ($temp == 2) {
                                                echo '<td>'. $stt .'</td>';
                                                $stt++;
                                            }
                                        
                                            $temp++;
                                        
                                            if ($count % 4 == 0) {
                                                echo "</tr><tr>";
                                                $temp = 1;
                                            }
                                        }
                                        echo '
                                    </tr>
                                </tbody>
                            </table>';
                        } else {
                            echo '
                            <table class="chairDetail_content-main-right-chairDep">
                                <thead>
                                    <tr>
                                        <td>A</td>
                                        <td>B</td>
                                        <td>C</td>
                                        <td></td>
                                        <td>D</td>
                                        <td>E</td>
                                        <td>F</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>';
                                        $count = 0;
                                        $stt = 1;
                                        $temp = 1;
                                        $chair_numbers = get_chairType($db, $_GET['flight_code'], $_GET['chairType']);
                                        foreach ($chair_numbers as $chair_number) {
                                            $count++;
                                            if ($chair_number['status'] == 'Đã đặt') {
                                                echo '<td><span class="squareX">X</span></td>';
                                            } else if ($chair_number['status'] == 'Chưa đặt') {
                                                echo '<td><span onclick="chooseChair(\''. $chair_number['chair_number'] .'\')" class="square '. $chair_number['chair_number'] .'"></span></td>';
                                            } else if ($chair_number['status'] == 'Chờ thanh toán') {
                                                echo '<td><span class="squareV"></span></td>';
                                            }
                                        
                                            if ($temp == 3) {
                                                echo '<td>'. $stt .'</td>';
                                                $stt++;
                                            }
                                        
                                            $temp++;
                                        
                                            if ($count % 6 == 0) {
                                                echo "</tr><tr>";
                                                $temp = 1;
                                            }
                                        }
                                        echo '
                                    </tr>
                                </tbody>
                            </table>';
                        }
                        if (isset($_GET['return_date'])) {
                            if ($_GET['chairType'] === 'Business Class') {
                                echo '
                                <table class="chairDetail_content-main-right-chairReturn">
                                    <thead>
                                        <tr>
                                            <td>A</td>
                                            <td>B</td>
                                            <td></td>
                                            <td>C</td>
                                            <td>D</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>';
                                            $count = 0;
                                            $stt = 1;
                                            $temp = 1;
                                            $chair_numbers = get_chairType($db, $_GET['flight_codeReturn'], $_GET['chairType']);
                                            foreach ($chair_numbers as $chair_number) {
                                                $count++;
                                                if ($chair_number['status'] == 'Đã đặt') {
                                                    echo '<td><span class="squareX">X</span></td>';
                                                } else if ($chair_number['status'] == 'Chưa đặt') {
                                                    echo '<td><span onclick="chooseChair(\''. $chair_number['chair_number'] .'\')" class="square '. $chair_number['chair_number'] .'"></span></td>';
                                                } else if ($chair_number['status'] == 'Chờ thanh toán') {
                                                    echo '<td><span class="squareV"></span></td>';
                                                }
                                            
                                                if ($temp == 2) {
                                                    echo '<td>'. $stt .'</td>';
                                                    $stt++;
                                                }
                                            
                                                $temp++;
                                            
                                                if ($count % 4 == 0) {
                                                    echo "</tr><tr>";
                                                    $temp = 1;
                                                }
                                            }
                                            echo '
                                        </tr>
                                    </tbody>
                                </table>';
                            } else {
                                echo '
                                <table class="chairDetail_content-main-right-chairReturn">
                                    <thead>
                                        <tr>
                                            <td>A</td>
                                            <td>B</td>
                                            <td>C</td>
                                            <td></td>
                                            <td>D</td>
                                            <td>E</td>
                                            <td>F</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>';
                                            $count = 0;
                                            $stt = 1;
                                            $temp = 1;
                                            $chair_numbers = get_chairType($db, $_GET['flight_codeReturn'], $_GET['chairType']);
                                            foreach ($chair_numbers as $chair_number) {
                                                $count++;
                                                if ($chair_number['status'] == 'Đã đặt') {
                                                    echo '<td><span class="squareX">X</span></td>';
                                                } else if ($chair_number['status'] == 'Chưa đặt') {
                                                    echo '<td><span onclick="chooseChair(\''. $chair_number['chair_number'] .'\')" class="square '. $chair_number['chair_number'] .'"></span></td>';
                                                } else if ($chair_number['status'] == 'Chờ thanh toán') {
                                                    echo '<td><span class="squareV"></span></td>';
                                                }
                                            
                                                if ($temp == 3) {
                                                    echo '<td>'. $stt .'</td>';
                                                    $stt++;
                                                }
                                            
                                                $temp++;
                                            
                                                if ($count % 6 == 0) {
                                                    echo "</tr><tr>";
                                                    $temp = 1;
                                                }
                                            }
                                            echo '
                                        </tr>
                                    </tbody>
                                </table>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="choose_chairDetail-content-footer">
                    <div class="chairDetail-content-footer-price">
                        <div>
                            <h2>Tổng</h2>
                            <h2><?php echo htmlspecialchars($_GET['price']) ?>&nbsp;VND</h2>
                        </div>
                        <p>(Tất cả chuyến bay và hành khách)</p>
                    </div>
                    <button type="button" onclick="<?php 
                    for ($i = 0; $i < $countAdult; $i++) {
                        echo 'doneSelectedChair(\'chairDetail_content-main-leftAdult'. $i .'\');';
                    }
                    for ($i = 0; $i < $countChild; $i++) {
                        echo 'doneSelectedChair(\'chairDetail_content-main-leftChild'. $i .'\');';
                    }
                    for ($i = 0; $i < $countInfant; $i++) {
                        echo 'doneSelectedChair(\'chairDetail_content-main-leftInfant'. $i .'\');';
                    }
                    ?>">Xong</button>
                </div>
            </div>
        </section>
        <section class="flight_info">
            <div class="flight_info-header">
                <i class="fa-solid fa-plane-departure"></i>
                <?php
                echo '
                    <p>'. htmlspecialchars($fromName) .'</p>
                    <i class="fa-solid fa-arrow-right" style="margin: 0 8px;"></i>
                    <p>'. htmlspecialchars($toName) .'</p>'; 
                ?>
            </div>
            <div class="flight_info-content">
                <?php 
                list($year, $month, $day) = explode('-', $date);
                echo '<p>Chuyến bay đi <span>Ngày '.$day.' Tháng '.$month.' Năm '.$year.'</span></p>';
                ?>
                <div class="flight_info-content-airline">
                    <?php
                    if ($airline == 'Vietravel Airlines') {
                        echo '
                        <img src="../assets/img/vietravel.webp" alt="">
                        <div>
                            <p>Vietravel Airlines</p>
                            <p>'. htmlspecialchars($chairType) .'</p>
                        </div>';
                    } else if ($airline == 'VietJet Air') {
                        echo '
                        <img src="../assets/img/vietjet.webp" alt="">
                        <div>
                            <p>VietJet Air</p>
                            <p>'. htmlspecialchars($chairType) .'</p>
                        </div>';
                    } else if ($airline == 'Vietnam Airlines') {
                        echo '
                        <img src="../assets/img/vietnam.webp" alt="">
                        <div>
                            <p>Vietnam Airlines</p>
                            <p>'. htmlspecialchars($chairType) .'</p>
                        </div>';
                    }
                    ?> 
                </div>
                <div class="content-info-content2-info">
                    <div class="content2-info-from">
                        <p><?php echo htmlspecialchars($departure_time) ?></p>
                        <p><?php echo htmlspecialchars($from) ?></p>
                    </div>
                    <div class="content2-info-time">
                        <p><?php echo htmlspecialchars($time) ?></p>
                        <div class="content2-info-timeLength">
                            <div></div>
                            <span></span>
                            <div></div>
                        </div>
                        <p>Bay thẳng</p>
                    </div>
                    <div class="content2-info-to">
                        <p><?php echo htmlspecialchars($arrival_time) ?></p>
                        <p><?php echo htmlspecialchars($to) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <input type="hidden" name="flight_code" value="<?php echo htmlspecialchars($_GET['flight_code'])?>">
        <input type="hidden" name="userName" value="<?php echo htmlspecialchars($_SESSION['userName']) ?>">
        <input type="hidden" name="price" value="<?php echo htmlspecialchars($_GET['price']) ?>">
        <input type="hidden" name="chairType" value="<?php echo htmlspecialchars($chairType) ?>">

    </form>

    
    <script src="../assets/js/form_info.js"></script>
</body>
</html>