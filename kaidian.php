<?php
include_once('./global.php');
include "./header.php";
$smarty->display('aboutleft.tpl');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);
	if(empty($realname) ||empty($mobilephone)||empty($shopname))
	{
	echo "��������";exit;
	}
	echo "<div style='width:750px; min-height:400px; float:right'>";
	if($mark==$_SESSION['mark'])
	{
	    $sql="INSERT INTO `wm_shopinfo`(`contact`,`shoptel`,`shop_deskphone`,`shop_qq`,`shopname` ,`shopadd` ,`shopintro` ,`shoptype` )VALUES ('$realname','$mobilephone','$deskphone','$qq','$shopname','$shopaddress','$shopinfo',0)";
		$res=$db->query($sql);
		echo $res->rowCount()?"����ɹ�,���ǽ�����������ϵ��":"����ʧ��";
		unset($_SESSION['mark']);
	}else
	{
	echo "�벻Ҫ�ظ�ˢ��";
	}
	echo "</div>";
}
else{
$_SESSION['mark']=time();
$smarty->assign('mark',$_SESSION['mark']);
$smarty->display('kaidian.tpl');
}
include "./footer.php";
?>