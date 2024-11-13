function show_airline() {
    var a = document.querySelectorAll('.list_filter_airline-name')
    var c = document.querySelector('.list_filter-title i')

    a.forEach(function (b) {
        if (b.style.display === 'flex') {
            b.style.display = 'none'
            c.classList.remove('fa-angle-up')
            c.classList.add('fa-angle-down')
        } else {
            b.style.display = 'flex'
            c.classList.add('fa-angle-up')
            c.classList.remove('fa-angle-down')
        }
    })
}

function flight_time() {
    var a = document.querySelector('.list_filter_time-full')
    var b = document.querySelector('.list_filter-title2')

    if (a.style.display === 'flex') {
        a.style.display = 'none'
        b.classList.remove('fa-angle-up')
        b.classList.add('fa-angle-down')
    } else {
        a.style.display = 'flex'
        b.classList.add('fa-angle-up')
        b.classList.remove('fa-angle-down')
    }
}

document.querySelectorAll('.filter-checkbox, .list_filter_time-allDeparture div, .list_filter_time-allArrival div').forEach(element => {
    element.addEventListener('click', function () {
        if (this.hasAttribute('data-time')) {
            if (this.classList.contains('selected-time')) {
                this.classList.remove('selected-time')
            } else {
                this.classList.add('selected-time')
            }
        }

        var flights = document.querySelectorAll('.flight_list')
        var noResult = document.querySelector('.no-results')

        var hasResults = false
        
        var checkboxes = document.querySelectorAll('.filter-checkbox:checked')

        var selectedTimesDep = []
        var selectedArrival = []

        document.querySelectorAll('.list_filter_time-allDeparture div.selected-time').forEach(div => {
            selectedTimesDep.push(div.getAttribute('data-time'))
        })
        document.querySelectorAll('.list_filter_time-allArrival div.selected-time').forEach(div => {
            selectedArrival.push(div.getAttribute('data-time'))
        })
        
        if (checkboxes.length === 0 && selectedTimesDep.length === 0 && selectedArrival.length === 0) {
            flights.forEach(flight => {
                flight.style.display = 'block'
            })
            noResult.style.display = 'none'
        } else {
            flights.forEach(flight => {
                flight.style.display = 'none'
            })

            if (checkboxes.length === 0 && selectedTimesDep.length > 0) {
                flights.forEach(flight => {
                    var departureTime = flight.getAttribute('data-departure')
                    var matchTime = selectedTimesDep.some(time =>timeFilter(departureTime, time))
                    if (matchTime) {
                        flight.style.display = 'block'
                        hasResults = true
                    }
                })
            } else if (checkboxes.length === 0 && selectedArrival.length > 0) {
                flights.forEach(flight => {
                    var arrivalTime = flight.getAttribute('data-arrival')
                    var matchTime = selectedArrival.some(time => timeFilter(arrivalTime, time))
                    if (matchTime) {
                        flight.style.display = 'block'
                        hasResults = true
                    }
                })
            }

            checkboxes.forEach(checkbox => {
                var airline = checkbox.value;
                
                document.querySelectorAll('.' + airline).forEach(flight => {
                    var departureTime = flight.getAttribute('data-departure');
                    var arrivalTime = flight.getAttribute('data-arrival');

                    var matchDepTime = selectedTimesDep.length === 0 || selectedTimesDep.some(time => timeFilter(departureTime, time));
                    var matchArrTime = selectedArrival.length === 0 || selectedArrival.some(time => timeFilter(arrivalTime, time));

                    if (matchDepTime && matchArrTime) {
                        flight.style.display = 'block';
                        hasResults = true;
                    }
                });
            });

            noResult.style.display = hasResults ? 'none' : 'block'
        }
    })
})

