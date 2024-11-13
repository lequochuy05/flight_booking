
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php include('inc/links.php')?>
    <link rel="stylesheet" href="./assets/css/common.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <!-- header -->
    <?php include('inc/header.php') ?>

    
    <!-- Main -->
    <section class="home">
        <h2 class="home_title">Đi Khắp Việt Nam, Cùng Tôi.</h2>
        <form class="book__content-flight" method="get" action="./view/flight_list.php">
            <div class="book__content-flight__row1">
                <div class="flight__row1-setTicket">
                    <div class="flight__row1-setTicket-age">
                        <div class="row1-setTicket-age-main">
                            <i class="fa-solid fa-user-group"></i>
                            <label class="flight__row1-setTicket-countAdult">1</label>
                            <input type="hidden" name="countAdult" id="countAdult" value="1">
                            <p> Người lớn, </p>
                            <label class="flight__row1-setTicket-countChild">0</label>
                            <input type="hidden" name="countChild" id="countChild" value="0">
                            <p> Trẻ em, </p>
                            <label class="flight__row1-setTicket-countInfant">0</label>
                            <input type="hidden" name="countInfant" id="countInfant" value="0">
                            <p> Em bé</p>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="row1-setTicket-age-list">
                            <div class="row1-setTicket-age-list-title">
                                <p>Số khách hàng</p>
                                <i class="x fa-solid fa-xmark"></i>
                            </div>
                            <div class="row1-setTicket-age-list-ageS">
                                <div class="setTicket-age-list-ageS-adult">
                                    <div class="list-ageS-adult-labelAdult">
                                        <i class="fa-solid fa-person"></i>
                                        <p>Người lớn<br></p>
                                    </div>
                                    <div class="list-ageS-adult-calcuAdult">
                                        <label for="" id="subAdult">--</label>
                                        <label for="" id="numberAdult">1</label>
                                        <label for="" id="sumAdult">+</label>
                                    </div>
                                </div>
                                <div class="setTicket-age-list-ageS-child">
                                    <div class="list-ageS-child-labelChild">
                                        <i class="fa-solid fa-child-dress"></i>
                                        <p>Trẻ em<br></p>
                                    </div>
                                    <div class="list-ageS-child-calcuChild">
                                        <label for="" id="subChild">--</label>
                                        <label for="" id="numberChild">0</label>
                                        <label for="" id="sumChild">+</label>
                                    </div>
                                </div>
                                <div class="setTicket-age-list-ageS-infant">
                                    <div class="list-ageS-infant-labelInfant">
                                        <i class="fa-solid fa-baby"></i>
                                        <p>Em bé<br></p>
                                    </div>
                                    <div class="list-ageS-infant-calcuInfant">
                                        <label for="" id="subInfant">--</label>
                                        <label for="" id="numberInfant">0</label>
                                        <label for="" id="sumInfant">+</label>
                                    </div>
                                </div>
                                <div class="setTicket-age-list-ageS-done">Done</div>
                            </div>
                        </div>
                    </div>
                    <select name="chairType" id="chairType">
                        <option value="Economy Class">Economy Class</option>
                        <option value="Prenium Economy">Prenium Economy</option>
                        <option value="Business Class">Business Class</option>
                    </select>
                </div>
            </div>
            <div class="book__content-flight__row2">
                <div class="content-flight__row2-address">
                    <div class="flight__row2-address-from">
                        <p>Từ</p>
                        <div class="flight__row2-address-from-inputFrom">
                            <i class="fa-solid fa-plane-departure"></i>
                            <div class="flight__row2-address-from-inputFrom-date">
                                <select name="from" id="">
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
                            </div>
                        </div>
                    </div>
                    <div class="flight__row2-address-to">
                        <p>Đến</p>
                        <div class="flight__row2-address-to-inputTo">
                            <i class="fa-solid fa-plane-arrival"></i>
                            <div class="flight__row2-address-to-inputTo-date">
                                <select name="to" id="">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-flight__row2-date">
                    <div class="flight__row2-date-departureDate">
                        <p>Ngày đi</p>
                        <input type="date" name="departure" id="" class="flight__row2-date-departureDate-inputDepar">
                    </div>
                    <div class="flight__row2-date-returnDate">
                        <div class="flight__row2-date-returnDate-icon">
                            <input type="checkbox" name="return-check" id="returnCheck">
                            <label for="">Khứ hồi</label>
                        </div>
                        <input type="date" name="return_date" id="return_date" disabled>
                    </div>
                </div>
                <div class="content-flight__row2-search">
                    <button type="submit" class="flight__row2-search-iconSearch" onclick="getnumberTicket()">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>
    </section>

    
    <!-- Password Reset -->
<div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="recovery-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center"><i class="bi bi-shield-lock fs-3 me-2"></i> Set up New Password</h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
            Note: A link will be sent to your email to reset your password!
          </span>
          <div class="mb-4">
            <label class="form-label">New Password</label>
            <input type="password" name="pass" class="form-control shadow-none" required>           
            <input type="hidden" name="email">
            <input type="hidden" name="token">
        </div>
        
          <div class="mb-2 text-end">
            <button type="button" class="btn shadow-none me-2"data-bs-dismiss="modal">
                Cancel
            </button>
            <button type="submit" class="btn btn-dark shadow-none">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

    <?php include('inc/footer.php') ?>


<?php
    if(isset($_GET['account_recovery'])){
        $data = filteration($_GET);

        $t_date = date("Y-m-d");
        $q = select("SELECT * FROM account_user WHERE email =? AND token=? AND t_expire=? LIMIT 1",
                    [$data['email'],$data['token'],$t_date],'sss');
        if(mysqli_num_rows($q)==1){
            echo<<<showModal
                <script>
                    var myModal = document.getElementById('recoveryModal');
    
                    myModal.querySelector("input[name='email']").value = '$data[email]';
                    myModal.querySelector("input[name='token']").value = '$data[token]';
   
                    var modal = bootstrap.Modal.getOrCreateInstance(myModal);
                    modal.show();   
                </script>
            showModal;
        }else{
            alert("error", "Invalid or Expired Link!");
        }
    }
?>
    
    <script src="./assets/js/main.js"></script>

    <script>
        //Recover account
        let recovery_form = document.getElementById('recovery-form');

        recovery_form.addEventListener('submit', (e)=>{
            e.preventDefault();

            let data = new FormData();
            data.append('email',recovery_form.elements['email'].value); 
            data.append('token',recovery_form.elements['token'].value);
            data.append('pass',recovery_form.elements['pass'].value);    
            data.append('recover_user','');
            
            var myModal = document.getElementById("recoveryModal");
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/login_register.php", true);
        

            xhr.onload = function() {
                let responseText = this.responseText.trim();
                if(responseText === 'failed') {
                    alert('error', "Account reset failed!");
                } else {
                    alert('success', "Account reset successful!");
                    recovery_form.reset();
                    
                }
            }
            xhr.send(data); 
            
        });
    </script>
</body>
</html>