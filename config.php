<?php

                require("connect.php");
                echo $_POST("user_id");
                $user_id = $_POST("user_id");
                $_SESSION['user_id'] = $user_id;
                $s = "SELECT * FROM info WHERE user_id='$user_id'";
                $r = mysqli_query($conn, $s);
                $count = mysqli_num_rows($r);

                /*if($count==1){
                    header("location:edit_form.php");
                }
                else{
                    header("location:addinfo.php");
                }*/
                
                ?>