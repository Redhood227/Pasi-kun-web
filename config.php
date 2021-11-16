<?php
                session_start(); 
                $_SESSION["userID"] = $_POST["userID"];
                $s = "SELECT * FROM info WHERE user_id='$userID'";
                $r = mysqli_query($conn, $s);
                $count = mysqli_num_rows($r);

                if($count==1){
                    header("location:edit_form.php");
                }
                else{
                    header("location:addinfo.php");
                }
                
                ?>