{literal}
<style type="text/css">
#sidebar {float:left; width:600px}
</style>
{/literal}

<div style="min-height:100px; width:350px; float:right">
</div>
<script src="javascript/checkout.js" type="text/javascript"></script>
<form  name="mycheck"action="purchase.php" method="post" onsubmit="return isOK();" style="float:left">
<table border="0" width="600px" cellspacing="0">  
<tr><td colspan="4" align="left" bgcolor="#DEEAF8">
<font color="red">��ܰ���ѣ���׼ȷ��д��ϸ��Ϣ�����ڵ�ǰλ���������µ���</font>
ֻ�������--<a href="./showshop.php?shopid=1" style="color:#CC3300">�������ȥ�Ҷ��������</a>
</td></tr>

<tr height="40px">
<td><font color="red">��ϸ��ַ��</font></td>
<td><input type="text" name="address" value="{$scadd[0]}" maxlength="40" size="40"/></td> 
</tr>

<tr height="40px">
<td><font color="red">�ֻ����룺</font></td>
<td><input type="text" name="telphone" value="{$scadd[1]}" maxlength="11" size="40" onblur="return isPhone()"/></td>
</tr>

<tr height="40px">
<td>���õ绰��</td>
<td><input type="text" name="otherphone" value="" maxlength="11" size="40" /></td>
</tr>

<tr>
<td colspan="4"><hr /></td>
</tr>
    
<tr>
<td>�Ͳ�ʱ�䣺</td>
<td>
    <select name="deliver_time" id="deliver_time">	  
    <option value="�����ͳ�">�����ͳ�</option>	 
    {section name=tag loop=$sctime}
    <option value="{$sctime[tag]}">{$sctime[tag]}</option>		  
    {/section}
    </select>  
</td>
</tr>

<tr height="50px">
<td>��Ҫ�Ը���</td>
<td><br />
	  <input  type="button" value="ô��Ǯ" onclick="document.getElementById('xinxi').value+=this.value+' '"  /> 
	  <input  type="button" value="��Ҫ�н���" onclick="document.getElementById('xinxi').value+=this.value+' '"  /> 
	  <input  type="button" value="������" onclick="document.getElementById('xinxi').value+=this.value+' '"  />
	  <input  type="button" value="��һ��" onclick="document.getElementById('xinxi').value+=this.value+' '"  /> 
	  <input  type="button" value="�����" onclick="document.getElementById('xinxi').value+=this.value+' '"  /><br />
	  <input  type="button" value="����" onclick="document.getElementById('xinxi').value+=this.value+' '"  /> 
	  <input  type="button" value="��" onclick="document.getElementById('xinxi').value+=this.value+' '"  /> 
	  <input  type="button" value="thank you" onclick="document.getElementById('xinxi').value+=this.value+' '"  /><br />
	  <textarea id="xinxi" name="bzxx" rows="3" cols="50"></textarea>
</td>
</tr>
   
<tr>
<td colspan="4" align="left" bgcolor="#DEEAF8"><font color="red">����ȷ�ϰ�ť�ύ���Ķ�����лл!</font>
</td>
</tr>
<tr align="center">
<td colspan="4">
<input type='submit' id='jcart-paypal-checkout' name='jcart_paypal_checkout' value='ȷ�϶���'  style='display:block; padding:10px; margin:20px auto;'/>
</td>
</tr>

</table>
</form>
</div>
