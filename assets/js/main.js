window.addEventListener('scroll', function () {
    var scrollheader = this.window.scrollY
    if(scrollheader > 100) {
        document.querySelector('.header').style.backgroundColor = '#fff'
        document.querySelectorAll('.header a').forEach(function(element) {
            element.style.color = '#000'
        })
        document.querySelectorAll('.header a i').forEach(function(element) {
            element.style.color = 'rgb(17, 150, 227)'
        })
        document.querySelector('.header_userInfo-logo p').style.color = '#000'
    } else if(scrollheader == 0) {
        document.querySelector('.header').style.backgroundColor = 'initial'
        document.querySelectorAll('.header a').forEach(function(element) {
            element.style.color = 'rgb(17, 150, 227)'
        })
        document.querySelector('.header_userInfo-logo p').style.color = 'rgb(17, 150, 227)'
        document.querySelector('.header_userInfo-logo').style.border = '1px solid rgb(17, 150, 227)'
    }
})


var countAdult = parseInt(document.querySelector('.flight__row1-setTicket-countAdult').textContent)
var countChild = parseInt(document.querySelector('.flight__row1-setTicket-countChild').textContent)
var countInfant = parseInt(document.querySelector('.flight__row1-setTicket-countInfant').textContent)
var sumAge = countAdult + countChild + countInfant

document.getElementById('subAdult').addEventListener('click', function () {
    if(sumAge < 8) {
        document.getElementById('sumAdult').style.color = '#0194f3'
        document.getElementById('sumChild').style.color = '#0194f3'
        document.getElementById('sumInfant').style.color = '#0194f3'
    }
    countAdult --
    sumAge --
    document.querySelector('.flight__row1-setTicket-countAdult').innerHTML = countAdult
    document.getElementById('numberAdult').innerHTML = countAdult
    if(sumAge <= 1) {
        document.getElementById('subAdult').style.color = '#687176'
    }
})
document.getElementById('sumAdult').addEventListener('click', function () {
    if(sumAge > 6) {
        return
    } else {
        document.getElementById('sumAdult').style.color = '#0194f3'
        document.getElementById('subAdult').style.color = '#0194f3'
    }
    countAdult ++
    sumAge ++
    if(sumAge === 7) {
        document.getElementById('sumAdult').style.color = '#687176'
        document.getElementById('sumChild').style.color = '#687176'
        document.getElementById('sumInfant').style.color = '#687176'
    }
    document.querySelector('.flight__row1-setTicket-countAdult').innerHTML = countAdult
    document.getElementById('numberAdult').innerHTML = countAdult
})
// Loại 2
document.getElementById('subChild').addEventListener('click', function () {
    if(sumAge < 8) {
        document.getElementById('sumAdult').style.color = '#0194f3'
        document.getElementById('sumChild').style.color = '#0194f3'
        document.getElementById('sumInfant').style.color = '#0194f3'
    }
    if(countChild <= 1) {
        document.querySelector('.flight__row1-setTicket-countChild').innerHTML = '0'
        document.getElementById('numberChild').innerHTML = '0'
        document.getElementById('subChild').style.color = '#687176'
        return
    }
    countChild --
    sumAge --
    document.querySelector('.flight__row1-setTicket-countChild').innerHTML = countChild
    document.getElementById('numberChild').innerHTML = countChild
})
document.getElementById('sumChild').addEventListener('click', function () {
    if(sumAge > 6) {
        return
    } else {
        document.getElementById('sumChild').style.color = '#0194f3'
        document.getElementById('subChild').style.color = '#0194f3'
    }
    countChild ++
    sumAge ++
    if(sumAge === 7) {
        document.getElementById('sumAdult').style.color = '#687176'
        document.getElementById('sumChild').style.color = '#687176'
        document.getElementById('sumInfant').style.color = '#687176'
    }
    document.querySelector('.flight__row1-setTicket-countChild').innerHTML = countChild
    document.getElementById('numberChild').innerHTML = countChild
})
// Loại 3
document.getElementById('subInfant').addEventListener('click', function () {
    if(sumAge < 8) {
        document.getElementById('sumAdult').style.color = '#0194f3'
        document.getElementById('sumChild').style.color = '#0194f3'
        document.getElementById('sumInfant').style.color = '#0194f3'
    }
    if(countInfant <= 1) {
        document.querySelector('.flight__row1-setTicket-countInfant').innerHTML = '0'
        document.getElementById('numberInfant').innerHTML = '0'
        document.getElementById('subInfant').style.color = '#687176'
        return
    }
    countInfant --
    sumAge --
    document.querySelector('.flight__row1-setTicket-countInfant').innerHTML = countInfant
    document.getElementById('numberInfant').innerHTML = countInfant
})
document.getElementById('sumInfant').addEventListener('click', function () {
    if(sumAge > 6) {
        return
    } else {
        document.getElementById('sumInfant').style.color = '#0194f3'
        document.getElementById('subInfant').style.color = '#0194f3'
    }
    countInfant ++
    sumAge ++
    if(sumAge === 7) {
        document.getElementById('sumAdult').style.color = '#687176'
        document.getElementById('sumChild').style.color = '#687176'
        document.getElementById('sumInfant').style.color = '#687176'
    }
    document.querySelector('.flight__row1-setTicket-countInfant').innerHTML = countInfant
    document.getElementById('numberInfant').innerHTML = countInfant
})
function getnumberTicket() {
    document.getElementById('countAdult').value = countAdult
    document.getElementById('countChild').value = countChild
    document.getElementById('countInfant').value = countInfant
}

var SetTicketAge = document.querySelector('.row1-setTicket-age-main')
var listsAge = document.querySelector('.row1-setTicket-age-list')
var X = document.querySelector('.row1-setTicket-age-list-title .x')
var done = document.querySelector('.setTicket-age-list-ageS-done')
SetTicketAge.addEventListener('click', function () {
    listsAge.style.display = 'block'
})
X.addEventListener('click', function () {
    listsAge.style.display = 'none'
})
done.addEventListener('click', function () {
    listsAge.style.display = 'none'
})
document.addEventListener('click', function (event) {
    if(!SetTicketAge.contains(event.target) && !listsAge.contains(event.target)) {
        listsAge.style.display = 'none'
    }
})

document.addEventListener('DOMContentLoaded', function () {
    var today = new Date().toISOString().split('T')[0];
    document.querySelector('.flight__row2-date-departureDate-inputDepar').value = today;
    document.getElementById('return_date').value = today;
})

document.getElementById('returnCheck').addEventListener('click', function () {
    var returnDateElement = document.getElementById('return_date');
    if (this.checked) {
        returnDateElement.style.backgroundColor = '#fff';
        returnDateElement.disabled = false
    } else {
        returnDateElement.style.backgroundColor = 'var(--color_2)';
        returnDateElement.disabled = true
    }
});