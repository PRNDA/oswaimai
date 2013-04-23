<?php
@session_start();
if (!$_SESSION['uname']){
	header("location:./index.php");exit;
}
include "../global.php";
include("pagination3.php");
$unex=explode('|',$_SESSION['uname']);

$param = $_SERVER['REQUEST_METHOD']=="POST"?$_POST:$_GET;
$rpp    = 20; // results per page
$page   = intval($param['page']);
if(!$param['tpages'])
{
	$from = $param['rqs'];
	$to   = $param['rqe'];
	if(empty($param['rqs'])||empty($param['rqe'])||empty($param)){
		$from = $to = date("Y-m-d");
	}
	$to = date('Y-m-d',strtotime($to)+86400);
	$sql  = "SELECT count( `orderid` ) FROM `wm_orders` where '$from'< orderdate and orderdate < '$to'";
	if($unex[0]!=0){
		$sql.=" and `wm_orders`.shopid='".$unex[0]."'";
	}else{
		if(!empty($param['shopid'])&&$param['shopid']!=0)
		{
			$sql.=" and `wm_orders`.shopid='".$param['shopid']."'";
		}
	}
	if(isset($param['state'])&&$param['state']!=7){
		$sql .= ($param['state']==3?" and `wm_orders`.state in ('3','6')":" and `wm_orders`.state='".$param['state']."'");
	}
	if(!empty($param['keyword'])){
            $sql.="and `wm_orders`.address like '%".$param['keyword']."%'";
	}
	$count = $db->query($sql)->fetchColumn();
	$tpages = ($count) ? ceil($count/$rpp) : 1;// total pages, last page number
}else{
	$tpages = $param['tpages'];
}

$adjacents  = intval($param['adjacents']);
if($page<=0)  $page  = 1;
if($adjacents<=0) $adjacents = 2;
$reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages . "&amp;adjacents=" . $adjacents."&amp;rqs=".$param['rqs']."&amp;rqe=".$param['rqe']."&amp;state=".$param['state']."&amp;shopid=".$param['shopid']."&amp;keyword=".$param['keyword'];
$pfrom = ($page-1)*$rpp;
$orders_info=get_orders_info($db,$unex[0],$param,$pfrom,$rpp);
$shops= get_shops($db);
?>
<html>
<head>
<link rel="stylesheet" href="./css/main.css" type="text/css" />
<link rel="stylesheet" href="./css/paginate.css" type="text/css" />

<script type="text/javascript" src="../jcart/jquery-1.5.1.js"></script>
<script src="./js/ui/jquery.ui.core.js"></script>
<script src="./js/ui/jquery.ui.widget.js"></script>
<script src="./js/ui/jquery.ui.datepicker.js"></script>
<link href="./js/ui/jquery.ui.all.css" rel="stylesheet"  />
<script>
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1",
			changeMonth: true,
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				$(this).datepicker( "option", "dateFormat", "yy-mm-dd");
			}
		});
	});
