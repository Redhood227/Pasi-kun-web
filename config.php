<?php
                session_start(); 
                require("connect.php");
                $userID = $_POST["user_id"];
                $_SESSION["user_id"] = $_POST["user_id"];
                $s = "SELECT * FROM info WHERE user_id='$userID'";
                $user_id = $_POST["user_id"];
                $s = "SELECT * FROM info WHERE user_id='$user_id'";
                $r = mysqli_query($conn, $s);
                $count = mysqli_num_rows($r);
                
                ?>