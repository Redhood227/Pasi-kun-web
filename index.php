<?php
    require("connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>user info</title>
    </head>
    <body>
    <script src="https://static.line-scdn.net/liff/edge/versions/2.5.0/sdk.js"></script>
    <script src="https://restapi.tu.ac.th/tuapi/resources/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="https://restapi.tu.ac.th/tuapi/resources/assets/js/core/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

        <script>
            liff.init({ liffId: "1656562991-6qEqpDY4" }, () => {
                if (liff.isLoggedIn()) {
                    liff.getProfile().then(profile => {
                        document.getElementById('user_id').value = profile.userId;
                    }).catch(
                         err => console.error(err)
                    );
                } else {
                    liff.login();
                }
        }, err => console.error(err.code, error.message));
        $(document).ready(function(){
            var url = window.location.href;
            var params = url.split('?ID=');
            var id = (params[1]);
            $.ajax({
            type:"POST",
            url:"index.php",
            data:{id:user_id},
            success:function(result){
            $("#content").html(result);
            }
        });
   });


        </script>
        
            
            <?php
                $user_id = $_POST['user_id'];
                $s = "SELECT * FROM info WHERE user_id='$user_id'";
                $r = mysqli_query($conn, $s);
                $count = mysqli_num_rows($r);

                if($count==1){
                    header("location:edit_form.php");
                }
                else{
                    header("location:addinfo.php");
                }
                
                ?>
            
        
    </body>
</html>