function splitTime(time) {
    return time.split(':').map(Number)
}
function timeFilter(departureTime, selectedTime) {
    let [start, end] = selectedTime.split('-')

    let [startHour, startMinute] = splitTime(start)
    let [endHour, endMinute] = splitTime(end)
    let [depHour, depMinute] = splitTime(departureTime)

    let depTimeInMinutes = depHour * 60 + depMinute;
    let startTimeInMinutes = startHour * 60 + startMinute;
    let endTimeInMinutes = endHour * 60 + endMinute;

    return depTimeInMinutes >= startTimeInMinutes && depTimeInMinutes < endTimeInMinutes;
}

function openYourTrip(a, b, c, d, e, f, h, g) {
    var x = document.querySelector('.yourTrip')
    x.style.display = 'flex'
    document.body.style.overflow = 'hidden'
    if (a === 'Vietravel Airlines') {
        document.querySelector('.content-info-content2-logo p').textContent = a;
        document.querySelector('.content-info-content2-logo img').src = '../assets/img/vietravel.webp'
        document.getElementById('airline').value = a
        document.querySelector('.yourTrip_content-footer-list span').textContent = a
        document.querySelectorAll('.yourTrip_content-footer-list div label span').forEach(span =>span.textContent = a)
    } else if (a === 'VietJet Air') {
        document.querySelector('.content-info-content2-logo p').textContent = a;
        document.querySelector('.content-info-content2-logo img').src = '../assets/img/vietjet.webp'
        document.getElementById('airline').value = a
        document.querySelector('.yourTrip_content-footer-list span').textContent = a
        document.querySelectorAll('.yourTrip_content-footer-list div label span').forEach(span =>span.textContent = a)
    } else if (a === 'Vietnam Airlines') {
        document.querySelector('.content-info-content2-logo p').textContent = a;
        document.querySelector('.content-info-content2-logo img').src = '../assets/img/vietnam.webp'
        document.getElementById('airline').value = a
        document.querySelector('.yourTrip_content-footer-list span').textContent = a
        document.querySelectorAll('.yourTrip_content-footer-list div label span').forEach(span =>span.textContent = a)
    }
    document.querySelector('.content2-info-from p:first-child').textContent = b;
    document.querySelector('.content2-info-to p:first-child').textContent = c;
    document.getElementById('departure_time').value = b;
    document.getElementById('arrival_time').value = c;
    document.querySelector('.yourTrip_content-footer-left div p span').textContent = d
    document.getElementById('price').value = d
    if(document.querySelector('.footer_list-adult label:last-child p')) {
        document.querySelector('.footer_list-adult label:last-child p').textContent = e
    }
    if(document.querySelector('.footer_list-child label:last-child p')) {
        document.querySelector('.footer_list-child label:last-child p').textContent = f
    }
    if(document.querySelector('.footer_list-infant label:last-child p')) {
        document.querySelector('.footer_list-infant label:last-child p').textContent = h
    }
    document.getElementById('flight_code').value = g
}

document.querySelector('.yourTrip_content-footer-left').addEventListener('click', function () {
    if (document.querySelector('.yourTrip_content-footer-list').style.display === 'none') {
        document.querySelector('.yourTrip_content-footer-list').style.display = 'block'

        if (document.querySelector('.yourTrip_content-footer-listReturn')) {
            document.querySelector('.yourTrip_content-footer-listReturn').style.display = 'block'
        }

        document.querySelector('.yourTrip_content-footer-left .fa-solid').classList.remove('fa-angle-up')
        document.querySelector('.yourTrip_content-footer-left .fa-solid').classList.add('fa-angle-down')
    } else {
        document.querySelector('.yourTrip_content-footer-list').style.display = 'none'

        if (document.querySelector('.yourTrip_content-footer-listReturn')) {
            document.querySelector('.yourTrip_content-footer-listReturn').style.display = 'none'
        }

        document.querySelector('.yourTrip_content-footer-left .fa-solid').classList.remove('fa-angle-down')
        document.querySelector('.yourTrip_content-footer-left .fa-solid').classList.add('fa-angle-up')
    }
})

