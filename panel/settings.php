<div id="wrapper">
    <div id="header"><?php include('./header.php'); ?></div>
    <div id="nav">
	<ul>
  <li><a href="panel.php?p=home">Home</a></li>
      <li><a href="panel.php?p=createserver">Create Server</a></li>
  <li><a class="active" href="panel.php?p=settings">Settings</a></li>
  <li><a href="panel.php?p=pkeys">Privilege keys</a></li>
  <li><a href="panel.php?p=reset">Perm reset</a></li>
    <li><a href="panel.php?p=clientlist">Clientlist</a></li>
	   <li><a href="panel.php?p=clientinfo">Clientinfo</a></li>
</ul>
	</div>
	<style>
	input {
    width: 100%;
}
	</style>
	<?php
	if(isset($_SESSION["server"])){
	$ts3_VirtualServer = unserialize($_SESSION["server"]);}
	else {echo'<meta http-equiv="refresh" content="0;url=panel.php">';}
	$ts3_VirtualServer->selfUpdate(array('client_nickname'=>"Web Manager"));
	$zero = $one = $two = $three = '';
if (isset($_POST['edit'])){
	$name = $_POST['nameofserver'];
    $welcomemessage = $_POST['welcomemessage'];
	$slots = $_POST['slotsofserver'];
	$reservedslots = $_POST['reservedslots'];
	$securitylevel = $_POST['securitylevel'];
	$gfximgurl = $_POST['gfximgurl'];
	$gfxurl = $_POST['gfxurl'];
	$hostmessage = $_POST['hostmessage'];
	$hostmode = $_POST['hostmode'];
	$hbt = $_POST['hbt'];
	$hbimg = $_POST['hbimg'];
	$hburl = $_POST['hburl'];

$edit = array("virtualserver_maxclients=$slots","virtualserver_welcomemessage=$welcomemessage","virtualserver_reserved_slots=$reservedslots","virtualserver_name=$name",
"virtualserver_needed_identity_security_level=$securitylevel","virtualserver_hostbanner_gfx_url=$gfximgurl",
"virtualserver_hostbanner_url=$gfxurl","virtualserver_hostmessage=$hostmessage","virtualserver_hostmessage_mode=$hostmode",
"virtualserver_hostbutton_tooltip=$hbt","virtualserver_hostbutton_gfx_url=$hbimg","virtualserver_hostbutton_url=$hburl");
$ts3_VirtualServer->modify($edit);
}
	$name = $ts3_VirtualServer->virtualserver_name;
	$slots = $ts3_VirtualServer->virtualserver_maxclients;
	$reservedslots = $ts3_VirtualServer->virtualserver_reserved_slots;
	$welcomemessage = $ts3_VirtualServer->virtualserver_welcomemessage;
	$securitylevel = $ts3_VirtualServer->virtualserver_needed_identity_security_level;
	$gfximgurl = $ts3_VirtualServer->virtualserver_hostbanner_gfx_url;
	$gfxurl = $ts3_VirtualServer->virtualserver_hostbanner_url;
	$hostmessage = $ts3_VirtualServer->virtualserver_hostmessage;
    $hostmode = $ts3_VirtualServer->virtualserver_hostmessage_mode;
    $hbt = $ts3_VirtualServer->virtualserver_hostbutton_tooltip;
    $hbimg = $ts3_VirtualServer->virtualserver_hostbutton_gfx_url;
	$hburl = $ts3_VirtualServer->virtualserver_hostbutton_url;
	
	if($hostmode == 0) $zero="selected=''";
	if($hostmode == 1) $one="selected=''";
	if($hostmode == 2) $two="selected=''";
	if($hostmode == 3) $three="selected=''";
	
	?>
    <div id="content" style="margin-left:10%;padding:1px 16px;height:50px;"><br/>

<form action="panel.php?p=settings" method="post">
Name: <input type="text" class="form-control" name="nameofserver" value="<?php echo $name; ?>">
Slots: <input type="number" class="form-control" min="1" max="512"name="slotsofserver" value="<?php echo $slots; ?>">
Reserved slots: <input type="number" class="form-control" min="0" max="100"name="reservedslots" value="<?php echo $reservedslots; ?>">
Welcome message: <input type="text" class="form-control" name="welcomemessage" maxlength="1024" value="<?php echo $welcomemessage; ?>">
Needed security level: <input type="number" class="form-control" min="0" max="44"name="securitylevel" value="<?php echo $securitylevel; ?>">
GFX img (Host banner) URL: <input type="text" class="form-control" name="gfximgurl"value="<?php echo $gfximgurl; ?>">
<img src='<?php echo $gfximgurl;?>'/></br>
GFX (Host banner) URL: <input type="text" class="form-control" name="gfxurl" maxlength="1024" value="<?php echo $gfxurl; ?>">
Host message: <input type="text" class="form-control" name="hostmessage" maxlength="200" value="<?php echo $hostmessage; ?>">
Host message mode:<br/><select class="form-control" name="hostmode">
<option name='0' value='0' <?php echo $zero;?>>No message</option>
<option name='1' value='1' <?php echo $one;?>>Show message in log</option>
<option name='2' value='2' <?php echo $two;?>>Show modal message</option>
<option name='3' value='3' <?php echo $three;?>>Modal message and exit</option>
</select>
<br/>
Hostbutton Text: <input type="text" class="form-control" name="hbt" maxlength="200" value="<?php echo $hbt; ?>">
Hostbutton IMG Url: <input type="text" class="form-control" name="hbimg" maxlength="200" value="<?php echo $hbimg; ?>">
Hostbutton Url: <input type="text" class="form-control" name="hburl" maxlength="200" value="<?php echo $hburl; ?>">

<input type="submit" value="Edit" name="edit">
</form><br/>
