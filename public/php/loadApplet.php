<?php
echo "
<HTML>
<HEAD>
	<TITLE>HNA</TITLE>
	<script language='Javascript'></script>   
</HEAD>
<BODY>
	<P><APPLET width='20' height='20' MAYSCRIPT code='applethnajs.deploy_HNA' archive='libs/huellas/AppletHNAjs.jar'><PARAM NAME='Nip' VALUE='".$_GET['Nip']."'></APPLET></P>
</BODY>
</HTML>";
?>