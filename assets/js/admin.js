function openItem(a) {
    var b = document.querySelector('.' + a)
    if (b.style.display === 'flex') {
        b.style.display = 'none'
    } else {
        b.style.display = 'flex'
    }
}

document.getElementById('departure_time').addEventListener('change', calculateDuration)
document.getElementById('arrival_time').addEventListener('change', calculateDuration)
function calculateDuration() {
    var a = document.getElementById('departure_time').value
    var b = document.getElementById('arrival_time').value
    
    if (a && b) {
        var [ah, am] = a.split(':')
        var [bh, bm] = b.split(':')
        if (parseInt(bm) - parseInt(am) < 0) {
            var hours = parseInt(bh) - parseInt(ah) - 1
            var minutes = parseInt(bm) - parseInt(am) + 60
            document.getElementById('time').value = hours + 'h ' + minutes + 'm'
        } else if (parseInt(bm) - parseInt(am) >= 0 && parseInt(bm) - parseInt(am) >= 0) {
            var hours = parseInt(bh) - parseInt(ah)
            var minutes = parseInt(bm) - parseInt(am)
            document.getElementById('time').value = hours + 'h ' + minutes + 'm'
        } else {
            document.getElementById('time').value = '0'
        }
    }
}

document.getElementById('airline').addEventListener('change', function () {
    var a = document.querySelector('.content-airlineBamboo')
    var b = document.querySelector('.content-airlineVietJet')
    var c = document.querySelector('.content-airlineVietnam')
    var d = document.querySelector('.content-airlineVietravel')
    if (document.getElementById('airline').value === 'Bamboo Airways') {
        a.style.display = 'flex'
        b.style.display = 'none'
        c.style.display = 'none'
        d.style.display = 'none'
    } else if (document.getElementById('airline').value === 'VietJet Air') {
        b.style.display = 'flex'
        a.style.display = 'none'
        c.style.display = 'none'
        d.style.display = 'none'
    } else if (document.getElementById('airline').value === 'Vietnam Airlines') {
        c.style.display = 'flex'
        a.style.display = 'none'
        b.style.display = 'none'
        d.style.display = 'none'
    } else if (document.getElementById('airline').value === 'Vietravel Airlines') {
        d.style.display = 'flex'
        a.style.display = 'none'
        b.style.display = 'none'
        c.style.display = 'none'
    }
})
document.querySelectorAll('input[name="aircraft"]').forEach((radio) => {
    radio.addEventListener('change', function () {
        var a321 = document.querySelector('.content-airlineA321')
        var a320 = document.querySelector('.content-airlineA320')
        var Boeing737 = document.querySelector('.content-airlineBoeing737')
        var Boeing787 = document.querySelector('.content-airlineBoeing787')
        var A350 = document.querySelector('.content-airlineA350')
        var A330 = document.querySelector('.content-airlineA330')
        var business = document.querySelector('.main_content-ticketType-business')
        var prenium = document.querySelector('.main_content-ticketType-prenium')
        var economy = document.querySelector('.main_content-ticketType-economy')

        if (this.value === 'A321') {
            a321.style.display = 'flex'
            a320.style.display = 'none'
            Boeing737.style.display = 'none'
            Boeing787.style.display = 'none'
            A350.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'none'
            economy.style.display = 'block'
        } else if (this.value === 'A320') {
            a320.style.display = 'flex'
            a321.style.display = 'none'
            Boeing737.style.display = 'none'
            Boeing787.style.display = 'none'
            A350.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'none'
            economy.style.display = 'block'
        } else if (this.value === 'Boeing737') {
            Boeing737.style.display = 'flex'
            a320.style.display = 'none'
            a321.style.display = 'none'
            Boeing787.style.display = 'none'
            A350.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'none'
            prenium.style.display = 'none'
            economy.style.display = 'block'
        } else if (this.value === 'Boeing787') {
            Boeing787.style.display = 'flex'
            a320.style.display = 'none'
            a321.style.display = 'none'
            Boeing737.style.display = 'none'
            A350.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'block'
            economy.style.display = 'block'
        } else if (this.value === 'A350') {
            A350.style.display = 'flex'
            a320.style.display = 'none'
            a321.style.display = 'none'
            Boeing737.style.display = 'none'
            Boeing787.style.display = 'none'
            A330.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'block'
            economy.style.display = 'block'
        } else if (this.value === 'A330') {
            A330.style.display = 'flex'
            a320.style.display = 'none'
            a321.style.display = 'none'
            Boeing737.style.display = 'none'
            Boeing787.style.display = 'none'
            A350.style.display = 'none'

            business.style.display = 'block'
            prenium.style.display = 'block'
            economy.style.display = 'none'
        }
    })
})

