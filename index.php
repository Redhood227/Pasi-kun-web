<?php
    require("connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>user info</title>
        <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
        <script>
            liff.init({ liffId: "1656562991-6qEqpDY4" }, () => {
                if (liff.isLoggedIn()) {
                    liff.getProfile().then(profile => {
                        const userProfile = profile.userId;
                    }).catch(
                         err => console.error(err)
                    );
                } else {
                    liff.login();
                }
        }, err => console.error(err.code, error.message));
        </script>
    </head>
    <body>
            
            <?php

                
                
                $sql = "SELECT * FROM info";
                $s = "SELECT CASE WHEN EXISTS 
                (
                      SELECT user_id FROM info WHERE user_id
                )
                THEN 'TRUE'
                ELSE 'FALSE'";
                $r = mysqli_query($conn, $s);
                
                if(!$r){
                    header("location:addinfo.php");
                }else{
                    header("location:edit_form.php");
                }
                
                ?>
            
        </table>
        
    </body>
</html>

