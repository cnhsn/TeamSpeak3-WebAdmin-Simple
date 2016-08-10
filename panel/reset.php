<div id="wrapper">
    <div id="header"><?php include('./header.php'); ?></div>
    <div id="nav">
	<ul>
  <li><a href="panel.php?p=home">Home</a></li>
      <li><a href="panel.php?p=createserver">Create Server</a></li>
  <li><a href="panel.php?p=settings">Settings</a></li>
  <li><a href="panel.php?p=pkeys">Privilege keys</a></li>
  <li><a class="active" href="panel.php?p=reset">Perm reset</a></li>
    <li><a href="panel.php?p=clientlist">Clientlist</a></li>
	   <li><a href="panel.php?p=clientinfo">Clientinfo</a></li>
</ul>
	</div>
	    <div id="content" style="margin-left:10%;padding:1px 16px;height:50px;"><br/>
			<style>
	input {
    width: 10%;
}
input[type=submit] {
    width: 20em;  height: 3em;
}
	</style>
<?php
	if(isset($_SESSION["server"])){
	$ts3_VirtualServer = unserialize($_SESSION["server"]);}
	else {echo'<meta http-equiv="refresh" content="0;url=panel.php">';}
$pkey='';
$text="<form action='panel.php?p=reset' method='post'><br/><br/><br/><input type='submit' class='btn btn-warning' value='Reset permissions!' name='permreset' width='50'></select></form><br/>";
if (isset($_POST['permresetconfirm'])){
$pkey = $ts3_VirtualServer->permReset();
}

if (isset($_POST['permreset'])){
$text='';
$text2="<form action='panel.php?p=reset' method='post'><br/><br/><br/><input type='submit' class='btn btn-danger' value='Are you sure?' name='permresetconfirm'></select></form><br/>";
echo $text2;
}
echo $text;
echo $pkey;
?>