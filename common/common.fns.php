<?php
//ѡ������ʹ��
function get_shops($db)
{
	$sql="SELECT `shopid`,`shopname`,`linktime` FROM `wm_shopinfo` order by  `shopid`";
	return $db->query($sql)->fetchall();
}
function get_city($db,$bid)
{
    $sql="SELECT `areaname` FROM `wm_areainfo` WHERE `id`=(SELECT `fid` FROM `wm_areainfo` WHERE `id`=(SELECT `fid` FROM `wm_areainfo` WHERE `id`=$bid))";
	return $db->query($sql)->fetchColumn();
}
function get_orders($db,$sid)
{
	$sql=$sid?"SELECT count(`shopid`) FROM `wm_orders` WHERE `shopid`=$sid":"SELECT count(`shopid`) FROM `wm_orders`";
	return $db->query($sql)->fetchColumn();
}
function get_orderadmin($db,$sid)
{
	$sql="SELECT `od` FROM `wm_admin_b` WHERE `shopid`=$sid";
	return $db->query($sql)->fetchColumn();
}
function update_od($db,$a,$sid)
{
	$sql="update `wm_admin_b` set `od`=$a where `shopid`=$sid";
	return $db->query($sql);
}
//��ȡ��Ա��ʷ����
function get_userhistroyorders($db,$e)
{
	$sql="SELECT * FROM `wm_orders` WHERE `user_id`='$e' order by orderdate desc";
	return $db->query($sql)->fetchall();
}
//��ȡ��Ա��ַ��Ϣ
function get_scadd($db,$e)
{
	$sql = "SELECT `address`,`telphone` FROM `wm_orders` WHERE `user_id`='$e' and `telphone`<>'' order by `orderdate` desc limit 1";	
	return $db->query($sql)->fetch();
}
// ��ȡ�Ͳ�ʱ��
function get_sctime()
{	
	$str1  = strtotime(date("H:i"));
    $str2 = strtotime(date( "H:i", mktime(date('H')+3,"00")));
	$j=strtotime(date("H:i",$str2));
	$i=0;
	$t=array();
	for($j;$j>$str1+30*60;$j-=60*15)
	{
		$t[$i]=date("H:i",$str2-60*15*$i);
		$i++;
	}
	sort($t);
	return $t;
}
//����¼״̬
function check_login($db,$e,$m)
{
     $sql="select password from wm_admin_c where email='".$e."'";
	 $pw = $db->query($sql)->fetchColumn();
	 if(md5($e.$pw)==$m)
	 {
	     return true;
	 }else
	 {
	     return false;
     }
}
function get_searchshops($db,$search,$bulid)
{
    $query="SELECT * FROM `wm_shopinfo` WHERE `shopid` IN (SELECT `shopid` FROM `wm_shoplinkbul` where areaid= $bulid) and `shoptype` = 1 and shopname like '%".$search."%'";
	return $db->query($query)->fetchall();
}
function get_searchdinners($db,$value,$bid)
{
$query = "select * from wm_dininfo where dinname like '%".$value."%' and `shopid` IN (SELECT `shopid` FROM `wm_shoplinkbul` WHERE areaid =$bid) order by shopid";
return $db->query($query)->fetchall();
}
//��ȡ��ǰд��¥�Ĳ͵�����
function getshopcounts($db,$bid)
{
    $query="SELECT count(`shopid`) FROM `wm_shopinfo` WHERE `shopid` IN (SELECT `shopid` FROM `wm_shoplinkbul` where areaid= $bid) and `shoptype` = 1";
    return  $db->query($query)->fetchColumn();
}
//��ȡ��ǰд��¥�Ĳ�Ʒ����
function getdinnercounts($db,$bid)
{
    $query="SELECT count(`dinid`) FROM `wm_dininfo` WHERE `shopid` IN (SELECT `shopid` FROM `wm_shoplinkbul` WHERE areaid =$bid)";
	return  $db->query($query)->fetchColumn();
}
//��ȡ��Ʒ����

function getcategory($db,$sid,$tag){//��shopid��ô˲͵�����в�Ʒ���� ��tag=1ʱ ��ѯdincategory���в�Ʒ���Ƶ��ֶ�
   $query = $tag?"select * from wm_dincategory  where shopid = '".$sid."' and dintype <> ''":"select * from wm_dincategory  where shopid = '".$sid."' ";
   return $db->query($query)->fetchall();
}

