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
                liff.ready.then(async () => {
                    liff.getProfile().then(function (profile) {
                        document.getElementById('user_id').value = profile.userId;
                        document.getElementById('displayName').value = profile.displayName;
            }).catch(function (error) {
                            
                            window.alert('Error getting profile: ' + error);
                        
                    });
        </script>

                <p id="user_id"></p>
                <p id="displayName"></p>
            
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

