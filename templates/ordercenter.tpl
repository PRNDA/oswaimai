<div id="content">
<div id="evl" style="z-index:30;height:200px; width:350px; border:5px solid #F90; background-color:white;display:none">

</div>
{if $tag!=1}
<div style="border:1px #dee5fa solid; float:right; width:958px; margin-top:5px">��ӭ���������һ��Ķ�������ʾ�ڶ������ġ����������Ҷ�����ע���Ա��<a href="register.php"><font color="#3399FF">���ھ�ע���Ϊ�Ҷ�����Ա�� </font></a></div>
{else}
<div style="float:left; height:300px; width:150px; border:1px solid #e7e7e7; margin-top:10px">
<table width="100%" border="0" style="text-align:center" cellpadding="5px">
<tr><td><a href="./ordercenter.php">�ҵĶ���</a></td></tr>
<tr><td><a href="./mycollection.php">�ҵ��ղ�</a></td></tr>
<tr><td><a href="./editpwd.php">�޸�����</a></td></tr>
<tr><td><a href="./editemail.php">�޸�����</a></td></tr>
</table>
</div>
<div style="float:right; width:800px; border:1px solid #e7e7e7; margin-top:10px; min-height:300px">
<table width="100%" style="float:left" border="0">
<tr style="color:#00F; font-weight:bold; text-align:center">
<td width="8%">������</td><td width="15%">�͵�</td><td width="13%">�ܼ�</td><td width="25%">���͵�ַ</td><td width="20%">�µ�ʱ��</td>
<td width="10%">״̬</td><td width="9%">����</td>
</tr>
{section name=tag loop=$orders}

{assign var=id value=$orders[tag].orderid}
<tr style="text-align:center">
<td style="border:1px solid green">{$orders[tag].orderid}</td>
<td style="border:1px solid green"><a href="./showshop_{$orders[tag].shopid}.html">{$shopnames[$id]}</a></td>
<td style="border:1px solid green">{$orders[tag].total_price}Ԫ</td>
<td style="border:1px solid green">{if $orders[tag].address!=NULL}{$orders[tag].address}{else}�绰Ԥ��{/if}</td>
<td style="border:1px solid green">{$orders[tag].orderdate}</td>
<td style="border:1px solid green"><font color="red">
{if $orders[tag].state==0}δ����
{elseif $orders[tag].state==1}�ѽ���
{elseif $orders[tag].state==2}�绰Ԥ��
{elseif $orders[tag].state==3}�ɽ�
{elseif $orders[tag].state==4}ʧ��
{elseif $orders[tag].state==5}��ӡδ�ɽ�
{elseif $orders[tag].state==6}����
{/if}</font></td>
<td style="border:1px solid green"><span id="pjs{$orders[tag].orderid}">
{if $orders[tag].state!=3&&$orders[tag].state!=6}����
{elseif $orders[tag].state==6}
����
{else}
<a href="javascript:show_evl(1,'{$orders[tag].orderid}',0,'{$shopnames[$id]}','{$orders[tag].shopid}')">����</a>
{/if}
</span></td>
</tr>
{section name=item loop=$orderitems[$id]}
<tr style=" text-align:center">
<td colspan="2" align="right">{$orderitems[$id][item].dinname}</td>
<td>����:��{$orderitems[$id][item].unitprice}</td>
<td>����:{$orderitems[$id][item].dinnum}</td>
<td>�ܼ�:��{$orderitems[$id][item].dinprice}</td>
<td></td>
<td>
<span id="pjs{$orders[tag].orderid}{$orderitems[$id][item].dinid}">
{if $orders[tag].state!=3&&$orderitems[$id][item].state!=1&&$orders[tag].state!=6}����
{elseif $orderitems[$id][item].state==1}
����
{else}
<a href="javascript:show_evl(1,'{$orders[tag].orderid}','{$orderitems[$id][item].dinid}','{$shopnames[$id]}','{$orders[tag].shopid}','{$orderitems[$id][item].dinname}')">����</a>
{/if}
</span></td>
</tr>
{/section}

{/section}
</table>
</div>
{/if}
{literal}
<script type="text/javascript">
function show_evl(tag,oid,did,shopname,shopid,dinname)
{
	if(tag==1)
	{
		if(did==0){
		$('#evl').html("<div style='float:left; width:100%; text-align:right'><span style='float:left'>�͵�����</span><span style='float:right'><a href='javascript:show_evl(0)'>�ر�</a></span></div><div style='float:left;width:100%;border-top:1px solid #e7e7e7'><table width='100%' border='0'><tr><td colspan='2'>"+shopname+"   �����ţ�"+oid+"</td></tr><tr><td>�������ۣ�</td><td><input type='radio' name='pingjia' value='1'/>�ܲ�<input type='radio' name='pingjia' value='2' />��<input type='radio' name='pingjia' value='3' />һ��<input type='radio' name='pingjia' value='4' />��<input type='radio' name='pingjia' value='5' checked='true' />�ܺ�</td></tr><tr><td>�����ٶȣ�</td><td>&nbsp;��Լ<select id='speed'><option value='15'>15</option><option value='30'>30</option><option value='45' selected>45</option><option value='60'>60</option><option value='75'>75</option><option value='90'>90</option><option value='115'>115</option><option value='120'>120</option></select>�����͵�</td></tr><tr><td valign='top'>дд������</td><td>&nbsp;<textarea style='width:200px; height:50px' id='pj_content'></textarea></td></tr><tr><td></td><td>&nbsp;<input type='button' value='��������' onclick='post_pj("+oid+","+did+","+shopid+")'/></td></tr></table></div>");
		}else
		{
			$('#evl').html("<div style='float:left; width:100%; text-align:right'><span style='float:left'>��Ʒ����</span><span style='float:right'><a href='javascript:show_evl(0)'>�ر�</a></span></div><div style='float:left;width:100%;border-top:1px solid #e7e7e7'><table width='100%' border='0'><tr><td colspan='2'>"+shopname+"</td></tr><tr><td>��Ʒ���ƣ�</td><td>&nbsp;"+dinname+"</td></tr><tr><td>��Ʒ���ۣ�</td><td><input type='radio' name='pingjia' value='1'/>�ܲ�<input type='radio' name='pingjia' value='2' />��<input type='radio' name='pingjia' value='3' />һ��<input type='radio' name='pingjia' value='4' />��<input type='radio' name='pingjia' value='5' checked />�ܺ�</td></tr><tr><td valign='top'>дд������</td><td>&nbsp;<textarea style='width:200px; height:50px' id='pj_content'></textarea></td></tr><tr><td></td><td>&nbsp;<input type='button' value='��������' onclick='post_pj("+oid+","+did+","+shopid+")'/></td></tr></table></div>");
		}

		$('#evl').show();
		welwm.centerLayer("evl");
	}else if(tag==0)
	{
		$('#evl').hide();
	}
}
function post_pj(oid,did,shopid)
{
	//didΪ0�Ƕ������۷���Ϊ��Ʒ����
	var pinjia = $("input[type=radio][checked]").val();
	var speed   = $('#speed').val();
	var pj_content = $('#pj_content').val();
	$.ajax({type: "POST",dataType : "text",async : false,url: "./checkdata/post_grade.php",
			data: {"oid" : oid,'did':did,'shopid':shopid,'pinjia':pinjia,'speed':speed,'pj_content':pj_content},
			success: function(res){if(res){$('#evl').hide();if(did==0){$('#pjs'+oid).html('����')}else{$('#pjs'+oid+did).html('����')}}},
			error : function(res,msg,err) {alert(msg);}
	});
	
}
</script>
{/literal}
</div>