<?php
if($_SERVER['REMOTE_ADDR']=="127.0.0.1"){
$mydbuser		="root";	        //���ݿ��û�
$mydbpw			="";	        //���ݿ�����
$mydbname		="yiwaimai";		//���ݿ�
}else{
$mydbuser		="s525071db0";	        //���ݿ��û�
$mydbpw			="8t68u79z";	        //���ݿ�����
$mydbname		="s525071db0";		//���ݿ�
}
$mydbhost		="localhost";//��������
$mydbcharset	="gb2312";
//================

$smarty_template_dir	='./templates/';
$smarty_compile_dir	    ='./templates_c/';
$smarty_config_dir	    ='./configs/';
$smarty_cache_dir	    ='./cache/';
$smarty_delimiter	    =explode("|","{|}");
$smarty_caching         = false;
$smarty_cache_lifetime  =60;   
//smtp email���ò�����ʼ
$smtpserver = "smtp.126.com";
$smtpserverport =25;
$smtpusermail = "qianfunian@126.com";
$smtpuser = "qianfunian";
$smtppass = "7780790";
$mailsubject = "���綩��";
$mailtype = "HTML";
//smtp email���ò�������

//��ʱ�������ò�����ʼ  
$uid = '113527';		
$pwd = 'qfn000';		
//��ʱ�������ò�������
error_reporting(E_ALL & ~E_NOTICE);
ini_set('date.timezone','PRC');
?>