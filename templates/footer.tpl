</div>
<!--footer�㿪ʼ-->
<div class="footer">
<div style="width:960px;border-bottom:1px dotted #e7e7e7; margin:0 auto; height:50px; margin-top:10px">
<font style="color:#F30">��������</font><br>
<ul>
<li>
<a href="http://kaiyuan.welwm.com/" target="_new">�Ҷ���</a>
</li>
<li>
<a href="http://www.zan0421.com/" target="_new">������Ϣ��</a>
</li>
<li>
<a href="http://www.youku.com" target="_new">�ſ�</a>
</li>
<li>
<a href="http://www.aifangxin.com" target="_new">������</a>
</li>
</ul>
</div>
<ul style="width:960px; margin:0 auto">
<li><a href="./contact_us.php">��ϵ����</a> |</li>
<li><a href="./privacy.php">��˽��ȫ</a> |</li>
<li><a href="./agreement.php">��������</a> |</li>
<li><a href="./wanted.php">��ƸӢ��</a> |</li>
<li><a href="./bbs.php">����</a></li>
<li style="float:right">&copy;2010 - 2012 �Ҷ��� ��ICP��10045625</li>
<ul>
</div>
  <!--footer�����-->
  <!--container�����-->
{literal}
	<script type="text/javascript">
	addEventListener = function(element, type, handler) {
	  if (element.addEventListener) {
		element.addEventListener(type, handler, false);
	  } else if (element.attachEvent){
		handler._ieEventHandler = function () {
		  handler(window.event);
		};
		(element).attachEvent("on" + type, (handler._ieEventHandler));
	  }
	}
	</script>
{/literal}
{if $mark==1}
{literal}
	<script type="text/javascript">
    XN_RequireFeatures(["EXNML"], function()
    {
      XN.Main.init("fa0dc1c1d2624a9585910fc454a8c809", "/xd_receiver.html");
	  addEventListener(document.getElementById("feed_link"), "click", function() {
        XN.Connect.requireSession(sendFeed);
      });
    });
  </script>
	{/literal}
{else}
{literal}
 <script type="text/javascript">
    XN_RequireFeatures(["EXNML"], function()
    {
      XN.Main.init("fa0dc1c1d2624a9585910fc454a8c809", "/xd_receiver.html",{"ifUserConnected":"renrencookie.php"});
	  addEventListener(document.getElementById("feed_link"), "click", function() {
        XN.Connect.requireSession(sendFeed);
      });
    });
  </script>
{/literal}
{/if}
</body>
</html>