<div id="content">
<link href="./javascript/jquery-ui/jquery.ui.all.css" rel="stylesheet" type="text/css" />
<script src="./javascript/jcart.js" type="text/javascript"></script>
<script src="./javascript/jquery-ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="./javascript/jquery-ui/jquery.ui.widget.js" type="text/javascript"></script>
<script src="./javascript/jquery-ui/jquery.ui.accordion.js"  type="text/javascript"></script>
{literal}
<script>
	$(function() {
		$( ".accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});
</script>
{/literal}
<link href="./jcart/jcart.css" rel="stylesheet" type="text/css" />
<link href="css/showcart.css" rel="stylesheet" type="text/css" />
<div style="float:left; width:958px; border-bottom:1px solid #ffccff; border-left:1px solid #ffccff; border-right:1px solid #ffccff">
��ǰλ��:{$district} > {$build} > {$shopname}
</div>
<div style="float:left;width:960px; height:200px; background-color:#F0F8FF">
  <div class="content">
    <div style="width:158px;float:left; margin-top:40px; margin-left:40px">
      <!--����ͼƬ��ʼ-->
      <div class="ct_bigpic">
        <img src=".{$shopimage}" width="151" height="121" />
      </div>
      <!--����ͼƬ����-->
    </div>
    <div style="padding-top:10px; margin-left:210px">
      <!--������Ϣ��ʼ-->
      <div style="float:right;margin-top:5px; margin-right:15px">
        {if $mark==1}
        <xn:share-button type="button" label="��������"></xn:share-button>
		{/if}
      </div>
      <ul class="ct_info">
        <li style="padding-top:0px;padding-bottom:5px; list-style:none;">
          <strong>
		  {$shopname}&nbsp;&nbsp;<strong>{$price}������</strong>
          </strong>
        </li>
        <li style="list-style:none;">
          �����:{$shopintro} 
        </li>
        <li class="footer_info" style="list-style:none;">
          ��������:{$shoptel}
        </li>
        <li class="footer_info" style="padding-top:3px; list-style:none;">
          ��ַ:{$shopadd} 
        </li>
        <li style="list-style:none;">
          {$beizhu}  
        </li>
        <li style="list-style:none;">
          {$shopyh}&nbsp;&nbsp;{$yhtime}
        </li>
      </ul>
    </div>
    <!--������Ϣ����-->
  </div>
  <!--������Ϣ����-->
</div>
<div style="width:590px; float:left;">
{section name=tag loop=$shops}

<div style="background-color:#fff;border:1px solid #FF99FF;color:#FF6300;padding-top:5px;padding-bottom:5px; margin-bottom:10px;margin-top:10px;width:100%;clear:both;height:20px;">
<div  style="float:left;"><font color='#000'>{$shops[tag].typename}</font></div>
<div><a  href="javascript:window.scroll(0,0);" style="float:right">����</a></div>
</div>

<div class="accordion">
    {section name=tg loop=$dinners[tag]}
	<h3><a href="#section1">{$dinners[tag][tg].dinname}</a></h3>
	<div>
    <form method="post" action="" class="jcart" style="margin:0px;padding:0px">
    <input type="hidden" name="my-item-shop"  value="{$dinners[tag][tg].shopid}" />
    <input type="hidden" name="my-item-id"    value="{$dinners[tag][tg].dinid}" />
    <input type="hidden" name="my-item-name"  value="{$dinners[tag][tg].dinname}" />
    <input type="hidden" name="my-item-price" value="{$dinners[tag][tg].dinprice}" />
    <input type="hidden" name="my-item-qty"   value="1" size="3" />
    <table border="0">
    <tr><td rowspan="2">{if $dinners[tag][tg].dinimage}<img src=".{$dinners[tag][tg].dinimage}" height="200px" width="150px"/>{/if}</td><td>{$dinners[tag][tg].intro}</td></tr>
    <tr><td>����{$dinners[tag][tg].dinprice}{if $dinners[tag][tg].isellout==1}<input type='submit' name='my-add-button' value="��һ��"/>{else}������{/if}</td></tr>
    </table></form>
	</div>
    {/section}
</div>
{/section}
</div>
</div>