<?php
    require("connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>user info</title>
        <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
        <input type = "hidden" name="user_id" >
        <script>
            await liff.init({ liffId: "1656562991-6qEqpDY4" })
            const profile = await liff.getProfile()
            user_id.innerHTML = profile.userId
        </script>
    </head>
    <body>
        
        <table border="1">
            <tr>
                <th width="10%">ลำดับ</th>
                <th width="30%">เงินเดือน(รายปี)</th>
                <th width="30%">โบนัส</th>
                <th width="30%">รายได้อื่นๆ</th>
            </tr>
            
            <?php

                
                
                $sql = "SELECT * FROM info";
                $s = "SELECT CASE WHEN EXISTS 
                (
                      SELECT user_id FROM info WHERE user_id
                )
                THEN 'TRUE'
                ELSE 'FALSE'";
                $result = mysqli_query($conn, $sql);
                $r = mysqli_query($conn, $s);
                $i = 1;
                
                
                if(!$r){
                    header("location:addinfo.php");
                }else{
                    header("location:edit_form.php");
                }
                
                ?>
            
        </table>
        
    </body>
</html>

