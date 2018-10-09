<?php
$server = "us-cdbr-iron-east-01.cleardb.net";
    $username = "b798786b8aa714";
    $password = "2e0e0451";
    $db = "heroku_ce52199dd4f50e1";
    $conn = new mysqli($server, $username, $password, $db);
function reply_msg($txtback,$replyToken)//สร้างข้อความและตอบกลับ
{
    $access_token = 'nneB0i9dvR1YtaiyvGGBuUuqPFVXSYL1rmr0oYU6b/+EcrLxNiZC+wrpagX5Hw+M4Bd/xp+92FIw58mZFguVVt5wqf094B0armpKuMjbdMUKFhqonjjdR6BPcUJc2zs3DL/mzEtaWwLW/OmQdxKNkwdB04t89/1O/w1cDnyilFU=';
    $messages = ['type' => 'text','text' => $txtback];//สร้างตัวแปร 
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
    $post = json_encode($data);
    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result . "\r\n";
}
$content = file_get_contents('php://input');//รับข้อมูลจากไลน์
$events = json_decode($content, true);//แปลง json เป็น php 
if (!is_null($events['events'])) //check ค่าในตัวแปร $events
{
	foreach ($events['events'] as $event) //
	{
		if ($event['type'] == 'message' && $event['message']['type'] == 'text')
		{
			$replyToken = $event['replyToken']; //เก็บ reply token เอาไว้ตอบกลับ
			$txtin = $event['message']['text'];//เอาข้อความจากไลน์ใส่ตัวแปร $txtin
			$sql_text = "SELECT * FROM tbl_kanjanasid WHERE name = '".$txtin."'";
			$query  = mysqli_query($conn,$sql_text);
			while($obj = mysqli_fetch_array($query))
			{
				$txtback = $obj["lastname"];
				reply_msg($txtback,$replyToken);
			}
		}
	}
}
?>