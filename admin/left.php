<?php
@session_start();
include "../global.php";
if (empty($_SESSION['uname'])){
	header("location:login.php");exit();
}
$unex     = explode('|',$_SESSION['uname']);
$sid      = $unex[0];
$shopinfo = get_shop_details($db,$sid);
$shoptype = $shopinfo['shoptype'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
<link rel="stylesheet" href="./css/main.css" type="text/css" />
</head>
<body>
<table cellpadding="10px">
<tr><td><font style="color:#FF6600; font-weight:bold";><?php echo get_shopname($db,$sid);?></font></td></tr>
<tr><td>��ӭ����<?php echo $unex[1];?>&nbsp;<A href="loginout.php" target=_parent>�˳�</A></td></tr>
<tr><td><font style="color:#FF6600; font-weight:bold";>��������</font></td></tr> 
<tr><td><a href="list.php" target=mainFrame>������ѯ</a></td></tr>
<?php if($sid==0){?>
<tr><td><a href="member.php" target=mainFrame>��Ա����</a></td></tr>
<tr><td><a href="dinmanage.php" target=mainFrame>��Ʒ����</a></td></tr>
<tr><td><a href="area.php" target=mainFrame>�������</a></td></tr>
<tr><td><a href="shops.php" target=mainFrame>�͵����</a></td></tr>
<!--<tr><td><a href="dintype.php" target=mainFrame>�͵����</a></td></tr>-->
<tr><td><a href="addshop.php" target=mainFrame>�͵����</a></td></tr>
<tr><td><a href="printer.php" target=mainFrame>��ӡ������</a></td></tr>
<tr><td><font style="color:#FF6600; font-weight:bold";>��������</font></td></tr>
<?php }elseif($sid!=0){?>
<tr><td><A href="shopinfo.php" target=mainFrame>������Ϣ</A></td></tr>
<tr><td><A href="yhinfo.php" target=mainFrame>�Ż���Ϣ</A></td></tr>
<tr><td><A href="range.php" target=mainFrame>�Ͳͷ�Χ</A></td></tr>
<?php }?>
<tr><td><a href="modifypwd.php" target="mainFrame">�޸�����</a></td></tr>
<?php if($shoptype==1){?>
<tr><td><font style="color:#FF6600; font-weight:bold";>��Ʒ����</font></td></tr>
<tr><td><a href="addCategory.php" target="mainFrame">��Ʒ���</a></td></tr>
<tr><td><a href="adddin.php" target="mainFrame">��Ʒ���</td></tr>
<tr><td><a href="dinnerShow.php" target="mainFrame">��Ʒ���</a></td></tr>
<?php }elseif($shoptype==2){?>
<tr><td><font style="color:#FF6600; font-weight:bold";>��Ʒ����</font></td></tr>
<tr><td><a href="addCategory.php" target="mainFrame">��Ʒ���</a></td></tr>
<tr><td><a href="adddin.php" target="mainFrame">��Ʒ���</td></tr>
<tr><td><a href="dinnerShow.php" target="mainFrame">��Ʒ���</a></td></tr>
<?php }?>
</body>
</html>