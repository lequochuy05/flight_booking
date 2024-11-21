<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut icon" href="images/logo.png">
   
    <?php 
            require("inc/links.php");
    ?>
    <link rel="stylesheet" href="assets/css/common.css">
    <title>PROFILES</title>
   </head>
<body class="bg-light">
    <?php include("inc/header.php");
    if(!(isset($_SESSION['login']) && $_SESSION['login'] == true))
    {
        redirect('index.php');
    }
    
    $u_exist = select("SELECT * FROM account_user WHERE id=? LIMIT 1",[$_SESSION['uId']], 's');

    if(mysqli_num_rows($u_exist)==0){
        redirect('index.php');
    }
    
    $u_fetch = mysqli_fetch_assoc($u_exist)


    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">Hồ Sơ</h2>
                <div style="font-size: 14px">
                    <a href="index.php" class="text-secondary text-decoration-none">Trang chủ</a>
                    <span class="text-secondary"> ></span>
                    <a href="#" class="text-secondary text-decoration-none">Hồ sơ của tôi</a>
                </div>            
            </div>

            <div class="col-12 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="info-form">
                        <h5 class="mb-3 fw-bold">Thông tin của tôi</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="fname" value="<?php echo $u_fetch['firstName'] ?>" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Họ</label>
                                <input type="text" name="lname" value="<?php echo $u_fetch['lastName'] ?>" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tên người dùng</label>
                                <input type="text" name="name" value="<?php echo $u_fetch['username'] ?>" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="number" name="phonenum" value="<?php echo $u_fetch['phone'] ?>" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" name="dob" value="<?php echo $u_fetch['dob'] ?>" class="form-control shadow-none" required>
                            </div>
                            
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $u_fetch['address'] ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
                    </form>
                </div>           
            </div>

            <div class="col-md-4 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="profile-form">
                        <h5 class="mb-3 fw-bold">Hình ảnh</h5>
                        <img src="<?php echo USERS_IMG_PATH.$u_fetch['profile'] ?>" class="rounded-circle img-fluid mb-3">

                        <label class="form-label">Hình ảnh mới</label>
                        <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="mb-4 form-control shadow-none" required> 
            
                        <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
                    </form>
                </div>           
            </div>

            <div class="col-md-8 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="pass-form">
                        <h5 class="mb-3 fw-bold">Đổi mật khẩu</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mật khẩu mới</label>
                                <input type="password" name="new_pass" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" name="confirm_pass" class="form-control shadow-none" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
                    </form>
                </div>           
            </div>


      
        </div>
    </div>
  
   
<!-- Footer -->
<?php
include("inc/footer.php");
?>

<script>
    let info_form = document.getElementById('info-form');

    info_form.addEventListener('submit', (e) =>{
        e.preventDefault();

        let data = new FormData();
        data.append('info_form','');
        data.append('fname',info_form.elements['fname'].value);
        data.append('lname',info_form.elements['lname'].value);
        data.append('name',info_form.elements['name'].value);
        data.append('phonenum',info_form.elements['phonenum'].value);
        data.append('address',info_form.elements['address'].value);
        data.append('dob',info_form.elements['dob'].value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile.php", true);

        xhr.onload = function () {
            let response = this.responseText.trim();
            console.log(response);
            if(response == 'phone_already'){
                alert('error', "Phone number is already registered!");
            } else if(response == 0){
                alert('error', "No Changes Made!");
            }else{
                alert('success', 'Changes Success')
            }
        };

        xhr.send(data);
    });

    let profile_form = document.getElementById('profile-form');

    profile_form.addEventListener('submit', (e)=>{
        e.preventDefault();


        let data = new FormData();

        data.append('profile_form','');
        data.append('profile',profile_form.elements['profile'].files[0]);
        

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile.php", true);

        xhr.onload = function () {

            let response = this.responseText.trim();
            console.log(response);

            if(response === 'inv_img') {
                alert('error', "Only JPG, WEBP & PNG images are allowed");
            }
            else if(response === 'upd_failed') {
                alert('error', "Image upload failed");
            }
            else if(response == 0){
                alert('error', "Updation failed!");
            }
            else{
                window.location.href = window.location.pathname;
            }
        };

        xhr.send(data);
    });

    let pass_form = document.getElementById('pass-form');
    
    pass_form.addEventListener('submit', (e)=>{
        e.preventDefault();

        let new_pass = pass_form.elements['new_pass'].value;
        let confirm_pass = pass_form.elements['confirm_pass'].value;

        if(new_pass != confirm_pass){
            alert('error',"Password do not match!");
            return false;
        }


        let data = new FormData();

        data.append('pass_form','');
        data.append('new_pass',new_pass);
        data.append('confirm_pass',confirm_pass);
        

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile.php", true);

        xhr.onload = function () {

            let response = this.responseText.trim();
            //console.log(response);

            if(response === 'mismatch') {
                alert('error', "Password do not match!");
            }
            else if(response == 0){
                alert('error', "Updation failed!");
            }
            else{
                alert('success',"Changes Saved");
                pass_form.reset();
            }
        };

        xhr.send(data);
    });
    
</script>

</body>
</html>

