<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="assets/css/common.css">
    <?php 
            require("inc/links.php");
    ?>

    <title>Giao dịch của tôi</title>
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
            font-size: 16px;
            color: #007bff;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filters button {
            padding: 8px 16px;
            border: 1px solid #007bff;
            background: #fff;
            border-radius: 5px;
            color: #007bff;
            cursor: pointer;
        }

        .filters button.active {
            background: #007bff;
            color: #fff;
        }

        .filters button:hover {
            background: #0056b3;
            color: #fff;
        }

        .empty-box {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .empty-box img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .empty-box p {
            font-size: 16px;
            margin: 0;
        }

        .empty-box a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .empty-box a:hover {
            text-decoration: underline;
        }
        .date-input {
            padding: 8px;
            margin: 0 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-apply {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-apply:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body class="bg-light">
    <?php 
        include("inc/header.php");
        if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
            redirect('index.php');
        }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">Lịch sử giao dịch</h2>
                <div style="font-size: 14px">
                    <a href="index.php" class="text-secondary text-decoration-none">Trang chủ</a>
                    <span class="text-secondary"> ></span>
                    <a href="#" class="text-secondary text-decoration-none">Giao dịch của tôi</a>
                </div>     
            </div>       
            
            <div class="header">
                <span>Xem tất cả vé máy bay và phiếu thanh toán trong <a href="my_bookings.php">Đặt chỗ của tôi</a></span>
            </div>

            <div class="filters">
                <button class="filter-btn active" data-range="90-days">90 ngày qua</button>
                <button class="filter-btn" data-month="10-2024">Tháng 10 2024</button>
                <button class="filter-btn" data-month="9-2024">Tháng 9 2024</button>
                <button class="filter-btn" data-range="custom">Ngày tùy chọn</button>
            </div>

            <!-- Bộ lọc ngày tùy chọn -->
            <div id="custom-range" style="margin-top: 20px; display: none;">
                <label for="start-date">Từ:</label>
                <input type="date" id="start-date" class="date-input">
                <label for="end-date">Đến:</label>
                <input type="date" id="end-date" class="date-input">
                <button id="apply-filter" class="btn-apply">Lọc</button>
            </div>

            <!-- Kết quả -->
            <div id="results">
                <div class="empty-box">
                    <img src="https://img.icons8.com/ios-filled/50/000000/sleeping-in-bed.png">
                    <p>Không tìm thấy giao dịch</p>
                    <p>
                        Không tìm thấy giao dịch cho sản phẩm bạn chọn. Đặt lại bộ lọc để xem tất cả giao dịch.
                    </p>
                </div>
            </div>
        </div>
        
    </div>

    <?php include("inc/footer.php"); ?>

    <script>
        // Thêm sự kiện click cho các nút lọc
        const filterButtons = document.querySelectorAll('.filter-btn');
        const customRange = document.getElementById('custom-range');

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Xóa class active ở tất cả nút
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Thêm class active cho nút được nhấn
                this.classList.add('active');

                // Kiểm tra nếu nút là "Ngày tùy chọn"
                if (this.getAttribute('data-range') === 'custom') {
                    customRange.style.display = 'block'; // Hiện bộ lọc
                } else {
                    customRange.style.display = 'none'; // Ẩn bộ lọc
                    // Gọi AJAX để lọc theo nút khác (90 ngày, Tháng 10,...)
                    fetchDataByFilter(this.getAttribute('data-range') || this.getAttribute('data-month'));
                }
            });
        });

        // Hàm fetch dữ liệu theo các nút khác (90 ngày, Tháng 10, Tháng 9)
        function fetchDataByFilter(filterType) {
            // Thay đổi URL fetch dữ liệu tùy vào nút
            let url = `ajax/fetch_data.php?filter=${filterType}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('results');
                    resultsDiv.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            const resultItem = `
                                <div class="result-item">
                                    <h3>${item.title}</h3>
                                    <p>Ngày: ${item.date}</p>
                                    <p>Giá: ${item.price} VNĐ</p>
                                </div>
                            `;
                            resultsDiv.innerHTML += resultItem;
                        });
                    } else {
                        resultsDiv.innerHTML = `
                            <div class="empty-box">
                                <img src="https://img.icons8.com/ios-filled/50/000000/sleeping-in-bed.png">
                                <p>Không tìm thấy giao dịch</p>
                                <p>
                                    Không tìm thấy giao dịch cho sản phẩm bạn chọn. Đặt lại bộ lọc để xem tất cả giao dịch.
                                </p>
                            </div>
                        `;
                    }
                })
                .catch(error => console.error('Lỗi:', error));
        }
    </script>


    
</body>
</html>
