<?php
session_start();
header('Content-Type:text/html;charset=gb2312');
if(!isset($_SESSION['email'])){
	echo "2";//������½��	
}else{
	include "./global.php";
	$tag = $_POST['tag'];
	$shopid = $_POST['shopid'];
	
	if($tag==1){
		//�ղ�
		$time = mktime();
		$sql="insert into `wm_saveshop` values('','$_SESSION[email]','$shopid','$time')";
		if($db->query($sql)){
			echo "1";
		}else{
			echo "2";
		}
		
	}elseif($tag==0){
		//ɾ��
		$delsql="delete from `wm_saveshop` where `username`='$_SESSION[email]' and `shopid`='$shopid'";
		if($db->query($delsql))
		{
			echo "3";	
		}else
		{
			echo "4";
		}
	}
}
?>
