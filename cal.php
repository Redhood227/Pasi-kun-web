<?php
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
            $netinc = cal($r);
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
                                                "type": "text",
                                                "text": "ชื่อโปรไฟล์",
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
                                                "text": "เงินได้สุทธิ",
                                                "contents": []
                                            },
                                            {
                                                "type": "text",
                                                "text": "ค่าลดหย่อน",
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
                                                "text": "บาท",
                                                "align": "end",
                                                "gravity": "top",
                                                "contents": []
                                            },
                                            {
                                                "type": "text",
                                                "text": "บาท",
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
                                                "text": "บาท",
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
    //รวมรายได้และหักค่าใช้จ่าย
    $netinc = $result['salary'] + $result['bonus'];
    if ($result['income'] >= 120000) {
        $sum2 = $result['income'] * 0.005;
    }
    $netinc = $netinc + $result['income'];
    if ($netinc <= 200000) {
        $netinc = $netinc * 50 / 100;
    } else {
        $netinc = $netinc - 100000;
    }

    //การลดหย่อนส่วนตัวและครอบครัว
    $netinc = $netinc - 60000;
    if ($result['mStatus'] == 3) {
        $netinc = $netinc - 60000;
    }
    if ($result['nChild'] > 0) {
        $netinc = $netinc - (30000 * $result['nChild']);
    }
    if ($result['nParent'] > 0) {
        if ($result['nParent'] < 4) {
            $netinc = $netinc - (30000 * $result['nChild']);
        } else {
            $netinc = $netinc - (30000 * 4);
        }
    }



    //ประกัน เงินออม การลงทุน
    $first = caltax($netinc);
    //$base1 = $GLOBALS["base"];
}