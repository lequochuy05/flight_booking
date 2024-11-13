var countdownTime = 600;
const countdownElement = document.getElementById('countdown');

function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
}

const countdownInterval = setInterval(function() {
    countdownElement.innerText = formatTime(countdownTime);
    
    if (countdownTime <= 0) {
        clearInterval(countdownInterval);

        document.querySelector('.container_main-header').innerHTML = 'Quá trình thanh toán kết thúc !!!'

        const flightCode = $('#confirmCancel').data("flight-code");
        const chairType = $('#confirmCancel').data("chair-type");
        const chairNumbers = $('#confirmCancel').data("chair-numbers");
        const status = "Chưa đặt";

        $.ajax({
            url: "../controller/update_chair.php",
            type: "POST",
            data: {
                flight_code: flightCode,
                chair_type: chairType,
                chair_numbers: chairNumbers,
                status: status
            },
            success: function (response) {
                try {
                    const data = JSON.parse(response);
                    if (data.status === "success") {
                        alert("Đã hết thời gian thanh toán, ghế của bạn sẽ bị hủy.");
                        window.history.back()
                    } else {
                        alert("Lỗi: " + data.message);
                    }
                } catch (e) {
                    alert("Đã xảy ra lỗi trong quá trình xử lý phản hồi từ máy chủ.");
                }
            },
            error: function (xhr, status, error) {
                alert("Đã xảy ra lỗi trong quá trình thay đổi trạng thái ghế.");
            }
        });
    } else {
        countdownTime--;
    }
}, 1000)

document.querySelector('input[name="pay"]').checked = true
document.querySelectorAll('input[name="pay"]').forEach((radio) => {
    radio.addEventListener('change', function () {
        var qrcode = document.querySelector('.container_main-pays-qrcode div:last-child')
        var eWallets = document.querySelector('.pays_e-wallets-content')
        var transfer = document.querySelector('.container_main-pays-transfer-content')
        if (this.value === 'qrcode') {
            qrcode.style.display = 'block'
            eWallets.style.display = 'none'
            transfer.style.display = 'none'

            document.querySelector('.container_main-btnPay button span').innerHTML = 'QR Code'
        } else if (this.value === 'wallets') {
            qrcode.style.display = 'none'
            eWallets.style.display = 'block'
            transfer.style.display = 'none'
            
            document.querySelector('.container_main-btnPay button span').innerHTML = 'Ví điện tử khác'
        } else if (this.value === 'transfer') {
            qrcode.style.display = 'none'
            eWallets.style.display = 'none'
            transfer.style.display = 'block'

            document.querySelector('.container_main-btnPay button span').innerHTML = 'MB Bank'
        }
    })
})

document.querySelector('input[name="pay-transfer"]').checked = true
document.querySelectorAll('input[name="pay-transfer"]').forEach((radio) => {
    radio.addEventListener('change', function () {
        var previouslySelected = document.querySelector('.pays_transfer-content.pays_transfer-slected')
        if (previouslySelected) {
            previouslySelected.classList.remove('pays_transfer-slected')
        }

        this.closest('.pays_transfer-content').classList.add('pays_transfer-slected')

        if (this.value === 'pay-transfer-mbbank') {
            document.querySelector('.container_main-btnPay button span').innerHTML = 'MB Bank'
        } else if (this.value === 'pay-transfer-vietcom') {
            document.querySelector('.container_main-btnPay button span').innerHTML = 'VietCom Bank'
        }
    })
})

function loading() {
    var a = document.querySelector('.loading')
    var b = document.querySelector('.container_main')

    a.style.display = 'flex'
    b.style.display = 'none'

    setTimeout(function () {
        a.style.display = 'none'
        document.querySelector('.pay_detail').style.display = 'block'
    }, 2000)
}

function validateForm(event) {
    event.preventDefault();
    var a = document.getElementById('image')

    if (!a.files || !a.files.length) {
        alert('Vui lòng chọn file ảnh trước khi tải lên')
    } else {
        document.querySelector('.pay_detail').submit()
    }
}

function openItem(a, b) {
    document.querySelector('.' + a).style.display = 'none'
    document.querySelector('.' + b).style.display = 'block'
}

document.querySelector('.pay_detail-cancel').addEventListener('click', function () {
    document.querySelector('.pay_detail').style.display = 'none'
    document.querySelector('.container_main').style.display = 'block'
})
document.querySelector('.container_main-cancel').addEventListener('click', function () {
    document.querySelector('.container_main').style.display = 'none'
    document.querySelector('.select').style.display = 'flex'
})


$(document).ready(function() {
    $('#confirmCancel').on('click', function() {
        const flightCode = $(this).data("flight-code");
        const chairType = $(this).data("chair-type");
        const chairNumbers = $(this).data("chair-numbers");
        const status = "Chưa đặt";
        $.ajax({
            url: "../controller/update_chair.php",
            type: "POST",
            data: {
                flight_code: flightCode,
                chair_type: chairType,
                chair_numbers: chairNumbers,
                status: status
            },
            success: function (response) {
                try {
                    const data = JSON.parse(response);
                    if (data.status === "success") {
                        alert("Ghế đã bị hủy.");
                        window.history.back()
                    } else {
                        alert("Lỗi: " + data.message);
                    }
                } catch (e) {
                    alert("Đã xảy ra lỗi trong quá trình xử lý phản hồi từ máy chủ.");
                }
            },
            error: function (xhr, status, error) {
                alert("Đã xảy ra lỗi trong quá trình hủy ghế.");
            }
        })
    })
})