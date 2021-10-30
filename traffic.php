<?php
include "lib/init.php";
include "config.php";
include "lib/login.php";
exec("curl -s https://".$hostname."/api/v1/admin/stat/getServerLastRank -b logined.cookie",$return);
$json=json_decode($return[0],true);
$text=$name."今天的流量统计情况\n";
if($show_poweredby){
    $text.="Powered By MengXin";
}
for($i=0;$i<count($json['data']);$i++){
    $text.="\n节点名称：".$json["data"][$i]["server_name"].
           "\n使用流量：".round($json["data"][$i]["total"], 7)." GB\n";
}
send(make($chat_id,$text));
?>
