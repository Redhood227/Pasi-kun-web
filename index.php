<?php
    require("connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>user info</title>
    </head>
    <body>
        <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
        <script type="text/javascript">
            initializeLiff();
            liff.init({
                liffId: "1656562991-6qEqpDY4"
            }).then(() => {
                        liff.getProfile()
                        document.getElementById('user_id').innerHTML = profile.userId;
                        document.getElementById('displayName').innerHTML = profile.displayName;
                        document.write(profile.userId);
            });
        
        </script>

                <p id="user_id"><span id="user_id"></span></p>
                <p id="displayName"><span id="displayName"></span></p>
            
            <?php

                
                
                /*$sql = "SELECT * FROM info";
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
                }*/
                
                ?>
            
        </table>
        
    </body>
</html>