<div id="content">
{section name=tag loop=$order}
{if $smarty.section.tag.first}
<table width="100%" style="float:left">
<tr>
<td width="25%">�͵����ƣ�{$shopname}</td>
<td width="20%">������ţ�{$order[tag].orderid}</td>
<td width="20%">�����ܼۣ�{$order[tag].total_price}Ԫ</td>
<td width="35%">���͵�ַ��{$order[tag].address}</td>
</tr>
<tr>
<td>�µ�ʱ�䣺{$order[tag].orderdate}</td>
<td>�Ͳ�ʱ�䣺{$order[tag].sctime}</td>
<td>����״̬��<font color="red">{if $order[tag].state==0}δ����{elseif $order[tag].state==1}�ѽ���{/if}</font></td>
<td><font color="red">��ϵ�绰</font>��{$order[tag].telphone}</font></td></tr>
</tr>
<tr>
<td colspan="4">
����������{$order[tag].beizhu}
</td>
</tr>
</table>
<hr style="width:100%; float:left"/>
<table border="0" width="100%" cellpadding="5" style="float:left">
<tr>
<td>
��Ʒ����
</td>
<td>
��Ʒ����
</td>
<td>
��Ʒ����
</td>
<td>
��Ʒ�ܼ�
</td>
<td>
��Ʒ����
</td>
</tr>

{/if}
<tr>
<td>
{$order[tag].dinname}
</td>
<td>
{$order[tag].dintype}
</td>
<td>
{$order[tag].dinnum}
</td>
<td>
{$order[tag].dinprice}
</td>
<td>
{$order[tag].unitprice}
</td>
</tr>
{/section}
</table>
</div>