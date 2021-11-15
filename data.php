<?php
    require("connect.php");
    
    if(isset($_POST['salary'])){
        $user_id = $arr["user_id"];
        $salary = $_POST['salary'];
        $bonus = $_POST['bonus'];
        $income= $_POST['income'];
        $mStatus = $_POST['mStatus'];
        $nChild = $_POST['nChild'];
        $nParent = $_POST['nParent'];
        $rmf = $_POST['rmf'];
        $nsf = $_POST['nsf'];
        $ssf = $_POST['ssf'];
        $ssfx = $_POST['ssfx'];
        $insurance = $_POST['insurance'];
        $Ainsurance = $_POST['Ainsurance'];
        $donation = $_POST['donation'];
        $eduDonation = $_POST['eduDonation'];
        $floDonation = $_POST['floDonation'];
        $plubDonation = $_POST['plubDonation'];
        $hLoan = $_POST['hLoan'];
        $socSecur = $_POST['socSecur'];
        $pFund = $_POST['pFund'];
        
        $sql = "INSERT INTO info (id,user_id,salary,bonus,income,mStatus,nChild,nParent,rmf,nsf,ssf,ssfx,insurance,Ainsurance,donation,eduDonation,floDonation,plubDonation,hLoan,socSecur,pFund)
                VALUES(null,'$user_id','$salary','$bonus','$income','$mStatus','$nChild','$nParent','$rmf','$nsf','$ssf','$ssfx','$insurance','$Ainsurance','$donation','$eduDonation','$floDonation','$plubDonation','$hLoan','$socSecur','$pFund')";
        
        if(mysqli_query($conn, $sql)) {
            echo "<br>บันทึกข้อมูลเสร็จสิ้น";
        }else{
            echo"Error: ".$sql."<br>".mysqli_error($conn);
        }
    }

    else if(isset($_POST['edit_user_id'])){
        $salary = $_POST['edit_salary'];
        $bonus = $_POST['edit_bonus'];
        $income= $_POST['edit_income'];
        $mStatus = $_POST['edit_mStatus'];
        $nChild = $_POST['edit_nChild'];
        $nParent = $_POST['edit_nParent'];
        $rmf = $_POST['edit_rmf'];
        $nsf = $_POST['edit_nsf'];
        $ssf = $_POST['edit_ssf'];
        $ssfx = $_POST['edit_ssfx'];
        $insurance = $_POST['edit_insurance'];
        $Ainsurance = $_POST['edit_Ainsurance'];
        $donation = $_POST['edit_donation'];
        $eduDonation = $_POST['edit_eduDonation'];
        $floDonation = $_POST['edit_floDonation'];
        $plubDonation = $_POST['edit_plubDonation'];
        $hLoan = $_POST['edit_hLoan'];
        $socSecur = $_POST['edit_socSecur'];
        $pFund = $_POST['edit_pFund'];
        
        $user_id = $_POST['edit_user_id'];
        
        $sql = "UPDATE info SET salary='$salary',bonus='$bonus',income='$income',mStatus='$mStatus',nChild='$nChild',nParent='$nParent',rmf='$rmf',nsf='$nsf',ssf='$ssf',
                                        ssfx='$ssfx',insurance='$insurance',Ainsurance='$Ainsurance',donation='$donation',eduDonation='$eduDonation',floDonation='$floDonation',
                                        plubDonation='$plubDonation',hLoan='$hLoan',socSecur='$socSecur',pFund='$pFund' WHERE user_id=$user_id";
        
        if(mysqli_query($conn, $sql)) {
            echo "<br>บันทึกข้อมูลเสร็จสิ้น";
        }else{
            echo"Error: ".$sql."<br>".mysqli_error($conn);
        }
    }
    
        
        if(isset($_GET['delete_id'])){
            $id = $_GET['delete_id'];
            
            $sql = "DELETE FROM info WHERE id=$id";
            
            if(mysqli_query($conn, $sql)){
                echo "<br>ลบเรียบร้อย" ;
                echo "<br><a href='index.php'>ตรวจสอบข้อมูล</a>";
            }else{
            echo"Error: ".$sql."<br>".mysqli_error($conn);
        }
            
        }
        

