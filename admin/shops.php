<link rel="stylesheet" href="./css/main.css" type="text/css" />
<script type="text/javascript" src="../jcart/jquery-1.5.1.js"></script>
<?php
@session_start();
include "../global.php";
if(!$_SESSION['uname']){
	header("location:./index.php");exit();
}

$del = $_GET['did'];
if(!empty($del))
{
	if($db->query("delete from `wm_shopinfo` where `shopid`='$del'")&&$db->query("delete from `wm_admin_b` where `shopid`='$del'")&&$db->query("delete from `wm_dincategory` where `shopid`='$del'")&&$db->query("delete from `wm_dininfo` where `shopid`='$del'")&&$db->query("delete from `wm_grade` where `shopid`='$del'")&&$db->query("delete from `wm_orders` where `shopid`='$del'")&&$db->query("delete from `wm_order_items` where `shopid`='$del'")&&$db->query("delete from `wm_shoplinkbul` where `shopid`='$del'"))
	{
		echo "<font color='#FF0000'>ɾ���ɹ�</font>";	
	}
}
$sql="SELECT * FROM `wm_shopinfo`";
$shops = $db->query($sql)->fetchall();
?>
<table  width="100%" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=9 style="height: 23px">�͵���Ϣ</th>
      </tr>
	   <tr bgcolor="#DEE5FA">
        <td align="center" colspan="9" align="center" class=txlrow><font color="#FF0000"><strong>&nbsp;</strong></font></td>
      </tr>
      <tr bgcolor="#799AE1">
        <td width="8%" class=txlHeaderBackgroundAlternate>״̬</td>
        <td width="8%" class=txlHeaderBackgroundAlternate>�͵�����</td>
        <td width="12%" class=txlHeaderBackgroundAlternate>Ӫҵ״̬</td>
        <td width="18%" class=txlHeaderBackgroundAlternate>�͵��ַ</td>
        <td width="8%" class=txlHeaderBackgroundAlternate>��ӡ�����</td>
		<td width="8%" class=txlHeaderBackgroundAlternate>��ϵ��</td>
        <td width="8%" class=txlHeaderBackgroundAlternate>��ϵ�绰</td>
        <td width="20%" class=txlHeaderBackgroundAlternate>Ӫҵʱ��</td>
        <td width="10%" class=txlHeaderBackgroundAlternate>����</td>
      </tr>
      <?php
	  foreach($shops as $mem)
	  {?>
      <tr>
      <td class=txlrow id="shop<?php echo $mem['shopid'];?>">
      <?php if($mem['shoptype']==1){?>
      <a href="javascript:changeShoptype(2,<?php echo $mem['shopid'];?>)">����</a>
      <?php }elseif($mem['shoptype']==2){?>
      <a href="javascript:changeShoptype(1,<?php echo $mem['shopid'];?>)">ȡ������</a>
      <?php }?>
      </td>
      <td class=txlrow><?php echo $mem['shopname'];?></td>
      <td class=txlrow><?php if($mem['online']==0){echo "����";}elseif($mem['online']==1){echo "����Ӫҵʱ��";}elseif($mem['online']==2){echo "���ݶ�����";}elseif($mem['online']==3){echo "���е绰Ԥ��";}?></td>
      <td class=txlrow><?php echo $mem['shopadd'];?></td>
      <td class=txlrow><?php echo $mem['printid'];?></td>
      <td class=txlrow><?php echo $mem['contact'];?></td>
      <td class=txlrow><?php echo $mem['shoptel'];?></td>
      <td class=txlrow><?php echo "AM:".substr($mem['swstart'],0,5)."-".substr($mem['swend'],0,5)." PM:".substr($mem['xwstart'],0,5)."-".substr($mem['xwend'],0,5);?></td>
      <td class=txlrow><a href="addshop.php?shopid=<?php echo $mem['shopid']?>">�༭</a>&nbsp;<a href="shops.php?did=<?php echo $mem['shopid']?>" onclick="return delconfig()">ɾ��</a></td>
      </tr>  
	  <?php
      }
	  ?>
</tbody>
</table>
<script language="javascript" type="text/javascript">
function delconfig()
{
   if(confirm("��ȷ��ɾ�����⽫��ɾ�����ڴ˵������������Ϣ")){
      return true;
   }else
   {
      return false;
   }
}
function changeShoptype(tag,shopid)
{
	$.ajax({type: "POST",dataType : "text",async : true,url: "changeShoptype.php",data:{"tag":tag,"shopid":shopid},
	    success: function(res){
			if(tag==1)
			{
				$('#shop'+shopid).html("<a href='javascript:changeShoptype(2,"+shopid+")'>����</a>");
			}else if(tag==2)
			{
				$('#shop'+shopid).html("<a href='javascript:changeShoptype(1,"+shopid+")'>ȡ������</a>");	
			}
		},
		error : function(res) {}
	});
}
</script>