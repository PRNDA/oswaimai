<?php
@session_start();
include "../global.php";
if (empty($_SESSION['uname']))
{
	header("location:./index.php");exit();
}
$unex=explode('|',$_SESSION['uname']);

if($_SERVER['REQUEST_METHOD']=='POST')
{
	if($_POST['myFilePath']){
		$query = "update wm_shopinfo set shopadd='$_POST[add]',shoptel='$_POST[tel]',shopimage='$_POST[myFilePath]',online='$_POST[state]',shopintro='$_POST[intro]',beizhu='$_POST[beizhu]' where shopid='$unex[0]'";
	}else{
		$query = "update wm_shopinfo set shopadd='$_POST[add]',shoptel='$_POST[tel]',online='$_POST[state]',shopintro='$_POST[intro]',beizhu='$_POST[beizhu]' where shopid='$unex[0]'";
	}
	$result = $db->query($query);		
	if($result){echo "<IMG height=13 src=\"images/tick.png\" width=16 align=absMiddle />����ɹ�";}else{echo "<IMG height=13 src=\"images/cross.png\" width=16 align=absMiddle />����ʧ��";}
}
$row=get_shop_details($db,$unex[0]);
?>
<html>
<head>
<link href="css/main.css"      rel="stylesheet" type="text/css" />
<link href="css/default.css"   rel="stylesheet" type="text/css" />
<link href="css/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jcart/jquery-1.5.1.js"></script>
<script type="text/javascript" src="./js/swfobject.js"></script>
<script type="text/javascript" src="./js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#fileInput2").uploadify({
		'uploader'   : './js/uploadify.swf',//����Ҫ��flash�ļ�
		'cancelImg'  : './js/cancel.png',//����ȡ���ϴ���ͼƬ
		'script'     : './js/uploadify.php',//ʵ���ϴ��ĳ���
		'folder'     : 'uploads',//����˵��ϴ�Ŀ¼
		//'auto': true,//�Զ��ϴ�
		//'multi': true,//�Ƿ���ļ��ϴ�
		//'checkScript': 'js/check.php',//��֤ ������˵�
		'displayData': 'speed',//����������ʾ��ʽ
		'fileDesc'   : 'Image(*.jpg;*.gif;*.png)',//�Ի�����ļ���������
		'fileExt'    : '*.jpg;*.jpeg;*.gif;*.png',//���ϴ����ļ�����
		//'sizeLimit': 999999 ,//�����ϴ��ļ��Ĵ�С
		//'simUploadLimit' :3, //�����ϴ����� 
		'queueSizeLimit' :1, //���ϴ����ļ�����
		//'buttonText' :'�ļ��ϴ�',//ͨ�������滻ť���ϵ�����
		'buttonImg'  : './js/browseBtn.png',//�滻�ϴ�ť��
		'width'      : 90,//buttonImg�Ĵ�С
		'height'     : 34,//
		'rollover'   : false,//button�Ƿ�任
		onComplete: function (evt, queueID, fileObj, response, data) {
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
</script>
<script type="text/javascript">
function killErrors() {
return true;
}
window.onerror = killErrors;
	
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
	function isOK(){
	var phone=document.form2.tel.value;
	if(document.form2.add.value==""){alert('�͵��ַ����Ϊ��');return false;}
	if(phone==""){return true;}
	 if(!(/^1[3-8][0-9]\d{8}$/.test(phone))){ 
    alert("������ĺ�����������������"); 
    document.form2.tel.focus(); 
    return false; }
    return true;
	}
	window.onload = function() ����//����textarea�ı�������� textareaû��value��maxlength����
	{ ����
	document.getElementById('intro').onkeydown = function(){ ����
	if(this.value.length >= 80) ����
	event.returnValue = false;
	}
	} 

</script>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
<?php if($_GET['id']==$unex[0]){?>

<fieldset style="border: 1px solid #CDCDCD; padding: 8px; padding-bottom:0px; margin: 8px 0">
<legend> <strong> �͵�ͼƬ�ϴ�</strong></legend>
<div>	
<input id="fileInput2" name="fileInput2" type="file" /> <font color="#FF0000"><strong>ע��:�ϴ�ͼƬ��С���ܳ���100kb �ϴ�ͼƬΪ��ѡ����ǽ������ϴ���</strong></font>
<input type="button" value="ȷ���ϴ�" onClick="javascript:$('#fileInput2').uploadifyUpload();">
<!--<a href="javascript:$('#fileInput2').uploadifyClearQueue();">����ϴ��б�</a>--></div>
</fieldset>
<form action='shopinfo.php' name='form2' method='post' onSubmit='return isOK();'>
<?php }
$o=$row['online'];
if($o==2){$state="֧�����߶���";}else if($o==0){$state="������Ϣ��";}else if($o==1){$state="���е绰����";}
?>

  <table  width="100%" border=0 align=center cellpadding=2 cellspacing=1 bordercolor="#799AE1" class=tableBorder>
    <tbody>
      <tr>
        <th align=center colspan=8 style="height: 23px">������Ϣ|�޸�</th>
      </tr>
	  <tr bgcolor="#DEE5FA">
        <td colspan="8" align="center" class=txlrow><font color="#FF0000"><strong>ע��:��������Ŀǰֻ֧��һ���绰���룬�����������ϵ����Ա</font></td>
      </tr>
      <tr align="center" bgcolor="#799AE1">
        <td width="20%" align="right" class=txlHeaderBackgroundAlternate>�͵�����</td>
		<td width="80%" align="left" class=txlrow><?php if($_GET['id']==$unex[0]){echo "<input type=text name='sname' size=20 disabled='disabled' value='".$row['shopname']."'/>";}else{echo "<input type=text name='sname' size=20 disabled='disabled' value='".$row['shopname']."'/>";}?></td>
      </tr> 
	   <tr align="center" bgcolor="#799AE1">
        <td width="20%" align="right" class=txlHeaderBackgroundAlternate>�͵��ַ</td>
		<td width="80%" align="left" class=txlrow><?php if($_GET['id']==$unex[0]){echo "<input type=text name='add' size=20 maxlength='20' value='".$row['shopadd']."'/>";}else{echo $row['shopadd'];}?></td>
      </tr> 
	   <tr align="center" bgcolor="#799AE1">
        <td width="20%" align="right" class=txlHeaderBackgroundAlternate>��������</td>
		<td width="80%" align="left" class=txlrow><?php if($_GET['id']==$unex[0]){echo "<input type=text name='tel' size='13' maxlength='11' value='".$row['shoptel']."'/>";}else{echo $row['shoptel'];}?></td>
      </tr> 
	   <tr align="center" bgcolor="#799AE1">
        <td width="20%" align="right" class=txlHeaderBackgroundAlternate>�͵���</td>
		<td width="80%" align="left" class=txlrow><?php if($_GET['id']==$unex[0]){echo "<textarea name='intro'  rows='5' cols='30' style='border: 1 solid #888888;LINE-HEIGHT:18px;padding: 3px;'>".$row['shopintro']."</textarea>";}else{echo $row['shopintro'];}?></td>
      </tr> 
	   <tr align="center" bgcolor="#799AE1">
        <td width="20%" align="right" class=txlHeaderBackgroundAlternate>�͵�ͼƬ</td>
		<td width="80%" align="left" class=txlrow><?php if($_GET['id']==$unex[0]){echo "<div id='divTxt' style='display:none'></div>";}else{echo "<img src='".$row['shopimage']."' width='80px' height='60px'/>";}?></td>
      </tr> 
	  <tr align="center" bgcolor="#799AE1">
        <td width="20%" align="right" class=txlHeaderBackgroundAlternate>����˵����������ʱ���</td>
		<td width="80%" align="left" class=txlrow><?php if($_GET['id']==$unex[0]){echo "<textarea name='beizhu'  rows='5' cols='30' style='border: 1 solid #888888;LINE-HEIGHT:18px;padding: 3px;'>".$row['beizhu']."</textarea>";}else{echo $row['beizhu'];}?></td>
      </tr> 
	  <tr align="center" bgcolor="#799AE1">
        <td width="20%" align="right" class=txlHeaderBackgroundAlternate>Ӫҵ״̬</td>
		<td width="80%" align="left" class=txlrow><?php if($_GET['id']==$unex[0]){?><select name='state'><option value='1' <?php if($o==1) {echo "selected";}?>>���е绰����<option value='0'<?php if($o==0) {echo "selected";}?>>������Ϣ��<option value='2'<?php if($o==2){echo "selected";}?>>֧�����߶���<?php
		}else{echo $state;}?></td>
      </tr> 
	  <tr align="center" bgcolor="#799AE1">
        <td width="20%" align="right" class=txlHeaderBackgroundAlternate>����</td>
		<td width="80%" align="left" class=txlrow><?php if($_GET['id']==$unex[0]){echo "<input type=submit value='����'/>";}else{echo "<a href='shopinfo.php?id=".$unex[0]."'>�޸�</a>";}?></td>
      </tr> 
	</tbody>
  </table>
  <?php if($_GET['id']==$unex[0]){echo "</form>";}?>

</body>
</html>