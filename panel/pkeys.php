<div id="wrapper">
    <div id="header"><?php include('./header.php'); ?></div>
    <div id="nav">
	<ul>
  <li><a href="panel.php?p=home">Home</a></li>
      <li><a href="panel.php?p=createserver">Create Server</a></li>
  <li><a href="panel.php?p=settings">Settings</a></li>
  <li><a class="active" href="panel.php?p=pkeys">Privilege keys</a></li>
  <li><a href="panel.php?p=reset">Perm reset</a></li>
    <li><a href="panel.php?p=clientlist">Clientlist</a></li>
	   <li><a href="panel.php?p=clientinfo">Clientinfo</a></li>
</ul>
	</div>
	    <div id="content" style="margin-left:10%;padding:1px 16px;height:50px;"><br/>
<?php
	if(isset($_SESSION["server"])){
	$ts3_VirtualServer = unserialize($_SESSION["server"]);}
	else {echo'<meta http-equiv="refresh" content="0;url=panel.php">';}
$groups = $ts3_VirtualServer->serverGroupList();
$count = 0;
$key = '';
if (isset($_POST['generatekey'])){
$id = $_POST['groupa'];
$groupy=$ts3_VirtualServer->serverGroupGetByName($id);
$key = $groupy->privilegeKeyCreate();

}
echo "
<form action='panel.php?p=pkeys' method='post'>
<select name='groupa' class='form-control' >";
foreach ($groups as $group)
{
	if($group->type != 1) { continue; }
	if($group == "Guest") { continue; }
	$uid = $group->getUniqueId();
	echo"<option name='$group' value='$group'>$group</option>";
}
echo"<br/><br/><br/><input type='submit' class='form-control' value='Generate key' name='generatekey'></select></form><br/>";
echo $key;
?>