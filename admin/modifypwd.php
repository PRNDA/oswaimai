<?php
@session_start();
if(!$_SESSION['uname'])
{
	header("location:./index.php");exit();
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$unex=explode('|',$_SESSION['uname']);
	$sid=$unex[0];
	include "../global.php";
	extract($_POST);
	$res = $db->query("select * from wm_admin_b where shopid='".$sid."'and password='".sha1($oldpwd)."'")->fetch();
	if($res){
		if(strlen($newpwd)<6)
		{
			echo "<script>alert('���볤�Ȳ�С��6λ')</script>";	
		}elseif($newpwd!=$renewpwd){
			echo "<script>alert('�����������벻��ȷ')</script>";	
		}else
		{
			$r=$db->query("update wm_admin_b set password='".sha1($newpwd)."' where shopid='".$sid."'");
			if($r){
				echo "<script>alert('�޸ĳɹ�')</script>";	
			}else{
				echo "<script>alert('�޸�ʧ��')</script>";	
			}
		}
	}else{ 
	    echo "<script>alert('�����������')</script>";
	}
}
?>
<html>
<head>
<link rel="stylesheet" href="./css/main.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
  <form action="" method="post">
  <table  width="100%" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=4 style="height: 23px">�޸�����</th>
      </tr>
      <tr bgcolor="#DEE5FA">
        <td colspan="4" align="center" class=txlrow><font color="#FF0000"><strong>&nbsp;</strong></font></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="20%"  align="center" class=txlHeaderBackgroundAlternate>ԭʼ����</td>
        <td width="20%"  align="center" class=txlHeaderBackgroundAlternate>������</td>
        <td width="20%"  align="center" class=txlHeaderBackgroundAlternate>ȷ������</td>
        <td width="20%"  align="center" class=txlHeaderBackgroundAlternate>����</td>
      </tr>
      <tr>
      <td align=center class=txlrow><input type="password" name="oldpwd" id="oldpwd"  /></td>
      <td align=center class=txlrow><input type="password" name="newpwd" id="newpwd"  /></td>
      <td align=center class=txlrow><input type="password" name="renewpwd" id="renewpwd"  /></td>
      <td align=center class=txlrow><input type="submit" value="ȷ���޸�" /></td>
      </tr>
</tbody>
</table>
</form>
</body>
</html>