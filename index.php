<?php
function send($data) {
    global $token;
    $data_string = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL,"https://api.telegram.org/bot".$token."/sendMessage");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Content-Length: ' . strlen($data_string))
    );
    ob_start();
    curl_exec($ch);
    $return_content = ob_get_contents();
    ob_end_clean();
    $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $return_content = json_decode($return_content,true);
    return $return_content;
}
include "config.php";
exec("curl https://".$hostname."/api/v1/passport/auth/login -X POST -d 'email=".$admin_username."&password=".$admin_password."' -c logined.cookie",$a);
exec("curl https://".$hostname."/api/v1/admin/server/manage/getNodes -b logined.cookie",$return);
$json=json_decode($return[0],true);
$text=$name."节点使用情况\n";
if($show_poweredby){
    $text.="Powered By MengXin";
}
for($i=0;$i<count($json['data'])-1;$i++){
    if($json['data'][$i]['show']!=null){
        if($json['data'][$i]['parent_id']==null){
            if($json['data'][$i]['online']==null){
                $text.="\n".$json['data'][$i]['name']." 在线人数:0";
            } else {
                $text.="\n".$json['data'][$i]['name']." 在线人数:".$json['data'][$i]['online'];
            }
        } else {
            if($json['data'][$json['data'][$i]['parent_id']]['online']==null){
                $text.="\n".$json['data'][$i]['name']." 在线人数:0";
            } else {
                $text.="\n".$json['data'][$i]['name']." 在线人数:".strval($json['data'][strval($json['data'][$i]['parent_id'])]['online']);
            }
        }
    }
}
    $data = array(
                "chat_id" => $chat_id,
                "text" => $text,
                "disable_web_page_preview" => true,
                "reply_to_message_id" => $messageid
            );
	send($data);
?>
