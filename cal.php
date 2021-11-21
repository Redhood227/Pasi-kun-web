<?php
global $netinc,$totalDis;

function caltax($netinc)
{
    $base=0;
    if ($netinc <= 150000) {
        $sum1 = 0;
    } elseif (300000 >= $netinc) {
        $first = $netinc - 150000;
        $sum1 = ($first * 5) / 100;
        $base = 0.05;
    } elseif (500000 >= $netinc) {
        $second = $netinc - 300000;
        $sum1 = (($second * 10) / 100) + 7500;
        $base = 0.1;
    } elseif (750000 >= $netinc) {
        $third = $netinc - 500000;
        $sum1 = (($third * 15) / 100) + 27500;
        $base = 0.15;
    } elseif (1000000 >= $netinc) {
        $forth = $netinc - 750000;
        $sum1 = (($forth * 20) / 100) + 65000;
        $base = 0.2;
    } elseif (2000000 >= $netinc) {
        $fifth = $netinc - 1000000;
        $sum1 = (($fifth * 25) / 100) + 115000;
        $base = 0.25;
    } elseif (5000000 >= $netinc) {
        $sixth = $netinc - 2000000;
        $sum1 = (($sixth * 30) / 100) + 365000;
        $base = 0.3;
    } elseif ($netinc > 5000000) {
        $seventh = $netinc - 750000;
        $sum1 = (($seventh * 35) / 100) + 1265000;
        $base = 0.35;
    }
    return $sum1;
}

