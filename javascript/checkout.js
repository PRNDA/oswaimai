
function isPhone(){
	var phone=document.mycheck.telphone.value;
	if(phone==""){alert("��ϵ�绰����Ϊ�գ��������������ϵ�ң�QQ��312181918");return false;}
	if(!(/^1[3|5|8][0-9]\d{8}$/.test(phone))){ 
    alert("��������ֻ�����������һ�£�лл��"); 
	document.mycheck.telphone.focus();
    return false; }
    return true;
	}
function isAddress(){
	var address=document.mycheck.address.value;
	if(address==""){alert("���������͵�ַ��лл��");return false;}
    return true;
	}
function isOK()
{
	var mark = $('#mark').val()?0:1;
	if(mark)
	{
		if(checkForm() && isAddress() && isPhone())
		{
			$('#jcart-paypal-checkout').attr("disabled",true);
			return true;	
		}
		else
		{
			return false;
		}
	}
	else
	{
		alert("�ף����鹺�ﳵ���Ƿ������ߵ���");
		return false;
	}
}