</script>
<script>
function checkorder() {
	$.ajax({type: "POST",dataType : "text",async : true,url: "checkorder.php",
	    success: function(res){
			if(res == 0){
				//$('#msg').show();
				window.location.reload();
			}
		},
		error : function(res) {}
	});
}
function configorder(orderid,tag,state){
	$.ajax({type: "POST",dataType : "text",url: "configorder.php",data: {"orderid" : orderid,"tag":tag,"state":state},success: function(res){
			if(res == 3){
				$("#"+orderid).html("OK");
			}else if(res==4){
				$("#"+orderid).html("NO");
			}
	},
	error : function(res) {}
	});
}
function msgclose(){
	$('#msg').hide();
}
setInterval("checkorder()",20000);
</script>
</head>
<body>
<form name="form1" method="post" action="" style="float:left; width:100%">
<table width="100%" border=0 align=center cellpadding=3 cellspacing=1 bordercolor="#799AE1">
<tbody>
<tr>
<th align=center colspan=14 style="height: 23px">���߶�������</th>
</tr>
<tr bgcolor="#DEE5FA">
<td colspan="14" class=txlrow>
<div>
<div style="float:left">
����ʱ��:
<input type="text" name="rqs" id="from" size="12" value="<?php echo $param['rqs']?>" onKeyUp="this.value=''"/>��
<input type="text" name="rqe" id="to" size="12" value="<?php echo $param['rqe']?>" onKeyUp="this.value=''"/>
<select name="state">
<?php if(isset($param['state'])){?>
<option value="7" <?php if($param['state']==7){echo 'selected';}?>>ѡ��״̬</option>
<option value="0" <?php if($param['state']==0){echo 'selected';}?>>δ��ӡ</option>
<option value="1" <?php if($param['state']==1){echo 'selected';}?>>�Ѵ�ӡ</option>
<option value="2" <?php if($param['state']==2){echo 'selected';}?>>TEL</option>
<option value="3" <?php if($param['state']==3){echo 'selected';}?>>�ɽ�</option>
<option value="4" <?php if($param['state']==4){echo 'selected';}?>>δ�ɽ�</option>
<option value="5" <?php if($param['state']==5){echo 'selected';}?>>��ӡδ�ɽ�</option>
<option value="6" <?php if($param['state']==6){echo 'selected';}?>>������</option>

<?php }else{?>
<option value="7" selected="true">ѡ��״̬</option>
<option value="0">δ��ӡ</option>
<option value="1">�Ѵ�ӡ</option>
<option value="2">TEL</option>
<option value="3">�ɽ�</option>
<option value="4">δ�ɽ�</option>
<option value="5">��ӡδ�ɽ�</option>
<option value="6">������</option>

<?php }?>
</select>
<?php if($unex[0]==0){?>
<select name="shopid"><option value="0">ѡ������</option>
<?php foreach($shops as $row){?>
<option value="<?php echo $row['shopid'];?>" <?php if($param['shopid']==$row['shopid']){echo "selected";}?>><?php echo $row['shopname'];?></option>
<?php }?>
</select>
<?php }?>
�ؼ���:<input type="text" name="keyword" value="<?php echo $param['keyword'];?>" />
<input type="submit" value="��ѯ"/>
</div>
</div>
</td>
</tr>
<tr bgcolor="#DEE5FA">
<td colspan="14" class=txlrow>
<ul style="float:left; margin:0px; list-style:none; padding:4px; font-weight:bold; color:#666;">
<li style="float:left; margin-right:20px">
��ǰ����������<?php echo $orders_info['2'];?>��
</li>
<li style="float:left; margin-right:20px">
��ǰ�����ܶ<?php echo $orders_info['3'];?>Ԫ
</li>
<li style="float:left; margin-right:20px">
��ǰ��Ʒ������<?php echo $orders_info['4'];?>��
</li>
<li style="float:left; margin-right:20px">
<a href="./download.php?from=<?php echo $param['rqs'];?>&to=<?php echo $param['rqe'];?>&state=<?php echo $param['state'];?>&shopid=<?php echo $param['shopid'];?>"><font color="#0000FF"><b>������ǰ����</b></font></a>
</li>
<li style="float:left; margin-right:20px">
<?php echo paginate_three($reload, $page, $tpages, $adjacents);?>
</li>
</ul>
</td>
</tr>
<tr align="left" bgcolor="#799AE1">
<td width="5%" class=txlHeaderBackgroundAlternate>������</td>
<td width="5%"  class=txlHeaderBackgroundAlternate>�û���</td>
<td width="6%"  class=txlHeaderBackgroundAlternate>�µ�ʱ��</td>
<?php if($unex[0]==0){?>
<td width="10%" class=txlHeaderBackgroundAlternate>����</td>
<?php }?>
<td width="10%"  class=txlHeaderBackgroundAlternate>��Ʒ��</td>
<td width="3%"  class=txlHeaderBackgroundAlternate>����</td>
<td width="4%" class=txlHeaderBackgroundAlternate>����</td>
<td width="4%" class=txlHeaderBackgroundAlternate>�ܼ�</td>
<td width="6%" class=txlHeaderBackgroundAlternate>�Ͳ�ʱ��</td>
<td width="10%"  class=txlHeaderBackgroundAlternate>��ע</td>
<!--<td align="center" class=txlHeaderBackgroundAlternate>��Ʒ����</td>-->
<td width="6%"  class=txlHeaderBackgroundAlternate>�绰</td>
<td width="15%"  class=txlHeaderBackgroundAlternate>��ַ</td>
<td width="5%"  class=txlHeaderBackgroundAlternate>״̬</td>
<td width="11%"  class=txlHeaderBackgroundAlternate>�ɽ���</td>
</tr>
<?php
if($orders_info['1']){
	foreach ($orders_info['1'] as $i=>$row) 
	{
?>
<tr align="left">
<?php if($row['orderid']!=$mark){?>
<td style="border-top:1px solid #666;line-height:30px"><?php echo $row['orderid']?></td>
<td style="border-top:1px solid #666;line-height:30px"><?php $user = get_user($db,$row['user_id']);echo $user['nickname']?$user['nickname']:"�ο�";?></td>
<td style="border-top:1px solid #666;line-height:30px"><?php echo substr($row['orderdate'],5,20)?></td>
<?php if($unex[0]==0){?>
<td style="border-top:1px solid #666;line-height:30px"><?php echo get_shopname($db,$row['shopid']);?></td>
<?php }}else{?>
<?php if($unex[0]==0){?>
<td colspan="4"></td>
<?php }else{?>
<td colspan="3"></td>
<?php }}?>

<td style="line-height:30px;<?php if($row['orderid']!=$mark){?>border-top:1px solid #666<?php }?>"><?php echo $row['dinname'];?></td>
<td style="line-height:30px;<?php if($row['orderid']!=$mark){?>border-top:1px solid #666<?php }?>"><?php echo $row['dinnum'];?></td>
<td style="line-height:30px;<?php if($row['orderid']!=$mark){?>border-top:1px solid #666<?php }?>"><?php echo $row['dinprice'];?></td>

<?php if($row['orderid']!=$mark){?>
<td style="border-top:1px solid #666;line-height:30px">��<?php echo $row['total_price'];?></td>
<td style="border-top:1px solid #666;line-height:30px"><?php echo $row['sctime'];?></td>
<td style="border-top:1px solid #666;line-height:30px"><?php echo $row['beizhu']?$row['beizhu']:"&nbsp;";?></td>
<td style="border-top:1px solid #666;line-height:30px"><?php echo $row['telphone'];?></td>
<td style="border-top:1px solid #666;line-height:30px"><?php echo $row['address']?></td>
<td style="border-top:1px solid #666;line-height:30px">
<?php 
switch($row['state'])
{
	case 0:
	echo "<font color='#FF9933'>δ��ӡ</font>";break;
	case 1:
	echo "<font color='#00CC33'>�Ѵ�ӡ</font>";break;
	case 2:
	echo "<font color='#999966'>TEL</font>";break;
	case 3:
	echo "<font color='green'>�ɽ�</font>";break;
	case 4:
	echo "<font color='#999'>δ�ɽ�</font>";break;
	case 5:
	echo "<font color='#FF0099'>��ӡδ�ɽ�</font>";break;
	case 6:
	echo "<font color='#FF0099'>������</font>";break;
}
?>
</td>
<td style="border-top:1px solid #666" id="<?php echo $row['orderid'];?>">
<?php 
if($row['state']==0||$row['state']==1){
	echo "<a href='javascript:configorder(".$row['orderid'].",3,".$row['state'].")'>��</a>&nbsp;<a href='javascript:configorder(".$row['orderid'].",4,".$row['state'].")'>��</a>";
}else{
	echo "&nbsp;";	
}
?>
</td>
<?php }else{?>
<td colspan="7"></td>
<?php }?>
</tr>
<?php
    $mark=$row['orderid'];
	}
}
?>
    </tbody>
  </table>
</form>
</BODY>
</HTML>