function cal($result)
{
    $totalDis=0;
    //รวมรายได้และหักค่าใช้จ่าย
    $netinc = $result['salary'] + $result['bonus'];
    if ($result['income'] >= 120000) {
        $sum2 = $result['income'] * 0.005;
        if($sum2<=5000){
            $sum2 = 0;
        }
    }
    $netinc = $netinc + $result['income'];
    if ($netinc <= 200000) {
        $netinc = $netinc * 50 / 100;
        $totalDis = $totalDis + ($netinc * 50 / 100);
    } else {
        $netinc = $netinc - 100000;
        $totalDis = $totalDis + 100000;
    }

    //การลดหย่อนส่วนตัวและครอบครัว
    $netinc = $netinc - 60000;
    if ($result['mStatus'] == 3) {
        $netinc = $netinc - 60000;
        $totalDis = $totalDis + 60000;
    }
    if ($result['nChild'] > 0) {
        $netinc = $netinc - (30000 * $result['nChild']);
        $totalDis = $totalDis + (30000 * $result['nChild']); 
    }
    if ($result['nParent'] > 0) {
        if ($result['nParent'] < 4) {
            $netinc = $netinc - (30000 * $result['nChild']);
            $totalDis = $totalDis + (30000 * $result['nChild']);
        } else {
            $netinc = $netinc - (30000 * 4);
            $totalDis = $totalDis + (30000 * 4);
        }
    }

    //เงินออม การลงทุน ประกัน + พวกใช้เงื่อนไขด้วยกัน
    $total=0;
    if ($result['rmf']<=(30/100*($result['salary'] + $result['bonus'] +  $result['income']))){
        $total = $result['rmf'];
    }
    else{
        $total = (30/100*($result['salary'] + $result['bonus'] +  $result['income']));
    }
    if($result['nsf']<=13200){
        $total = $total + $result['nsf'];
    }
    else{
        $total = $total + 13200;
    }
    if($result['ssf'] <= (30/100*($result['salary'] + $result['bonus'] +  $result['income'])) && $result['ssf']<=200000){
        $total = $total + $result['ssf'];
    }
    else{
        if((30/100*($result['salary'] + $result['bonus'] +  $result['income'])) < 200000){
            $total = $total + (30/100*($result['salary'] + $result['bonus'] +  $result['income']));
        }
        else{
            $total = $total + 200000;
        }
    }
    //ไม่มีเงื่อนไขร่วมกับอันอื่น
    if($result['ssfx']<=200000){
        $netinc = $netinc - $result['ssfx'];
        $totalDis = $totalDis + $result['ssfx'];
    }
    else{
        $netinc = $netinc - 200000;
        $totalDis = $totalDis + 200000;
    }
    if($result['insurance']<=100000){
        $netinc = $netinc - $result['insurance'];
        $totalDis = $totalDis + $result['insurance'];
    }
    else{
        $netinc = $netinc - 100000;
        $totalDis = $totalDis + 100000;
    }

    if($result['Ainsurance']<=(15/100*($result['salary'] + $result['bonus'] +  $result['income'])) && $result['Ainsurance']<=200000){
        $total = $total + $result['Ainsurance'];
    }
    else{
        if((15/100*($result['salary'] + $result['bonus'] +  $result['income'])) < 200000){
            $total = $total + (15/100*($result['salary'] + $result['bonus'] +  $result['income']));
        }
        else{
            $total = $total + 200000;
        }
    }
    if($result['pFund']<=(15/100*($result['salary'] + $result['bonus']))){
        $total = $total + $result['pFund'];
    }
    else{
        $total = $total + (15/100*($result['salary'] + $result['bonus']));
    }

    //ประกันสังคม+ดอกเบี้ยกู้บ้าน
    if($result['socSecur']<=9000){
        $netinc = $netinc - $result['socSecur'];
        $totalDis = $totalDis + $result['socSecur'];
    }
    else{
        $netinc =  $netinc - 9000;
        $totalDis = $totalDis + 9000;
    }
    if($result['hLoan']<=100000){
        $netinc = $netinc - $result['hLoan'];
        $totalDis = $totalDis + $result['hLoan'];
    }
    else{
        $netinc = $netinc - 100000;
        $totalDis = $totalDis + 100000;
    }
    
    //พรวกรวมเงื่อนไช
    if($total <= 500000){
        $netinc = $netinc -$total;
        $totalDis = $totalDis + $total;
    }
    else{
        $netinc = $netinc -500000;
        $totalDis = $totalDis + 500000;
    }

    //การบริจาค
    if($result['plubDonation']<=10000){
        $netinc=$netinc-$result['plubDonation'];
        $totalDis = $totalDis + $result['plubDonation'];
    }
    else{
        $netinc=$netinc-10000;
        $totalDis = $totalDis + 10000;
    }

    $totalD = $result['donation'] + $result['floDonation'] + ($result['eduDonation']*2);
    $taxD=0;
    if($totalD<=(10/100)*$netinc){
        $taxD=$taxD+$totalD;
    }
    else{
        $taxD=$taxD+(10/100)*$netinc;
    }
    $netinc=$netinc-$taxD;
    $totalDis = $totalDis + $taxD;
    $sum1 = caltax($netinc);
    if($sum1 > $sum2){
        return $sum1;
    }
    else{
        return $sum2;
    }
}



require('sendMessage.php');
//error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$time = date("H:i:s");
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$input = fopen("log_json.txt", "w") or die("Unable to open file!");
fwrite($input, $json);
fclose($input);

