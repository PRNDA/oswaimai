<?php
@session_start();
include "../global.php";

if (empty($_SESSION['uname'])){
	header("location:login.php");exit();
}
$unex=explode('|',$_SESSION['uname']);
$sid=$unex[0];

$dinid=empty($_GET['dinid'])?$_POST['dinid']:$_GET['dinid'];

if($_SERVER['REQUEST_METHOD']=='POST')
{        
	if($_POST['dinid']){
	   if($_POST['myFilePath'])
	   {
		   $query="update wm_dininfo set dinname='$_POST[name]', dintype='$_POST[type]',dinprice='$_POST[price]', dinimage='$_POST[myFilePath]',isellout='$_POST[isell]', beizhu = '$_POST[intro]' where dinid='$_POST[dinid]'";}
	   else
	   {
		$query="update wm_dininfo set dinname='$_POST[name]', dintype='$_POST[type]',dinprice='$_POST[price]',isellout='$_POST[isell]' , beizhu = '$_POST[intro]' where dinid='$_POST[dinid]'";}
	}else
	{
		$query = "insert into wm_dininfo values('','$sid','$_POST[name]','$_POST[type]','$_POST[price]','$_POST[myFilePath]','1','','$_POST[intro]')";
	}
	$result = $db->query($query);		
	if($result){
		echo "<IMG height=13 src=\"images/tick.png\" width=16 align=absMiddle />����ɹ�";}else{echo "<IMG height=13 src=\"images/cross.png\" width=16 align=absMiddle />����ʧ��";
	}
}
$array   = get_din_details($db,$dinid);
$typearr = getcategory($db,$sid,1);
?>
<html>
<head>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/default.css" rel="stylesheet" type="text/css" />
<link href="css/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jcart/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#fileInput2").uploadify({
		'uploader' : 'js/uploadify.swf',//����Ҫ��flash�ļ�
		'cancelImg': 'js/cancel.png',//����ȡ���ϴ���ͼƬ
		'script'   : 'js/uploadify.php',//ʵ���ϴ��ĳ���
		'folder'   : 'uploads',//����˵��ϴ�Ŀ¼
		//'auto': true,//�Զ��ϴ�
		//'multi': true,//�Ƿ���ļ��ϴ�
		//'checkScript': 'js/check.php',//��֤ ������˵�
		'displayData': 'speed',//����������ʾ��ʽ
		'fileDesc' : 'Image(*.jpg;*.gif;*.png)',//�Ի�����ļ���������
		'fileExt'  : '*.jpg;*.jpeg;*.gif;*.png',//���ϴ����ļ�����
		//'sizeLimit': 999999 ,//�����ϴ��ļ��Ĵ�С
		//'simUploadLimit' :3, //�����ϴ����� 
		'queueSizeLimit' :1, //���ϴ����ļ�����
		//'buttonText' :'�ļ��ϴ�',//ͨ�������滻ť���ϵ�����
		'buttonImg': 'js/browseBtn.png',//�滻�ϴ�ť��
		'width'    : 90,//buttonImg�Ĵ�С
		'height'   : 34,//
		'rollover' : false,//button�Ƿ�任
		onComplete : function (evt, queueID, fileObj, response, data) {
			//alert("Successfully uploaded: "+fileObj.filePath);
			//alert(response);
			getResult(response);//����ϴ����ļ�·��
		}
		//onError: function(errorObj) {
		//	alert(errorObj.info+"			"+errorObj.type);
		//}
	});
});
</script>
<script type="text/javascript">
	function getResult(content){
		//ͨ���ϴ���ͼƬ����̬����text������·��
			var board = document.getElementById("divTxt");
			board.style.display="";
			var newInput = document.createElement("input");
			newInput.type = "text"; 
			newInput.size = "45"; 
			newInput.name="myFilePath";
			var obj = board.appendChild(newInput);
			var br= document.createElement("br"); 
			board.appendChild(br);
			obj.value=content;
	}
	function clearNoNum(event,obj){ 
        event = window.event||event; 
        if(event.keyCode == 37 | event.keyCode == 39){ 
            return; 
        } 
        obj.value = obj.value.replace(/[^\d.]/g,""); 
        obj.value = obj.value.replace(/^\./g,""); 
        obj.value = obj.value.replace(/\.{2,}/g,"."); 
        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); 
    } 
    function checkNum(obj){ 
        obj.value = obj.value.replace(/\.$/g,"");
    }
	function isOK()
	{	 
		if(document.form2.name.value==""){
			alert("��������Ʒ���ƣ�");document.form2.name.focus('');return false;
		}else if(document.form2.type.value==" "){
			alert("��ѡ����Ʒ���ͣ�");return false;
		}
		else if(document.form2.price.value==""){
		alert("��������Ʒ�۸�");return false;
		}
	}