//��ȡ�͵��Ż���Ϣ
function get_yhinfo($db,$sid)
{
    if($sid)
	{
	    $sql="select `yhcontent`,`yhdate`,`post_time` from wm_shopinfo where shopid='".$sid."'";
		$row=$db->query($sql)->fetch();
	}else{
	    $sql="select `yhcontent`,`yhdate`,`post_time` from wm_shopinfo order by `linktime` desc";
		$row=$db->query($sql)->fetchall();
	}
	return $row;
}
//��̨�鿴�������
function get_orderitems($db,$shopid,$cx)
{
	$rqs = $cx['rqs'];
	$rqe = $cx['rqe'];
	$state = $cx['state'];
	if(empty($rqs)||empty($rqe)){
		$rqs = $rqe = date("Y-m-d");
	}
	$rqe = date('Y-m-d',strtotime($rqe)+86400);
	$where="'".$rqs."' < orderdate and orderdate < '".$rqe."'";
	if($shopid!=0){
		$where.="and shopid='".$shopid."'";
	}
	$query = "select * from wm_order_items where ".$where."order by orderdate desc";
	return $db->query($query)->fetchall();
}
function get_orders_info($db,$shopid,$cx,$from=0,$to =99999){
	$rqs = $cx['rqs'];
	$rqe = $cx['rqe'];
    $keyword = $cx['keyword'];
	$state = $cx['state'];
	$cxshopid = $cx['shopid'];
	if(empty($rqs)||empty($rqe)||empty($cx)){
		$rqs = $rqe = date("Y-m-d");
	}
	$rqe = date('Y-m-d',strtotime($rqe)+86400);
	$where="'".$rqs."' < `wm_orders`.orderdate and `wm_orders`.orderdate < '".$rqe."'";
	if($shopid!=0){
		$where.="and `wm_orders`.shopid='".$shopid."'";
	}else{
		if(!empty($cxshopid)&&$cxshopid!=0)
		{
			$where.="and `wm_orders`.shopid='".$cxshopid."'";
		}
	}
	if(isset($state)&&$state!=7){
		$where.= ($state==3? " and `wm_orders`.state in ('3','6')":" and `wm_orders`.state='".$state."'");
	}
	if(!empty($keyword)){
            $where.="and `wm_orders`.address like '%".$keyword."%'";
	}

	//$query = "SELECT `wm_orders`.*,`wm_order_items`.`dinname`,`wm_order_items`.`dintype`,`wm_order_items`.`dinnum`,`wm_order_items`.`dinprice`,`wm_order_items`.unitprice FROM `wm_orders` RIGHT OUTER JOIN `wm_order_items` ON `wm_orders`.`orderid` = `wm_order_items`.`orderid`  where ".$where."order by orderdate desc,shopid asc  limit $from,$to";
	$query = "SELECT a.*,b.`dinid`,b.`dinname`,b.`dinnum`,b.`dinprice`,b.`unitprice` FROM (SELECT * FROM `wm_orders` where ".$where."order by orderdate desc,shopid asc LIMIT $from , $to) AS a LEFT JOIN `wm_order_items` as b ON `a`.`orderid` 
	= b.`orderid`";
	
	$cquery = "SELECT count(`orderid`) FROM `wm_orders` where ".$where;
	$order['1']  = $db->query($query)->fetchall();
	$order['2'] = $db->query($cquery)->fetchColumn();
	$equery = "select sum(`total_price`) from `wm_orders` where ".$where;
	$order['3'] = $db->query($equery)->fetchColumn();
	$fquery = "SELECT sum(`wm_order_items`.`dinnum`) FROM `wm_orders` RIGHT OUTER JOIN `wm_order_items` ON `wm_orders`.`orderid` = `wm_order_items`.`orderid`  where ".$where;
	$order['4'] = $db->query($fquery)->fetchColumn();
	return $order;
}
//��̨�������
function get_order($db,$orderid)
{
// query database for a list of orderinfo   
   $query = "select * from wm_orders where  orderid='".$orderid."'";
   return $db->query($query)->fetchall();
}

