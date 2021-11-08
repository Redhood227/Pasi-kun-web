<?php
    $servername = "localhost";
    $username = "root";
    $password ="";
    $db = "user_info";
    
    $conn = mysqli_connect($servername,$username,$password,$db);
    
    mysqli_set_charset($conn, "utf8");
    
    if(!$conn){
        die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้".mysqli_connect_error());
    }else{
        echo "เชื่อมต่อข้อมูลสำเร็จ";
    }


