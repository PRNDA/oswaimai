<script src="javascript/jcart.js" type="text/javascript"></script>
<link href="./admin/css/paginate.css" rel="stylesheet" type="text/css" />
<link href="./jcart/jcart.css" rel="stylesheet" type="text/css" />
<link href="./css/showcart.css" rel="stylesheet" type="text/css" />
{literal}
<style type="text/css">
.litp{float:left; padding:0px 5px; color:#0088C8; cursor:pointer}
.tphead{background-color:#fff;border:1px solid #dadada;color:#FF6300;padding-top:5px;padding-bottom:5px; margin-bottom:10px;margin-top:10px;width:100%;clear:both;height:20px;}
#weizhi{float:left; width:958px; border-bottom:1px solid #ffccff; border-left:1px solid #ffccff; border-right:1px solid #ffccff; margin-bottom:10px}
.tp{margin-bottom:10px; float:left; min-height:100px; width:100%}
#box2{float:left;width:958px; height:170px; border:1px solid #DADADA}
</style>
{/literal}

<div id="content">
<div id="weizhi">
��ǰλ��:<a href="./index.php">{$district}</a> > <a href="./index.php">{$build}</a> > {$shopname}
</div>
<div id="box2">
    <!--����ͼƬ��ʼ-->
    <div style="width:158px;float:left; margin-top:20px; margin-left:30px">  
      <div class="ct_bigpic">
        <img src="{$shopinfo.shopimage}" width="151" height="121" />
      </div>
    </div>
    <!--����ͼƬ����-->
    <!--������Ϣ��ʼ-->
    <div style="padding-top:20px; margin-left:210px">
      <div style="float:right;margin-top:5px; margin-right:15px">
      <iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://www.connect.renren.com/like/v2?url=http%3A%2F%2Fwww.welwm.com%2Fshowshop.php?shopid={$shopid}.php" style="width: 210px;height: 65px;">
      </iframe>
      </div>
      <ul class="ct_info" style="margin:0px">
        <li style="padding-top:0px;padding-bottom:5px; list-style:none;">
          <font size="3" color="#F30"><b>{$shopinfo.shopname}</b>&nbsp;</font>
          {nocache}
          <input type="button" style=" display:{if $exist!=NULL}{else}none{/if}" id="quxiao" onclick="saveshop('{$shopid}',0)" value="ȡ���ղ�" />
          <input type="button" style=" display:{if $exist==NULL}{else}none{/if}" id="collection" onclick="saveshop('{$shopid}',1)" value="�ղص���" />
          {/nocache}
          <label id="msg"></label>
        </li>
        <li style="list-style:none; display:none">
          �������:{$shopinfo.shopintro}
        </li>
        <li id="tel" class="footer_info" style="list-style:none;">
          ��ϵ�绰:{$shopinfo.shoptel}&nbsp;��ַ:{$shopinfo.shopadd} 
        </li>
        <li style="list-style:none;">
          Ӫҵʱ�䣺{$yysj}  
        </li>
        <li style="list-style:none;">
          {if $shopinfo.yhcontent!=NULL}
          {$shopinfo.yhcontent|truncate:132}&nbsp;&nbsp;{$shopinfo.yhdate}
          {/if}
        </li>
      </ul>
    </div>
    <!--������Ϣ����-->
  <!--������Ϣ����-->
</div>
<div style="width:650px; float:left;">
    <div id="tabs" class="tabs">
        <ul>
        {nocache}
        <li {if $tag eq 0}class="tabs_active"{/if}><a href="?shopid={$shopid}">����Ԥ��</a></li>
        <li {if $tag eq 1}class="tabs_active"{/if}><a href="?shopid={$shopid}&tag=1">�û�����</a></li>
        <li {if $tag eq 2}class="tabs_active"{/if}><a href="?shopid={$shopid}&tag=2">���̼��</a></li>
        {/nocache}
        </ul>
    </div>

    <!--���߶���-->
    <div style="float:left;{nocache}{if $tag != 0}display:none{/if}{/nocache}">
    <div style="float:left; width:100%; height:20px; border-bottom:1px dotted #dadada; padding:10px 0px; margin-bottom:10px">
    <ul style="margin:0px; padding:0px">
    <li class="litp" style="background-color:#D8EEFF" onclick="$('.tp').show();$('.litp').css('background','');$(this).css('background','#D8EEFF')">�������</li>
    {section name=tag loop=$shops}
    <li class="litp" onclick="$('.tp').hide();$('#tp{$shops[tag].dintype}').show();$('.litp').css('background','');$(this).css('background','#D8EEFF')">{$shops[tag].typename}</li>
    {/section}
    </ul>
    </div>
    {section name=tag loop=$shops}
    <div class="tp" id="tp{$shops[tag].dintype}">
    
    <div class="tphead">
    <div  style="float:left;"><font color='#000'>{$shops[tag].typename}</font></div>
    <div><a  href="javascript:window.scroll(0,0);" style="float:right">����</a></div>
    </div>
    
    {section name=tg loop=$dinners[tag]}
    {if $dinners[tag][tg].dinimage!=null}
    <div style="float:left; width:100%">
    <div style="float:left; width:180px; height:200px; border:1px dotted #9CC; margin:5px 15px 10px 15px">
    <form method="post" action="" class="jcart" style="margin:0px;padding:0px;">
    <input type="hidden" name="my-item-shop" value="{$dinners[tag][tg].shopid}" />
    <input type="hidden" name="my-item-id" value="{$dinners[tag][tg].dinid}" />
    <input type="hidden" name="my-item-name" value="{$dinners[tag][tg].dinname}" />
    <input type="hidden" name="my-item-price" value="{$dinners[tag][tg].dinprice}" />
    <input type="hidden" name="my-item-qty" value="1" size="3" />
    {if $dinners[tag][tg].popnum==0}
    {assign var="gif" value="no-repeat -211px -360px"}
    {elseif $dinners[tag][tg].popnum>0 and $dinners[tag][tg].popnum<=20}
    {assign var="gif" value="no-repeat -211px -344px"}
    {elseif $dinners[tag][tg].popnum>20 and $dinners[tag][tg].popnum<=40}
    {assign var="gif" value="no-repeat -211px -328px"}
    {elseif $dinners[tag][tg].popnum>40 and $dinners[tag][tg].popnum<=60}
    {assign var="gif" value="no-repeat -211px -312px"}
    {elseif $dinners[tag][tg].popnum>60 and $dinners[tag][tg].popnum<=80}
    {assign var="gif" value="no-repeat -211px -296px"}
    {else}
    {assign var="gif" value="no-repeat -211px -280px"}
    {/if}
    
    <table width="100%" border="0">
    <tr><td colspan="2" align="center"><img src="{$dinners[tag][tg].dinimage}" height="121px" width="151px"/></td></tr>
    <tr><td align="center">{$dinners[tag][tg].dinname}</td><td align="center">{$dinners[tag][tg].dinprice}</td></tr>
    <tr><td align="center"><span  title="����ָ��:{$dinners[tag][tg].popnum}" style=" background: url(./images/p.gif) {$gif};FLOAT:left;WIDTH: 50px; HEIGHT: 15px; margin-top:5px;"></span>
    </td><td align="center">{if $dinners[tag][tg].isellout==1}
    <input type='submit' name='my-add-button' value="��һ��"/>
    {else}
    ������
    {/if}</td></tr>
    </table>
    </form>
    
    </div>
    
    </div>
    {else}
    <div class="first" onmouseover="this.className='gray'" onmouseout="this.className='first'" style="height:30px;float:left;width:320px;border-bottom: 1px dashed #339933;">
    <form method="post" action="" class="jcart" style="margin:0px;padding:0px;">
    <table border="0" width="320px">
    <input type="hidden" name="my-item-shop" value="{$dinners[tag][tg].shopid}" />
    <input type="hidden" name="my-item-id" value="{$dinners[tag][tg].dinid}" />
    <input type="hidden" name="my-item-name" value="{$dinners[tag][tg].dinname}" />
    <input type="hidden" name="my-item-price" value="{$dinners[tag][tg].dinprice}" />
    <input type="hidden" name="my-item-qty" value="1" size="3" />
    <tr align="center">
    <td width="45%">{$dinners[tag][tg].dinname}</td>
    <td width="15%">{$dinners[tag][tg].dinprice}</td> 
    <td width="25%">
    {if $dinners[tag][tg].popnum==0}
    {assign var="gif" value="no-repeat -211px -360px"}
    {elseif $dinners[tag][tg].popnum>0 and $dinners[tag][tg].popnum<=20}
    {assign var="gif" value="no-repeat -211px -344px"}
    {elseif $dinners[tag][tg].popnum>20 and $dinners[tag][tg].popnum<=40}
    {assign var="gif" value="no-repeat -211px -328px"}
    {elseif $dinners[tag][tg].popnum>40 and $dinners[tag][tg].popnum<=60}
    {assign var="gif" value="no-repeat -211px -312px"}
    {elseif $dinners[tag][tg].popnum>60 and $dinners[tag][tg].popnum<=80}
    {assign var="gif" value="no-repeat -211px -296px"}
    {else}
    {assign var="gif" value="no-repeat -211px -280px"}
    {/if}
    <span  title="����ָ��:{$dinners[tag][tg].popnum}" style=" background: url(./images/p.gif) {$gif};FLOAT:left;WIDTH: 50px; HEIGHT: 15px; margin-top:5px;"></span>
    </td>
    {if $dinners[tag][tg].isellout==1}
    <td width="15%"><input type='submit' name='my-add-button' value="��һ��"/></td>
    {else}
    <td width="15%">������</td>
    {/if}
    </tr>
    </table>
    </form>
    </div>
    {/if}
    {/section}
    </div>
    {/section}
    </div>
    <!--���߶���-->

    <!--���̼��-->
    <div style="float:left; min-height:400px; width:100%;{nocache}{if $tag !=2}display:none{/if}{/nocache}">
    <ul>
    <li>���̼�飺{$shopinfo.shopintro}</li>
    <li>���̵�ַ��{$shopinfo.shopadd}</li>
    <li>����Żݣ�{$shopinfo.yhcontent}</li>
    <li>�Żݽ�ֹ��{$shopinfo.yhdate}</li>
    </div>
    <!--���̼��-->

    <!--�û�����-->
    <div style="float:left;width:100%;{nocache}{if $tag !=1}display:none{/if}{/nocache}">
    {if $dinpj==null}
    �����û�����
    {else}
    <table width="100%">
    <tr><td width="20%">����</td><td width="20%">����</td><td width="20%">ʳ��</td><td width="20%">��ʳ</td><td width="20%">����</td></tr>
    </table>
    {section name=pj loop=$dinpj}
    <form method="post" action="" class="jcart" style="margin:0px;padding:0px;">
    <table border="0" width="100%">
    <input type="hidden" name="my-item-shop" value="{$dinpj[pj].shopid}" />
    <input type="hidden" name="my-item-id" value="{$dinpj[pj].gradeid}" />
    <input type="hidden" name="my-item-name" value="{$dinpj[pj].dinname}" />
    <input type="hidden" name="my-item-price" value="{$dinpj[pj].dinprice}" />
    <input type="hidden" name="my-item-qty" value="1" size="3" />
    <tr>
    <td width="20%">
    {if $dinpj[pj].grade==0}
    {assign var="gif" value="no-repeat -271px -360px"}
    {assign var="xing" value="0"}
    {elseif $dinpj[pj].grade==1}
    {assign var="gif" value="no-repeat -271px -344px"}
    {assign var="grade" value="�ܲ�"}
    {assign var="xing" value="1"}
    
    {elseif $dinpj[pj].grade==2}
    {assign var="gif" value="no-repeat -271px -328px"}
    {assign var="grade" value="�����˼"}
    {assign var="xing" value="2"}
    
    {elseif $dinpj[pj].grade==3}
    {assign var="gif" value="no-repeat -271px -312px"}
    {assign var="grade" value="һ���"}
    {assign var="xing" value="3"}
    
    {elseif $dinpj[pj].grade==4}
    {assign var="gif" value="no-repeat -271px -296px"}
    {assign var="grade" value="�е���ζ"}
    {assign var="xing" value="4"}
    
    {elseif $dinpj[pj].grade==5}
    {assign var="gif" value="no-repeat -271px -279px"}
    {assign var="grade" value="�ҵ��"}
    {assign var="xing" value="5"}
    
    {/if}
    <span  title="��ʳ����:{$xing}��" style=" background: url(./images/p.gif) {$gif};FLOAT:left;WIDTH: 50px; HEIGHT: 15px; margin-top:5px;"></span>
    
    </td>
    <td width="20%">{$grade}</td>
    <td width="20%">{$dinpj[pj].nickname}</td>
    <td width="20%">{$dinpj[pj].dinname}</td>
    <td width="20%">
    {if $dinpj[pj].isellout==1}
    <input type='submit' name='my-add-button' value="��һ��"/>
    {else}
    ������
    {/if}
    </td>
    </tr>
    </table>
    </form>
    
    {/section}
    
    {/if}
    {$paginate}
    </div>
    <!--�û�����-->
</div>
</div>
{literal}
<script type="text/javascript" language="javascript">
function saveshop(id,tag)
{
	$.ajax({
			type: "POST",dataType : "text",async : false,url: "./shopcollection.php",
			data: {"shopid" : id,"tag":tag},
			success: function(res){
				if(res=='2')
				{
					showloginbox();
				}else if(res=='1'){
					$('#msg').html("�ղسɹ�");
					$('#collection').hide();
					$('#quxiao').show();
				}else if(res=='2')
				{
					$('#msg').html("�ղ�ʧ��");
				}else if(res=='3')
				{
					$('#msg').html("ȡ���ɹ�");
					$('#quxiao').hide();
					$('#collection').show();
				}else if(res=='4')
				{
					$('#msg').html("ȡ��ʧ��");
				}
				},
			error : function(res,msg,err) {alert(msg);}
		});
}
</script>
{/literal}