<?php
    require_once("admin/inc/essentials.php");
    session_start();
    session_destroy();
    redirect('index.php');

?>