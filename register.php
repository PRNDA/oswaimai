<?php
header('Content-Type:text/html;charset=gb2312');
session_start();
if(isset($_SESSION['email']))
{
	header("Location:./index.php");exit;
}
include_once('./global.php');
require_once ('email.class.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$nickname = ereg_replace('[[:space:]]','',$_POST['username']);
	$password = strtolower($_POST['pwd']);
	$password = ereg_replace('[[:space:]]','',$password);
	
	if(!preg_match("/^[0-9a-zA-Z]+$/",$password) || strlen($password)<6)
	{
		header("Location:./register.php?erroe=pass");
		exit;
	}
	if(!preg_match("#^[a-z0-9&\-_\.\+]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+$#i",$_POST['email']))
	{
		header("Location:./register.php?erroe=email");
		exit;
	}
	$randomstring='';
	for ($i = 0; $i < 10; $i++)
	{
		$randomstring .= chr(mt_rand(97, 122)); //Range of ASCII characters
	}
	$verifystring = $randomstring;
	
	$query = "insert into wm_admin_c  values('','$_POST[email]','".md5($password.'welwm')."','$nickname','$verifystring','0','200',now())";
	
	if($db->query($query))
	{
		$verifyurl = "http://".$_SERVER['HTTP_HOST']."/jihuo.php";
		$_SESSION['email'] = $_POST['email'];
		$smtpemailto = $_POST['email'];
		$mailsubject = "�뼤�����ĳ������˻�";
		$mailbody = "<h3>�����Ʊ��������û��������룬лл��<br>�����û���Ϊ��".$nickname."<br>��������Ϊ��".$password;
		$mailbody=<<<_MAIL_
<strong>�װ��Ļ�Ա: $nickname ���ã�</strong>
<p><br/>�������뿪ͨ�������˻�����$nickname),���������</p>
<strong><a href=$verifyurl?email=$smtpemailto&verify=$verifystring>�����������</a></strong>
<p><br/><small>����������ֵ����Ч�����������ҳ��ַ���Ƶ��������ַ���д򿪣�</small></p>
$verifyurl?email=$smtpemailto&verify=$verifystring
_MAIL_;
		$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
		$smtp->debug = FALSE;
		$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
		header("Location:./index.php");
	}
}else
{
	include "./header.php";
	$smarty->display('register.tpl');
	include "./footer.php";
}
?>