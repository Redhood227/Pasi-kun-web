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
        $(document).ready(function () {
        createCookie("ีuser_id", profile.userId, "10");
});

function createCookie(name, value, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  }
  else {
    expires = "";
  }
  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}
        </script>
<?php
    require("connect.php");
    
        $edit_user_id = $_COOKIE['user_id'];
        $s = "SELECT * FROM info WHERE user_id='".$edit_user_id."'";
        $row = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($row);
        
        if(!$result){
            echo "Error: ".$sql."<br>".mysqli_error($conn);
    }
?>
<html lang="th">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pasi-kun :Collect information</title>
        <link rel="stylesheet" href="main.css">
    </head>
    
    
    <body>

    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <h1>Pasi-kun</h1>
                </div>
                <div class="write">
                    <h1>โปรดกรอกข้อมูลของท่าน</h1>
                </div>
            </nav>
        
        <form action="data.php" method="post">
            <fieldset>
            <fieldset>
                    <div class="col-container">
                        <section class="headerl-info">
                            <div class="header-title1">
                                <h2>รายได้ของคุณ</h2>
                            </div>
                            <div class="headerl-content">
                                
                                    <br>
                                    <label>เงินเดือน(รายปี)</label>
                                    <input type="number" name="edit_salary" min="0" required value="<?php echo $result['salary']?>">
                                    <label1>บาท</label1>
                                
                                    <label>โบนัส</label>
                                    <input type="number" name="edit_bonus" min="0" required value="<?php echo $result['bonus']?>">
                                    <label1>บาท</label1>
                                
                                    <label>รายได้อื่น ๆ</label>
                                    <input type="number" name="edit_income" min="0" required value="<?php echo $result['income']?>">
                                    <label1>บาท</label1>
                                
                            </div>
                            <br>
                            <div class="header-title2">
                                <h2>ลดหย่อนส่วนบุคคล</h2>
                            </div>
                            <div class="headerl-content">
                                
                                    <br>
                                    <label for="status" id="status">สถานสมรส</label>
                                    <select name="edit_mStatus">
                                        <option value='<?php echo $result['mStatus']?>' selected='selected'></option>
                                        <option value="0" <?php if($result['mStatus']=="0") echo 'selected="selected"'; ?> >>โสด</option>
                                        <option value="1" <?php if($result['mStatus']=="1") echo 'selected="selected"'; ?>>หย่า</option>
                                        <option value="2" <?php if($result['mStatus']=="2") echo 'selected="selected"'; ?>>คู่สมรสมีเงินได้(แยกยื่น)</option>
                                        <option value="3" <?php if($result['mStatus']=="3") echo 'selected="selected"'; ?>>คู่สมรสไม่มีเงินได้</option>
                                    </select>
                                
                                    <label>บุตร (ถ้ามี)</label>
                                    <input type="number" name="edit_nChild" min="0" required value="<?php echo $result['nChild']?>">
                                    <label1>คน</label1>
                                
                                    <label>บิดา-มารดา</label>
                                    <input type="number" name="edit_nParent" min="0" required value="<?php echo $result['nParent']?>">
                                    <label1>คน</label1>
                                
                            </div>
                            <br>
                            <div class="header-title3">
                                <h2>กองทุน</h2>
                            </div>
                            <div class="headerl-content">
                                
                                    <br>
                                    <label for="rmf" id="rmf">กองทุนเพื่อการเลี้ยงชีพ</label>
                                    <input type="number" name="edit_rmf" min="0" required value="<?php echo $result['rmf']?>">
                                    <label1>บาท</label1>
                                
                                    <label>กองทุนการออมแห่งชาติ</label>
                                    <input type="number" name="edit_nsf" min="0" required value="<?php echo $result['nsf']?>">
                                    <label1>บาท</label1>
                                
                                    <label>กองทุนเพื่อการออม</label>
                                    <input type="number" name="edit_ssf" min="0" required value="<?php echo $result['ssf']?>">
                                    <label1>บาท</label1>
                                
                                    <label>กองทุนเพื่อการออมพิเศษ</label>
                                    <input type="number"  name="edit_ssfx" min="0" required value="<?php echo $result['ssfx']?>">
                                    <label1>บาท</label1>
                                
                            </div>
                        </section>

                        <section class="headerr-info">
                            <div class="header-title4">
                                <h2>ประกันชีวิต</h2>
                            </div>
                            <div class="headerr-content">
                                
                                    <br>
                                    <label>เบี้ยประกันชีวิต</label>
                                    <input type="number" name="edit_insurance" min="0" required value="<?php echo $result['insurance']?>">
                                    <label1>บาท</label1>
                                
                                    <label>เบี้ยประกันชีวิตแบบบำนาญ</label>
                                    <input type="number" name="edit_Ainsurance" min="0" required value="<?php echo $result['Ainsurance']?>">
                                    <label1>บาท</label1>
                                
                            </div>

                            <br>
                            <div class="header-title5">
                                <h2>เงินบริจาค</h2>
                            </div>
                            <div class="headerr-content">
                                
                                    <br>
                                    <label>ทั่วไป</label>
                                    <input type="number" name="edit_donation" min="0" required value="<?php echo $result['donation']?>">
                                    <label1>บาท</label1>
                                
                                    <label>การศึกษา</label>
                                    <input type="number" name="edit_eduDonation" min="0" required value="<?php echo $result['eduDonation']?>">
                                    <label1>บาท</label1>
                               
                                    <label>ช่วยเหลืออุทกภัย</label>
                                    <input type="number" name="edit_floDonation" min="0" required value="<?php echo $result['floDonation']?>">
                                    <label1>บาท</label1>
                                
                                    <label>สาธารณประโยชน์</label>
                                    <input type="number" name="edit_plubDonation" min="0" required value="<?php echo $result['plubDonation']?>">
                                    <label1>บาท</label1>
                                
                            </div>

                            <br>
                            <div class="header-title6">
                                <h2><span></span>อื่น ๆ</h2>
                            </div>
                            <div class="headerr-content">
                                
                                    <br>
                                    <label>ค่าดอกเบี้ยกู้บ้าน</label>
                                    <input type="number" name="edit_hLoan" min="0" required value="<?php echo $result['hLoan']?>">
                                    <label1>บาท</label1>
                                
                                    <label>ประกันสังคม</label>
                                    <input type="number" name="edit_socSecur" min="0" required value="<?php echo $result['socSecur']?>">
                                    <label1>บาท</label1>
                               
                                    <label>เงินสะสมกองทุนสำรองเลี้ยงชีพ</label>
                                    <input type="number" name="edit_pFund" min="0" required value="<?php echo $result['pFund']?>">
                                    <label1>บาท</label1>
                            
                            </div>
                        </section>
                    </div>
                    <input id="edit_user_id" name="edit_user_id" type="hidden">
                    <section class="btn">
                        <div class="nav-btn">
                            <input type="submit" value="บันทึกข้อมูล">
                        </div>
                    </section>
        </div>
    </header>

    </fieldset>
    </form>
    </body>
    
</html>

