$(document).ready(function() {
	//����û����Ƿ����
	function existUsername(value) {
		var exist = false;
		$.ajax({
			type: "POST",dataType : "text",async : false,url: "./checkdata/checkUsername.php",
			data: {"username" : value},
			success: function(res){if(res == 1) {exist = true;}else if(res == 0) {exist = false;}},
			error : function(res,msg,err) {alert(msg);}
		});
		return exist;
	}
	function existEmail(value) {
		var exist = false;
		$.ajax({type: "POST",dataType : "text",async : false,url: "./checkdata/checkEmail.php",
			data: {"email" : value},
			success: function(res){if(res == 1) {exist = true;}else if(res == 0) {exist = false;}},
			error : function(res,msg,err) {alert(msg);}
		});
		return exist;
	}
	function testUsername(value) {
		return (/^[a-zA-Z][a-zA-Z0-9_]{1,19}$/.test(value)||/[\u4e00-\u9fa5]/.test(value))?true:false;
	}
		
	function testPassword(value) {
		return /^[0-9a-zA-Z]+$/.test(value);
	}
	function testOldpassword(value)
	{
		var exist = false;
		$.ajax({
			type: "POST",dataType : "text",async : false,url: "./checkdata/checkPassword.php",
			data: {"password" : value},
			success: function(res){if(res == 1) {exist = true;}else if(res == 0) {exist = false;}},
			error : function(res,msg,err) {alert(msg);}
		});
		return exist;
	}
	//����Զ������֤����
	$.validator.addMethod("username_exist", function(value) {return existUsername(value);}, "���û����ѱ�����ע�ᣡ");
	$.validator.addMethod("email_exist",    function(value) {return existEmail(value);}, "���ǳ��ѱ�����ʹ�ã�");
	$.validator.addMethod("username_test",  function(value) {return testUsername(value);}, "�û���������Ҫ��");
	$.validator.addMethod("password_test",  function(value) {return testPassword(value);}, "���벻�ܺ��������ַ�");
	$.validator.addMethod("oldpassword_exist",  function(value) {return testOldpassword(value);}, "�����벻��ȷ");
	
	$("#frmRegister").validate({
		onkeyup:false,
		rules : {
			"username" : {required : true,minlength : 2,username_test:true,username_exist : true},
			"pwd" :      {required : true,minlength : 6,password_test:true},
			"rpwd" :     {required : true,minlength : 6,equalTo : "#pwd"},
			"email" :    {required : true,email : true,email_exist : true}
		},
		messages : {
			"username" : {required : "�������û���",minlength : "�û�����������2λ"},
			"pwd"      : {required : "����������",minlength : "���볤������Ϊ6λ"},
			"rpwd"     : {required : "������ȷ������",minlength : "ȷ�����볤������Ϊ6λ",equalTo : "������һ�µ�����"},
			"email"    : {required : "�������������",email : "��������ȷ��ʽ���ʼ���ַ"}
		},
		errorPlacement: function(error, element) {
			//������Ϣ���λ��
        	error.appendTo(element.parent().parent().parent().parent().parent());
		}
	});
	
	$("#frmRegister").submit(function() {
		var chkAgreement = $("#chkAgreement");
		if(chkAgreement.attr("checked") != true) {
			alert("������ͬ���û�ע��Э����ܽ���ע�ᣡ");
			return false;
		}
	});
	
	$("#editpwdForm").validate({
		onkeyup:false,
		rules : {
			"oldpwd" : {required : true,oldpassword_exist : true},
			"newpwd" : {required : true,minlength : 6,password_test:true},
			"rpwd" :   {required : true,equalTo : "#newpwd"}
		},
		messages : {
			"oldpwd" : {required : "�����������"},
			"newpwd" : {required : "����������",minlength : "���볤������Ϊ6λ"},
			"rpwd"   : {required : "������ȷ������",equalTo : "������һ�µ�����"}
		},
		errorPlacement: function(error, element) {
			//������Ϣ���λ��
        	error.appendTo(element.parent());
		}
	});
	
	$("#editemailForm").validate({
		onkeyup:false,
		rules : {
			"password" : {required : true,oldpassword_exist : true},
			"newemail" : {required : true,email : true,email_exist : true}
		},
		messages : {
			"password" : {required : "�����������"},
			"newemail" : {required : "�������������",email : "��������ȷ��ʽ���ʼ���ַ"}
		},
		errorPlacement: function(error, element) {
			//������Ϣ���λ��
        	error.appendTo(element.next());
		}
	});
	
	$("#kaidian").validate({
		onkeyup:false,
		rules : {
		"realname" : {required : true},
		"mobilephone":{ required:true,minlength : 11},
		"shopname":{required:true},
		"shopaddress":{required:true},
		"shopinfo":{required:true}
		
		},
		messages : {
		"realname" : {required : "�������������"},
		"mobilephone":{ required:"�������ֻ�����",minlength : "��������ֻ��Ų���ȷ"},
		"shopname":{required:"������͵�����"},
		"shopaddress":{required:"������͵��ַ"},
		"shopinfo":{required:"������͵���"}
		},
		errorPlacement: function(error, element) {
		//������Ϣ���λ��
		error.appendTo(element.parent().parent().parent().parent().parent());
		}
		
	 });
	
});
