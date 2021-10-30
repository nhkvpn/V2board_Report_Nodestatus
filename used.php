<?php
include "config.php";
include "lib/init.php";
include "lib/login.php";
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
		    if($json['data'][$i]['availale_status']==null){
                $text.="\n".$json['data'][$i]['name']." Shit,这台机器炸了";
			    } else {
		   	 $text.="\n".$json['data'][$i]['name']." 在线人数:0";
		    }
            } else {
                $text.="\n".$json['data'][$i]['name']." 在线人数:".$json['data'][$i]['online'];
            }
        } else {
		
            if($json['data'][$json['data'][$i]['parent_id']]['online']==null){
		    if($json['data'][$i]['availale_status']==null){
                $text.="\n".$json['data'][$i]['name']." Shit,这台机器炸了";
			    } else {
		   	 $text.="\n".$json['data'][$i]['name']." 在线人数:0";
		    }
            } else {
                $text.="\n".$json['data'][$i]['name']." 在线人数:".strval($json['data'][strval($json['data'][$i]['parent_id'])]['online']);
            }
        }
    }
}
send(make($chat_id,$text));
?>