</script>
</head>
<body>
<fieldset style="border: 1px solid #CDCDCD; padding: 8px; padding-bottom:0px; margin: 8px 0">
		<legend> <strong> ��ƷͼƬ�ϴ�</strong></legend>
		<div>	
			<input id="fileInput2" name="fileInput2" type="file" /> <font color="#FF0000"><strong>ע��:�ϴ�ͼƬ��С���ܳ���100kb</strong></font>
			<input type="button" value="ȷ���ϴ�" onClick="javascript:$('#fileInput2').uploadifyUpload();">
			<!--<a href="javascript:$('#fileInput2').uploadifyClearQueue();">����ϴ��б�</a>--></div>
	<p></p>
</fieldset>
<form name="form2" action="adddin.php"  method="post" onSubmit="return isOK();">
  <table  width="100%" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=7 style="height: 23px">��Ʒ���</th>
      </tr>
	  <tr bgcolor="#DEE5FA">
        <td colspan="7" align="center" class=txlrow><font color="#FF0000"><strong>ע�⣺��ƷͼƬ���Բ��ϴ� ��������ϢΪ����ѡ��</strong></font></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
	  <?php if($dinid){echo "<td width=\"10%\"  align=\"center\" class=txlHeaderBackgroundAlternate>�Ƿ�Ԥ��</td>";}?>
        <td width="10%"  align="center" class=txlHeaderBackgroundAlternate>��Ʒ����</td>
        <td width="10%"  align="center" class=txlHeaderBackgroundAlternate>��Ʒ����</td>
        <td width="10%"  align="center" class=txlHeaderBackgroundAlternate>��Ʒ�۸�</td>
		<td width="20%"  align="center" class=txlHeaderBackgroundAlternate>��ƷͼƬ</td>
        <td width="40%"  align="center" class=txlHeaderBackgroundAlternate>��Ʒ���</td>
		<td align="center" class=txlHeaderBackgroundAlternate>����</td>
      </tr>  
	  <tr align="center" bgcolor="#799AE1">
	    <?php if($dinid){?><td width="10%"  align="center" class="txlRow"><select name="isell"><option value="1" <?php if($array['isellout']==1) {echo "selected='selected'";}?>>����Ԥ��<option value="0" <?php if($array['isellout']==0){echo "selected='selected'";}?>>������</select></td></option><?php }?>
        <td width="20%"  align="center" class=txlrow><?php if($dinid){echo "<input type='text' name='name' size='20' value='".$array['dinname']."'/>";echo "<input type='hidden' name='dinid' value='".$array['dinid']."'/>";}else{echo "<input type='text' name='name' size='20' maxlength='18'/>";}?></td>
		
        <td width="20%"  align="center" class=txlrow>
		<select name="type">
		
		<?php foreach($typearr as $row){?>
		<option value="<?php echo $row['id'];?>" <?php if($dinid){if(($array['dintype'])==$row['id']){echo "selected";}}else{if(($_POST['type'])==$row['id']){echo "selected";}}?>>
		<?php echo $row['dintype']; }?>
		
		
		</select>
		</td>
        <td width="10%"  align="center" class=txlrow><?php if($dinid){echo "<input type='text' name='price' size='10'  onBlur='checkNum(this)' onKeyUp='clearNoNum(event,this)' onselectstart='return false' onpaste='return false' value='".$array['dinprice']."'/>";}else{ echo "<input type='text' name='price' size='10'  onBlur='checkNum(this)' onKeyUp='clearNoNum(event,this)' onselectstart='return false' onpaste='return false' />";}?></td>
		<td width="20%"  align="center" class=txlrow><div id="divTxt" style="display:none"></div></td>
        <td width="20%"  align="center" class=txlrow><textarea name="intro" cols="40" rows="5"><?php echo $array['beizhu']?></textarea></td>
		<td width="20%"  align="center" class=txlrow><input type="submit" value="����"/></td>
      </tr>  
	 
	</tbody>
  </table>
</form>
</body>
</html>