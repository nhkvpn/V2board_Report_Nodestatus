<?php
if($argv[1]=="used"){
  include "used.php";
} else
if($argv[1]=="traffic"){
  include "traffic.php";
} else 
if($argv[1]=="help"){
	include "help.php";
}else
{
  echo "调用方式: php ".dirname(__FILE__)."\index.php [option]\noption可以为used等\n要查看详细信息请执行 php ".dirname(__FILE__)."\index.php help来获取更多信息";
}
?>
