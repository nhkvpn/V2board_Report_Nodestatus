<?php
include "lib/init.php";
include "config.php";
include "lib/login.php";
exec("curl https://".$hostname."/api/v1/admin/stat/getServerLastRank -b logined.cookie",$return);
$json=json_decode($return[0],true);
$text=$name."今天的流量统计情况\n";
if($show_poweredby){
    $text.="Powered By MengXin";
}
for($i=0;$i<count($json)-1;$i++){
  $text.="\n".$json["data"][$i]["server_name"]." 今天跑了 ".$json["data"][$i]["total"]."流量";
}
send(make($chat_id,$text));
?>
