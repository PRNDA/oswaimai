<?php
@session_start();
header('Content-Type:text/html;charset=gb2312');
include "../global.php";
$unex=explode('|',$_SESSION['uname']);
$sid=$unex[0];
//�鿴3��������ľ��δ���ܵĶ���
if(0)
{
	$sql="SELECT * FROM `wm_orders` WHERE UNIX_TIMESTAMP( `orderdate` ) < ( UNIX_TIMESTAMP( now( ) ) -150 ) AND `state` = '0'";
	$unorders = $db->query($sql)->fetchall();
	if(!empty($unorders)){
		foreach($unorders as $row){
			$msg = "��Ǹ�����Ķ���:".$row['orderid'].",�̼�δ�ܽ��ܣ�ϵͳ���Զ��رգ�������ѡ��!�Ҷ���������welwm.com��";
                        $telphone=$row['telphone'];			
                        sendSMS($uid,$pwd,$telphone,$msg);
			$updatesql="update `wm_orders` set `state`='4' WHERE `orderid`='".$row['orderid']."'";
			$db->query($updatesql);
		}
	}
}
$b=get_orders($db,$sid);
$a=get_orderadmin($db,$sid);
if($a!=$b){
	echo "0";
	update_od($db,$b,$sid);
}else{
	echo "1";
}
?>