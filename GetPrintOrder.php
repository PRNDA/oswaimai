<?php
ini_set('date.timezone','PRC');
include('./global.php');
$shopid = $_GET['id'];
$page   = $_GET['p'];
function stradd($b,$str)
{
   $length=strlen($str);
   if($length>=$b)
   {
       return $str;
   }else
   {
       $a=$b-$length;
	   for($i=0;$i<$a;$i++)
	   {
	       $str.=" ";
	   }
	   return $str;
   }
}
if(!empty($shopid))
{
    if(!empty($page) && is_numeric($page)){
	    $updatesql = "update `wm_shopinfo` set `linktime`='".strtotime(date('YmdHis'))."' WHERE `shopid`='".$shopid."'";
		$db->query($updatesql);
		$ordersql  = "SELECT * FROM `wm_orders` WHERE `shopid` ='".$shopid."' AND `state` = '0' order by orderdate limit 0,1";
		$order=$db->query($ordersql)->fetch();
		if(empty($order))
		{
		    if(strtotime(date("H:i")) >= strtotime(date( "H:i", mktime("21","00"))))
			{
				//$print="<sleep>10800</sleep>";
			}elseif(strtotime(date("H:i")) <= strtotime(date( "H:i", mktime("7","00")))){
				$print="<sleep>3600</sleep>";
			}else{
				$print="<none></none>";	
			}
		}
		else
		{
		    $print.="<time>";
			$print.=$order['orderdate'];
			$print.="</time>";
					
			$print.="\r\n<orderid>";
			$print.=$order['orderid'];
			$print.="</orderid>";
			$print.="<OdCont>";
			$print.="\r\n�����绰��".$order['telphone'];
			if($order['otherphone']!=NULL)
			{
				$print.="\r\n���õ绰��".$order['otherphone'];		
			}
			$print.="\r\n--------------------------------\r\n";
			//   $print=$print."�����ǲ˵�....";
			$print.="����            ����     ����\r\n";
			$sql="SELECT * FROM `wm_order_items` WHERE `orderid`='".$order['orderid']."' and `shopid`='".$shopid."'";
			$order_items=$db->query($sql)->fetchAll();
			foreach($order_items as $item)
			{
			    $total_items +=$item['dinnum'];
			    $print.=stradd(16,$item['dinname']).stradd(9,$item['dinnum']).$item['unitprice']."\r\n";
			}
			$print.="��Ʒ������".$total_items."��\r\n";
			$print.="��Ʒ�ܼۣ�".$order['total_price']."Ԫ\r\n";
			$print.="����������".$order['beizhu']."\r\n\r\n";
			$print.="����ʱ�䣺".$order['sctime']."\r\n";
			$print.="���͵�ַ��".$order['address']."\r\n";
			$print.="\r\n--------------------------------\r\n";
			$print.="</OdCont>";
			$print.="<end></end>";
		}	
	}
	else
	{
	
	}
}
else
{
    $print="<error></error>";
}
echo $print;
?>