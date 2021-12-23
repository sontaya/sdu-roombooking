<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('vendor/autoload.php');

class Lineapi extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('linelogin');
		$this->load->model('Booking_model');
		$this->load->model('User_model');

	}


	public function login(){
		$url = $this->linelogin->getLink(1); // ขอ permission สำหรับเข้าถึง profile, email
		// echo $url;
		redirect($url);
	}

	public function callback_login(){
		$get = $this->input->get(); // รับ json payload

		// print_r($get);
		$code = $get['code'];
		$state = $get['state'];

		// curl เพื่อขอ id_token
		$token = $this->linelogin->token($code,$state);
		$objToken = json_decode($token);

		$resJson = $this->linelogin->decode_token($objToken->id_token);
		$res = json_decode($resJson);

		// print_r($resJson);

		$user_id = $this->global_data['user_id'];
		$line_sub = $res->sub;
		$line_iat = $res->iat;
		$line_exp = $res->exp;


		// --Update line profile to user
		$user = $this->User_model->list(array('conditions'=>array('user_id'=>$user_id)));

			$userdata = array(
				'line_sub' => $line_sub,
				'line_iat' => $line_iat,
				'line_exp' => $line_exp,
				'modified_at' => $this->global_data['timestamp'],
				'modified_by_ip' => $this->global_data['client_ip']
			);
			// print_r($userdata);

		  $update_res =	$this->User_model->update($user_id,$userdata);
		//   echo $user_id . "->" . $update_res;

		redirect('user/profile');

		// header('Content-Type: application/json');
		// echo json_encode($res);
		// echo $res;

	}

	public function callback(){

		// Access Token
		$access_token = "6MVKe9VcZEZBP/xdPLbxWcPfSKsqjlmo83JkPPaKXLWLecE8fvwDG1TCVjr0yDSTwbBLjA3Tig/x5Wq6vrBLMBKiSubuSpqNCuMZSs1//nr4WMx8kBF3tOzYF3QnDRi7Ii97MHzo+hjBLU6GDD/ctgdB04t89/1O/w1cDnyilFU=";

		// รับค่าที่ส่งมา
		$content = file_get_contents('php://input');
		// แปลงเป็น JSON
		$events = json_decode($content, true);
		if (!empty($events['events'])) {
			foreach ($events['events'] as $event) {
				if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
					// ข้อความที่ส่งกลับ มาจาก ข้อความที่ส่งมา
					// ร่วมกับ USER ID ของไลน์ที่เราต้องการใช้ในการตอบกลับ
					$messages = array(
						'type' => 'text',
						'text' => 'Reply message : '.$event['message']['text']."\nUser ID : ".$event['source']['userId'],
					);
					$post = json_encode(array(
						'replyToken' => $event['replyToken'],
						'messages' => array($messages),
					));
					// URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
					$url = 'https://api.line.me/v2/bot/message/reply';
					$headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					$result = curl_exec($ch);
					curl_close($ch);
					echo $result;
				}
			}
		}


	}

	public function bot_notify(){

		// Access Token
		$access_token = "6MVKe9VcZEZBP/xdPLbxWcPfSKsqjlmo83JkPPaKXLWLecE8fvwDG1TCVjr0yDSTwbBLjA3Tig/x5Wq6vrBLMBKiSubuSpqNCuMZSs1//nr4WMx8kBF3tOzYF3QnDRi7Ii97MHzo+hjBLU6GDD/ctgdB04t89/1O/w1cDnyilFU=";

				// User ID
		$userId = 'Uf4bf280bb39513328a3fbea4dcfdbd7a';
		// ข้อความที่ต้องการส่ง
		$messages = array(
			'type' => 'text',
			'text' => 'ทดสอบการส่งข้อความ',
		);
		$post = json_encode(array(
			'to' => array($userId),
			'messages' => array($messages),
		));
		// URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
		$url = 'https://api.line.me/v2/bot/message/multicast';
		$headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($ch);
		echo $result;

	}

	public function bot_notify_user(){

		$booking_info_id = $this->input->post('booking_info_id');

		if(LINE_NOTIFY == 'ON'){
			$conditions = array(
				'id' => $booking_info_id
			);
			$info = $this->Booking_model->list(array('conditions'=>$conditions))[0];

			if($info["line_sub"] != ""){

				if($info["booking_status"] == "rejected"){
					$reason = "(". $info["booking_status_reason"] .")";
				}else{
					$reason = "";
				}

				$user_line_id = $info["line_sub"];
				$user_message = "รายการจองห้อง: ".$info["room_name"]."\n".
									"กิจกรรม: " .$info["objective"]."\n".
									"วันที่ เวลา: ".get_thai_datetime($info["booking_date_start"],1,true)." ถึง ". get_thai_datetime($info["booking_date_end"],1,true)."\n".
									"สถานะการจอง: ". $info["booking_status_desc"] . $reason;
				// ข้อความที่ต้องการส่ง
				$messages = array(
					'type' => 'text',
					'text' => $user_message,
				);
				$post = json_encode(array(
					'to' => array($user_line_id),
					'messages' => array($messages),
				));
				// URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
				$url = 'https://api.line.me/v2/bot/message/multicast';
				$headers = array('Content-Type: application/json', 'Authorization: Bearer '.LINE_MESSAGE_ACCESS_TOKEN);
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				echo $result;

			}
		}




	}

	public function callback2(){
		$secret_key = "e4ed91d7f8442fa14047c93bb074111d";
		$access_token = "6MVKe9VcZEZBP/xdPLbxWcPfSKsqjlmo83JkPPaKXLWLecE8fvwDG1TCVjr0yDSTwbBLjA3Tig/x5Wq6vrBLMBKiSubuSpqNCuMZSs1//nr4WMx8kBF3tOzYF3QnDRi7Ii97MHzo+hjBLU6GDD/ctgdB04t89/1O/w1cDnyilFU=";

		// $httpClient = new LINEBot\HTTPClient\CurlHTTPClient($access_token);
		// $bot = new LINEBot($httpClient, ['channelSecret' => $secret_key]);


		// $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
		// $response = $bot->replyMessage('<reply token>', $textMessageBuilder);
		// if ($response->isSucceeded()) {
		// 	echo 'Succeeded!';
		// 	return;
		// }
		// echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

		// $signature = $_SERVER['HTTP_' .LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
		// $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);

		// foreach ($events as $event) {
		// 	if (($event instanceof LINEBot\Event\MessageEvent\TextMessage)) {
		// 		$outputText = new LINEBot\MessageBuilder\TextMessageBuilder('สวัสดีจ้า');
		// 	}

		// 	$bot->replyMessage($event->getReplyToken(), $outputText);
		// }


		$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret_key]);

        //recieve data from LINE Messaging API
        $content = file_get_contents('php://input');

        //decode json to array
        $events = json_decode($content, true);

        //get reply token and message if events is not null
        if (!is_null ($events)) {
            $replyToken = $events['events'][0]['replyToken'];
            $message = $events['events'][0]['message']['text'];
        }

        //condition to reply message
        if (preg_match("/ชื่ออะไร/", $message)) {
            $reply = "ชื่อปูเป้จ้าา";
        }
        else {
            $reply = "สวัสดีจ้า";
        }
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($reply);
		$response = $bot->replyMessage($replyToken,$textMessageBuilder);
        if ($response->isSucceeded()) {
            echo 'Succeeded!';
            return;
        }

        // Failed
        echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
    }



	public function debug(){
		// $jsonObj = '{
		// 	"access_token": "eyJhbGciOiJIUzI1NiJ9.HSzNcwKyofUMXHP0SxceCOxrvE6VOhuliFbA0uqisXNOEiMZkmVEm1a9vFVhrOaWxIgJvqwlLjOEahIO9sl1yoL53HkkPSvcpBT5b_9_0IMVPk4P90aQkshGVMxkiGFY1jX-D6Cxo30Cf0x0ddkyrFjTbwGalErVBtKOERbGDEo.1rTfO9_BTnqdR6AZdvxVVtLh0U-i8Tiz7_5Bd2UWIK4",
		// 	"token_type": "Bearer",
		// 	"refresh_token": "gUgae87g1ANHHu7sZRCW",
		// 	"expires_in": 2592000,
		// 	"scope": "openid",
		// 	"id_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FjY2Vzcy5saW5lLm1lIiwic3ViIjoiVWY0YmYyODBiYjM5NTEzMzI4YTNmYmVhNGRjZmRiZDdhIiwiYXVkIjoiMTY1NTcwNzMyNiIsImV4cCI6MTYxNDgzNzIxOSwiaWF0IjoxNjE0ODMzNjE5LCJhbXIiOlsibGluZXNzbyJdfQ.MfXZg-A_V4DeJ4ErdAHZ7QFmS0Lcc45rP2pRD3Fu2UQ"
		// }';

		// $obj = json_decode($jsonObj);
		// echo $obj->id_token;

		// echo $this->session->userdata('auth')['hrcode'];
		echo $this->global_data['user_id'];

	}




}