function get_activeorder($db,$bulid)
{
	$sql="select * from `wm_orders` where shopid in(SELECT `shopid` FROM `wm_shoplinkbul` WHERE `areaid` =$bulid) and `telphone`<>'' and `shopid`<>1 order by orderdate desc limit 0,20";
	return $db->query($sql)->fetchall();
}
function get_remaimeishi($db,$bulid) {
   // query database for a list of categories
   $sql = "select * from wm_dininfo where `shopid` in(SELECT `shopid` FROM `wm_shoplinkbul` WHERE `areaid` =$bulid and `shopid`<>1) order by popnum desc limit 0,8";
   return $db->query($sql)->fetchall();
}

function get_tuijianms($db,$bulid) {
   // query database for a list of categories
   $sql = "select * from wm_dininfo where `shopid` in(SELECT `shopid` FROM `wm_shoplinkbul` WHERE `areaid` =$bulid) and beizhu=1 limit 0,8";
   return $db->query($sql)->fetchall();
}

function get_din_details($db,$dinid) {
  // query database for all details for a particular dinner
  $sql = "select * from wm_dininfo where dinid='".$dinid."'";
  return $db->query($sql)->fetch();
}
function get_dininfo($db,$s) {
  //��shopid ��ô˲͵�����в�Ʒ��Ϣ �Խ���ɾ���ͱ༭
   $query = $s?"select * from wm_dininfo where shopid='".$s."' order by dinimage asc,dintype asc":"select * from wm_dininfo order by shopid";
   return $db->query($query)->fetchall();
}


function get_user($db,$email) {
   // query database for the name for a shopid
   
   $query = "select nickname,jifen from wm_admin_c where email = '".$email."'";
   return $db->query($query)->fetch();
}
function get_area($db,$areaid)
{
   $dsql = "select areaname,fid from wm_areainfo where id='".$areaid."'";
   $dis = $db->query($dsql)->fetch();
   $area['b']=$dis['areaname'];
   
   $bsql = "select areaname from wm_areainfo where id='".$dis['fid']."'";
   $bul = $db->query($bsql)->fetch();
   
   $area['d']=$bul['areaname'];
   return $area;   
}
function get_dintypename($db,$sid,$tid) {
  //��shopid �� dintype(typeid) ����dincategory���  dintypename
   if($sid){
   $sql = "select `dintype` from wm_dincategory where id='$tid' and shopid='$sid'";
   }else{
   $sql = "select 'dintype' from wm_dincategory where id='$tid'";
   }
   return  $db->query($sql)->fetchColumn();
}

function get_admin($db,$sid) {
   $sql="select * from wm_admin_b where shopid='$sid'";
   return $db->query($sql)->fetch(); 
}

function get_shopname($db,$shopid)
{
return  $db->query("select `shopname` from wm_shopinfo where shopid = '$shopid'")->fetchColumn();
}
function get_shop_details($db,$shopid) {
   return  $db->query("select * from wm_shopinfo where shopid = '".$shopid."'")->fetch();
}

function sendSMS($uid,$pwd,$mobile,$content,$time='',$mid='')
{
	$http = 'http://http.c123.com/tx/';
	$data = array
		(
		'uid'=>$uid,					//�û��˺�
		'pwd'=>strtolower(md5($pwd)),	//MD5λ32����
		'mobile'=>$mobile,				//����
		'content'=>$content,			//����
		'time'=>$time,		//��ʱ����
		'mid'=>$mid						//����չ��
		);
	$re= postSMS($http,$data);			//POST��ʽ�ύ
	if( trim($re) == '100' )
	{
		return "���ͳɹ�!";
	}
	else 
	{
		return "����ʧ��! ״̬��".$re;
	}
}

function postSMS($url,$data='')
{
	$row = parse_url($url);
	$host = $row['host'];
	$port = $row['port'] ? $row['port']:80;
	$file = $row['path'];
	while (list($k,$v) = each($data)) 
	{
		$post .= rawurlencode($k)."=".rawurlencode($v)."&";	//תURL��׼��
	}
	$post = substr( $post , 0 , -1 );
	$len = strlen($post);
	$fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
	if (!$fp) {
		return "$errstr ($errno)\n";
	} else {
		$receive = '';
		$out = "POST $file HTTP/1.1\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Content-type: application/x-www-form-urlencoded\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Content-Length: $len\r\n\r\n";
		$out .= $post;		
		fwrite($fp, $out);
		while (!feof($fp)) {
			$receive .= fgets($fp, 128);
		}
		fclose($fp);
		$receive = explode("\r\n\r\n",$receive);
		unset($receive[0]);
		return implode("",$receive);
	}
}

?>