function openMyFlight(e, a, b, c) {
    e.style.color = 'var(--color_1)'
    e.style.borderBottom = '2px solid var(--color_1)'
    document.querySelector('.yourTrip_content-myFlight p:' + a).style.color = '#000'
    document.querySelector('.yourTrip_content-myFlight p:' + a).style.borderBottom = '2px solid rgb(247, 249, 250)'

    document.querySelector('.yourTrip_content-info').style.display = b
    document.querySelector('.yourTrip_content-info-return').style.display = c
}

document.querySelector('.yourTrip_background').addEventListener('click', function () {
    var a = document.querySelector('.yourTrip')
    a.style.display = 'none'
    document.body.style.overflow = 'visible'
})
document.querySelector('.yourTrip_content-header-close').addEventListener('click', function () {
    var a = document.querySelector('.yourTrip')
    a.style.display = 'none'
    document.body.style.overflow = 'visible'
})

function chooseFirstFlight(a, b, c, d, e, f, h, g) {
    if (a === 'Vietravel Airlines') {
        document.querySelector('.myFlight_dep-main-airline p').textContent = a;
        document.querySelector('.myFlight_dep-main-airline img').src = '../assets/img/vietravel.webp'
        
        document.querySelector('.content-info-content2-logo p').textContent = a;
        document.querySelector('.content-info-content2-logo img').src = '../assets/img/vietravel.webp'

        document.querySelector('.yourTrip_content-footer-list span').textContent = a
        document.querySelectorAll('.yourTrip_content-footer-list div label span').forEach(span =>span.textContent = a)

        document.getElementById('airline').value = a
    } else if (a === 'VietJet Air') {
        document.querySelector('.myFlight_dep-main-airline p').textContent = a;
        document.querySelector('.myFlight_dep-main-airline img').src = '../assets/img/vietjet.webp'
        
        document.querySelector('.content-info-content2-logo p').textContent = a;
        document.querySelector('.content-info-content2-logo img').src = '../assets/img/vietravel.webp'

        document.querySelector('.yourTrip_content-footer-list span').textContent = a
        document.querySelectorAll('.yourTrip_content-footer-list div label span').forEach(span =>span.textContent = a)

        document.getElementById('airline').value = a
    } else if (a === 'Vietnam Airlines') {
        document.querySelector('.myFlight_dep-main-airline p').textContent = a;
        document.querySelector('.myFlight_dep-main-airline img').src = '../assets/img/vietnam.webp'
        
        document.querySelector('.content-info-content2-logo p').textContent = a;
        document.querySelector('.content-info-content2-logo img').src = '../assets/img/vietnam.webp'

        document.querySelector('.yourTrip_content-footer-list span').textContent = a
        document.querySelectorAll('.yourTrip_content-footer-list div label span').forEach(span =>span.textContent = a)

        document.getElementById('airline').value = a
    }

    document.querySelector('.myFlight_dep-main-info div:nth-of-type(1) p').textContent = b;
    document.querySelector('.myFlight_dep-main-info div:nth-of-type(3) p').textContent = c;
    document.querySelector('.content2-info-from p:first-child').textContent = b;
    document.querySelector('.content2-info-to p:first-child').textContent = c;
    document.querySelector('.yourTrip_content-footer-left div p span').textContent = d
    if(document.querySelector('.footer_list-adult label:last-child p')) {
        document.querySelector('.footer_list-adult label:last-child p').textContent = e
    }
    if(document.querySelector('.footer_list-child label:last-child p')) {
        document.querySelector('.footer_list-child label:last-child p').textContent = f
    }
    if(document.querySelector('.footer_list-infant label:last-child p')) {
        document.querySelector('.footer_list-infant label:last-child p').textContent = h
    }

    document.getElementById('flight_code').value = g


    document.querySelector('.myFlight_dep-main').style.display = 'block'
    document.querySelector('.myFlight_dep').classList.remove('selected_flight')
    document.querySelector('.myFlight_return').classList.add('selected_flight')
    document.querySelector('.flight_lists').style.display = 'none'

    if (document.querySelector('.flight_lists-return')) {
        document.querySelector('.flight_lists-return').style.display = 'block'
    }

    if (document.querySelector('.no-result.return')) {
        document.querySelector('.no-result.return').style.display = 'block'
    }
}

