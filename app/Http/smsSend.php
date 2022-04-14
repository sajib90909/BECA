<?php

class smsSend
{
    public static function send_sms($to,$msg) {
        $url = env('SMS_API_URL', '');
        $data = [
            "api_key" => env('SMS_API_KEY', ''),
            "type" => "text",
            "contacts" => $to,
            "senderid" => "8801847169884",
            "msg" => $msg,
          ];
        $response = 'not_approve';
        if(env('SMS_PERMISSION') == 1){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
        }

          return $response;
    }
}