$(document).ready(function () {
    $('#flight_code').on('input', function () {
        var flightCode = $(this).val();

        $.ajax({
            type: 'POST',
            url: '../model/check_error_flight.php',
            data: {flight_code: flightCode},
            success: function (response) {
                $('#error-flight_code').text(response);
                $('.main_content-error.code').css('display', 'flex');
                if (response === 'Mã chuyến bay hợp lệ.') {
                    $('#error-flight_code').css('color', 'green');
                } else {
                    $('#error-flight_code').css('color', 'red');
                }
            },
            error: function () {
                $('#error-flight_code').text('Có lỗi xảy ra');
            }
        })
    })

    $('#departure_city, #arrival_city').on('change', function () {
        var departureCity = $('#departure_city').val();
        var arrivalCity = $('#arrival_city').val();
        var errorAddress = $('#error-address');

        if (departureCity && arrivalCity) {
            if (departureCity === arrivalCity) {
                errorAddress.text('Điểm đi và điểm đến không được trùng nhau')
                errorAddress.css('color', 'red');
                $('.main_content-error.address').css('display', 'flex');
            } else {
                errorAddress.text('Địa điểm hợp lệ')
                errorAddress.css('color', 'green');
                $('.main_content-error.address').css('display', 'flex');
            }
        } else {
            errorAddress.text()
            $('.main_content-error.address').css('display', 'none');
        }
    })

    $('#departure_city, #departure_date, #departure_time').on('input change', function () {
        var departureCity = $('#departure_city').val();
        var departureDate = $('#departure_date').val();
        var departureTime = $('#departure_time').val();

        if (departureCity && departureDate && departureTime) {
            $.ajax({
                type: 'POST',
                url: '../model/check_error_flight.php',
                data: {
                    departure_city: departureCity,
                    departure_date: departureDate,
                    departure_time: departureTime
                },
                dataType: 'text',
                success: function (response) {
                    $('#error-timeFrom').text(response);
                    $('#error-timeFrom').css('color', 'green');
                    $('.main_content-error.timeFrom').css('display', 'flex');
                },

                error: function () {
                    $('#error-timeFrom').text(response);
                    $('.main_content-error.timeFrom').css('display', 'flex');
                }
            })
        } else {
            $('#error-timeFrom').text("")
            $('.main_content-error.timeFrom').css('display', 'none');
        }
    })
    $('#arrival_city, #departure_date, #arrival_time').on('input change', function () {
        var arrivalCity = $('#arrival_city').val();
        var departureDate = $('#departure_date').val();
        var arrivalTime = $('#arrival_time').val();

        if (arrivalCity && departureDate && arrivalTime) {
            $.ajax({
                type: 'POST',
                url: '../model/check_error_flight.php',
                data: {
                    arrival_city: arrivalCity,
                    departure_date: departureDate,
                    arrival_time: arrivalTime
                },
                dataType: 'text',
                success: function (response) {
                    $('#error-timeTo').text(response);
                    $('#error-timeTo').css('color', 'green');
                    $('.main_content-error.timeTo').css('display', 'flex');
                },

                error: function () {
                    $('#error-timeTo').text(response);
                    $('.main_content-error.timeTo').css('display', 'flex');
                }
            })
        } else {
            $('#error-timeTo').text("")
            $('.main_content-error.timeTo').css('display', 'none');
        }
    })
})

document.addEventListener('DOMContentLoaded', function () {
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('departure_date').value = today;
})

function openAddFlight() {
    document.querySelector('.main_content').style.display = 'flex'
    document.querySelector('.flight_list').style.display = 'none'
}
function openFlightList() {
    document.querySelector('.main_content').style.display = 'none'
    document.querySelector('.flight_list').style.display = 'flex'
}