function chooseSecondFlight(a, b, c, d, e, f, h, g) {
    var x = document.querySelector('.yourTrip')
    x.style.display = 'flex'
    document.body.style.overflow = 'hidden'

    if (a === 'Vietravel Airlines') {
        document.querySelector('.yourTrip_content-info-return .content-info-content2-logo p').textContent = a;
        document.querySelector('.yourTrip_content-info-return .content-info-content2-logo img').src = '../assets/img/vietravel.webp'
        
        document.querySelector('.myFlight_return-main-airline p').textContent = a;
        document.querySelector('.myFlight_return-main-airline img').src = '../assets/img/vietravel.webp'

        document.querySelector('.yourTrip_content-footer-listReturn span').textContent = a
        document.querySelectorAll('.yourTrip_content-footer-listReturn div label span').forEach(span =>span.textContent = a)

        document.getElementById('airlineReturn').value = a
    } else if (a === 'VietJet Air') {
        document.querySelector('.yourTrip_content-info-return .content-info-content2-logo p').textContent = a;
        document.querySelector('.yourTrip_content-info-return .content-info-content2-logo img').src = '../assets/img/vietjet.webp'
        
        document.querySelector('.myFlight_return-main-airline p').textContent = a;
        document.querySelector('.myFlight_return-main-airline img').src = '../assets/img/vietjet.webp'

        document.querySelector('.yourTrip_content-footer-listReturn span').textContent = a
        document.querySelectorAll('.yourTrip_content-footer-listReturn div label span').forEach(span =>span.textContent = a)

        document.getElementById('airlineReturn').value = a
    } else if (a === 'Vietnam Airlines') {
        document.querySelector('.yourTrip_content-info-return .content-info-content2-logo p').textContent = a;
        document.querySelector('.yourTrip_content-info-return .content-info-content2-logo img').src = '../assets/img/vietnam.webp'
        
        document.querySelector('.myFlight_return-main-airline p').textContent = a;
        document.querySelector('.myFlight_return-main-airline img').src = '../assets/img/vietnam.webp'

        document.querySelector('.yourTrip_content-footer-listReturn span').textContent = a
        document.querySelectorAll('.yourTrip_content-footer-listReturn div label span').forEach(span =>span.textContent = a)

        document.getElementById('airlineReturn').value = a
    }
    document.querySelector('.yourTrip_content-info-return .content2-info-from p:first-child').textContent = b;
    document.querySelector('.yourTrip_content-info-return .content2-info-to p:first-child').textContent = c;

    document.querySelector('.myFlight_return-main-info div:nth-of-type(1) p').textContent = b;
    document.querySelector('.myFlight_return-main-info div:nth-of-type(3) p').textContent = c;
    
    document.getElementById('price').value = d

    document.querySelector('.myFlight_return-main').style.display = 'block'

    if(document.querySelector('.footer_list-adultReturn label:last-child p')) {
        document.querySelector('.footer_list-adultReturn label:last-child p').textContent = e
    }
    if(document.querySelector('.footer_list-childReturn label:last-child p')) {
        document.querySelector('.footer_list-childReturn label:last-child p').textContent = f
    }
    if(document.querySelector('.footer_list-infantReturn label:last-child p')) {
        document.querySelector('.footer_list-infantReturn label:last-child p').textContent = h
    }

    if (document.getElementById('flight_codeReturn')) {
        document.getElementById('flight_codeReturn').value = g
    }
}

document.querySelector('.myFlight_dep-main button').addEventListener('click', function () {
    document.querySelector('.flight_lists').style.display = 'block'
    document.querySelector('.flight_lists-return').style.display = 'none'
})
if (document.querySelector('.myFlight_return-main button')) {
    document.querySelector('.myFlight_return-main button').addEventListener('click', function () {
        document.querySelector('.flight_lists').style.display = 'none'
        document.querySelector('.flight_lists-return').style.display = 'block'
    })
}