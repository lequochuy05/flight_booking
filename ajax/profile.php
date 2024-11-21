<?php
    
    require('../model/database.php');
    require('../admin/inc/essentials.php');
    
    
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    
    if(isset($_POST['info_form'])){
        session_start();
        $frm_data = filteration($_POST);

        $u_exist = select("SELECT * FROM account_user WHERE phone=? AND id=? LIMIT 1",
            [$frm_data['phonenum'], $_SESSION['uId']], "ss");   

        if(mysqli_num_rows($u_exist)!=0){
            echo 'phone_already';
            exit;
        }

        $q = "UPDATE account_user SET  firstName=?, lastName=?, Username=?, address =?, phone=?, dob=?
                WHERE id =? LIMIT 1";
        $val = [$frm_data['fname'],$frm_data['lname'],$frm_data['name'],$frm_data['address'],$frm_data['phonenum'],$frm_data['dob'],$_SESSION['uId']];

        if(update($q, $val, "ssssssi")){
            $_SESSION['uName'] = $frm_data['name'];
            echo 1;
        }else{
            echo 0;
        }

    }

    if(isset($_POST['profile_form'])){

        session_start();

        //upload user image to server
        $img = uploadUserImage($_FILES['profile']);

        if($img == 'inv_img'){
            echo 'inv_img';
            exit;
        }else if($img == 'upd_failed'){
            echo 'upd_failed';
            exit;
        }

        //delete old picture
        $u_exist = select("SELECT profile FROM account_user WHERE id=? LIMIT 1", [$_SESSION['uId']], "s");   
        $u_fetch = mysqli_fetch_assoc($u_exist);

        deleteImage($u_fetch['profile'], USERS_FOLDER);

       
        $q = "UPDATE account_user SET profile=?
                WHERE id =? LIMIT 1";
        $val = [$img, $_SESSION['uId']];

        if(update($q, $val, "ss")){
            $_SESSION['uPic'] = $img;
            echo 1;
        }else{
            echo 0;
        }

    }

    if(isset($_POST['pass_form'])){

        $frm_data = filteration($_POST);
        session_start();

        if($frm_data['new_pass']!= $frm_data['confirm_pass']){
            echo 'mismatch';
            exit;
        }
        $enc_pass = password_hash($frm_data['new_pass'], PASSWORD_BCRYPT);

       
        $q = "UPDATE account_user SET password=?
                WHERE id =? LIMIT 1";
        $val = [$enc_pass, $_SESSION['uId']];

        if(update($q, $val, "ss")){
            echo 1;
        }else{
            echo 0;
        }

    }
?>