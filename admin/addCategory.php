<?php
@session_start();
include "../global.php";
if (empty($_SESSION['uname'])){
	header("location:./index.php");exit();
}
$unex=explode('|',$_SESSION['uname']);
$sid=$unex[0];
if($_SERVER['REQUEST_METHOD']=='POST')
{
	if(empty($_POST['tid'])){
		$isql="insert into `wm_dincategory`(`shopid`,`dintype`) values('$sid','$_POST[typename]')";
		if($db->query($isql)){
			echo "<font color='#FF0000'>��ӳɹ�</font>";
		}
	}else{
		$usql="update `wm_dincategory` set `dintype`='$_POST[typename]' where `id`='$_POST[tid]' and `shopid`='$sid'";
		if($db->query($usql)){
			echo "<font color='#FF0000'>��ӳɹ�</font>";
		}else{
			echo "<font color='red'>���ʧ��</font>";
		}
	}
}
if(isset($_GET['did']))
{
	$ssql ="SELECT `dinid` FROM `wm_dininfo` where `shopid`='$sid' and `dintype`='$_GET[did]' limit 0,1";
	$ts = $db->query($ssql)->fetch();
	if(empty($ts)){
	    $dsql="delete from `wm_dincategory` where `shopid`='$sid' and `id`='$_GET[did]'";
		if($db->query($dsql)){
			echo "<font color='red'>ɾ���ɹ�</font>";
		}else{
			echo "<font color='red'>ɾ��ʧ��</font>";
		}
	}else{
		echo "<font color='red'>�������ѹ������޷�����ɾ��</font>";
	}
}
$arr=getcategory($db,$sid,0);
?>
<html>
<head>
<link rel="stylesheet" href="./css/main.css" type="text/css" />
</head>
<body>
  <table  width="30%" border=0 cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=4 style="height: 23px">��Ʒ���|���</th>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="35%"  align="center" class=txlHeaderBackgroundAlternate>�������</td>
        <td colspan="2"  align="center" class=txlHeaderBackgroundAlternate>����</td>
      </tr>  
	  <?php if($arr){foreach($arr as $row){
		  if($_GET['id']==$row['id']){
			  echo "<tr><form style='padding:0px; margin:0px;' action='addCategory.php' method='post'>";
			  echo "<td align=center class=txlrow><input type='hidden' name='tid' value='".$row['id']."'><input type='text' name='typename' id='typename' value='".$row['dintype']."'/></td>";
			  echo "<td align=center class=txlrow><input type='submit' value='ȷ���޸�' /></td>";
			  echo "</form></tr>";
		  }else{
			  echo "<tr>";
			  echo "<td align=center class=txlrow>".$row['dintype']."</td>";
			  echo "<td align=center class=txlrow>"."<a href=?id=".$row['id'].">�༭</a>&nbsp;<a href='?did=".$row['id']."'>ɾ��</a></td>";
		  }}}?>
      <tr>
      <form style="padding:0px; margin:0px;" action="addCategory.php" method="post">
      <td align=center class=txlrow><input type="text" name="typename" id="typename" /></td>
      <td align=center class=txlrow><input type="submit" value="���" /></td>
      </form>
      </tr>
	</tbody>
  </table>

</body>
</html>