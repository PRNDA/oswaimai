<?php
$sn1 = $_GET['sn1'];
if(!empty($sn1)&&$sn1!='')
{
	$print="<custid>0</custid><phead>��������</phead><ptimes>1</ptimes><pfree>25</pfree><pend>��������</pend>";
}
else{
    $print="<error></error>";
}
echo $print;
?>