function processMessage($update)
{
    if ($update["queryResult"]["action"] == "sayHello") {
        sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText" => "Hello from webhook",
            "payload" => array(
                "items" => [
                    array(
                        "simpleResponse" =>
                        array(
                            "textToSpeech" => "response from host"
                        )
                    )
                ],
            ),

        ));
    } else if ($update["queryResult"]["action"] == "school") {
        $json = file_get_contents('php://input');
        $request = json_decode($json, true);
        require("connect.php");
        $user_id =  $request['originalDetectIntentRequest']['payload']['data']['source']['userId'];
        $sql = "SELECT * FROM info where user_id ='$user_id'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $r = mysqli_fetch_assoc($result);
            $total = cal($r);
            $flexDataJson = '{
                "type": "flex",
                "altText": "Flex Message",
                "contents": {
                    "type": "carousel",
                    "contents": [
                        {
                            "type": "bubble",
                            "header": {
                                "type": "box",
                                "layout": "horizontal",
                                "contents": [
                                    {
                                        "type": "box",
                                        "layout": "vertical",
                                        "contents": [
                                            {
                                                "type": "text",
                                                "text": "Pasi-kun",
                                                "weight": "bold",
                                                "size": "xl",
                                                "color": "#0021FFFF",
                                                "contents": []
                                            },
                                            {
                                                "type": "text",
                                                "text": "สรุปผล",
                                                "weight": "bold",
                                                "size": "xxl",
                                                "contents": []
                                            },
                                            {
                                                "type": "separator",
                                                "margin": "lg"
                                            }
                                        ]
                                    }
                                ]
                            },
                            "body": {
                                "type": "box",
                                "layout": "horizontal",
                                "contents": [
                                    {
                                        "type": "box",
                                        "layout": "vertical",
                                        "contents": [
                                            {
                                                "type": "text",
                                                "text": "ค่าลดหย่อน",
                                                "contents": []
                                            },
                                            {
                                                "type": "text",
                                                "text": "เงินได้สุทธิ",
                                                "margin": "lg",
                                                "contents": []
                                            },
                                            {
                                                "type": "separator",
                                                "margin": "lg"
                                            },
                                            {
                                                "type": "text",
                                                "text": "ภาษีที่ต้องจ่าย",
                                                "weight": "bold",
                                                "margin": "md",
                                                "contents": []
                                            }
                                        ]
                                    },
                                    {
                                        "type": "box",
                                        "layout": "vertical",
                                        "contents": [
                                            {
                                                "type": "text",
                                                "text": "'.$totalDis.' บาท",
                                                "align": "end",
                                                "gravity": "top",
                                                "contents": []
                                            },
                                            {
                                                "type": "text",
                                                "text": "'.$netinc.' บาท",
                                                "align": "end",
                                                "gravity": "center",
                                                "margin": "lg",
                                                "contents": []
                                            },
                                            {
                                                "type": "separator",
                                                "margin": "lg"
                                            },
                                            {
                                                "type": "text",
                                                "text": "'.$total.' บาท",
                                                "weight": "bold",
                                                "align": "end",
                                                "gravity": "center",
                                                "margin": "md",
                                                "contents": []
                                            }
                                        ]
                                    }
                                ]
                            }
                        }
                    ]
                }
            }';
            $flexDataJsonDeCode = json_decode($flexDataJson, true);

            $datas['url'] = "https://api.line.me/v2/bot/message/push";
            $datas['token'] = "3/Mp4TwJW1nEWKWe/I6jIHC6SkkSWa739lSdPoMSAlIUxpMB2zRfwow6ZHiBLaBl/87gHDv+ZA/3DHWbi/RErr0zHQnBpn2kTfgU15u3nHEPyV4b+yjEMlPnnLy8peqNibg+m2+CgZGsvvL9eg6YBQdB04t89/1O/w1cDnyilFU=";
            $messages['to'] = $user_id;
            $messages['messages'][] = $flexDataJsonDeCode;
            $encodeJson = json_encode($messages);


            sentMessage($encodeJson, $datas);
        }

        if (!$result) {
            sendMessage(array(
                "source" => $update["responseId"],
                "fulfillmentText" => "ไม่มีข้อมูลในระบบ",
                "payload" => array(
                    "items" => [
                        array(
                            "simpleResponse" =>
                            array(
                                "textToSpeech" => "response from host"
                            )
                        )
                    ],
                ),

            ));
        }
    } else {
        sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText" => "ไม่ได้อยู่ใน intent ใดใด",
            "payload" => array(
                "items" => [
                    array(
                        "simpleResponse" =>
                        array(
                            "textToSpeech" => "Bad request"
                        )
                    )
                ],
            ),

        ));
    }
}

function sendMessage($parameters)
{
    echo json_encode($parameters);
}

$update_response = file_get_contents("php://input");
$update = json_decode($update_response, true);
if (isset($update["queryResult"]["action"])) {
    processMessage($update);
} else {
    sendMessage(array(
        "source" => $update["responseId"],
        "fulfillmentText" => "Hello from webhook",
        "payload" => array(
            "items" => [
                array(
                    "simpleResponse" =>
                    array(
                        "textToSpeech" => "Bad request"
                    )
                )
            ],
        ),

    ));
}



