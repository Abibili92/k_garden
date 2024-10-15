<?php
    if(!isset($_COOKIE['user_id'])){
        $user_id = uniqid();
        setcookie('user_id', $user_id, time() + (86400 * 30), "/");
    }else{
        $user_id = $_COOKIE['user_id'];
    }
?>
