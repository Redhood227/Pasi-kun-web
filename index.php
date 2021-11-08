<?php
    require("connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>user info</title>
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
                
                $result = mysqli_query($conn, $sql);
                $i = 1;
                
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo"<td>".$i."</td>";
                    echo"<td style='text-align:right;'>". number_format($row['salary'])."</td>";
                    echo"<td style='text-align:right;'>". number_format($row['bonus'])."</td>";
                    echo"<td style='text-align:right;'>". number_format($row['income'])."</td>";
                    echo"<td><a href='edit_form.php?id=".$row['id']." '>แก้ไข</a></td>";
                    echo"<td><a href='data.php?delete_id=".$row['id']."  'onclick='return confirm(\"คุณต้องการลบข้อมูลหรือไม่\")'>ลบ</a></td>";
                    echo "<tr>";
                    
                    $i++;
                    }
                }else{
                    echo "EMPTY DATA";
                }
                
                ?>
            
        </table>
        
    </body>
</html>

