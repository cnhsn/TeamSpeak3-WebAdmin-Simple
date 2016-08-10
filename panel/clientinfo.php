<div id="wrapper">
    <div id="header"><?php include('./header.php'); ?></div>
    <div id="nav">
	<ul>
  <li><a href="panel.php?p=home">Home</a></li>
  <li><a href="panel.php?p=createserver">Create Server</a></li>
  <li><a href="panel.php?p=settings">Settings</a></li>
  <li><a href="panel.php?p=pkeys">Privilege keys</a></li>
  <li><a href="panel.php?p=reset">Perm reset</a></li>
  <li><a href="panel.php?p=clientlist">Clientlist</a></li>
   <li><a class="active" href="panel.php?p=clientinfo">Clientinfo</a></li>
</ul>
	</div>
    <div id="content" style="margin-left:10%;padding:1px 16px;height:100px;">
	<br/><h2>Info about connected client</h2><br/>
	<style>
	a:link a:visited { text-decoration: none}
	#ban {
    position: absolute;
    top: 40%;
    right: 40%;
    width: 500px;
    height: 230px;
    border: 2px solid black;
	background-color: white;
}
	</style>
<?php 
	if(isset($_SESSION["server"])){
	$ts3_VirtualServer = unserialize($_SESSION["server"]);}
	else {echo'<meta http-equiv="refresh" content="0;url=panel.php">';}
$ts3_VirtualServer->selfUpdate(array('client_nickname'=>"Web Manager"));
$ban = $error = $client = '';
echo "<form method='post'><br/>
		Name / DbID / UID: <input type='text' class='form-control' name='findclient'><br/>
		<select class='form-control' name='type'>
<option name='name' value='name'>Name</option>
<option name='dbid' value='dbid'>Database ID</option>
<option name='uid' value='uid'>Unique ID</option>
</select><br/>
		<input type='submit' class='btn btn-danger' value='Search' name='search'></select></form><br/>";
if(isset($_POST['search']))
{

 $input = $_POST['findclient'];
 $type = $_POST['type'];
 if($type == "name")
 {
	try{$client = $ts3_VirtualServer->clientGetByName($input);}catch(exception $e) {$error = $e->getMessage();echo "<div class='alert alert-danger'>$error</div>";}
 }
 else if($type == "dbid")
 {
	try{$client = $ts3_VirtualServer->clientGetByDbid($input);}catch(exception $e) {$error = $e->getMessage();echo "<div class='alert alert-danger'>$error</div>";}
 }
 else if($type == "uid")
 {
	 try{$client = $ts3_VirtualServer->clientGetByUid($input);}catch(exception $e) {$error = $e->getMessage();echo "<div class='alert alert-danger'>$error</div>";}
 }
 else{ echo "Unknown type: ".$type;}



 if($client != ''){
 $dbinfo = $client->infoDb();
 $dbid = $dbinfo['client_database_id'];
 $uid = $dbinfo['client_unique_identifier'];
 $firstconnected = gmdate("Y-m-d\ H:i:s\ ",$dbinfo['client_created']);
 $lastconnect = gmdate("Y-m-d\ H:i:s\ ",$dbinfo['client_lastconnected']);
 $connections = $dbinfo['client_totalconnections'];
 $ipaddress = $dbinfo['client_lastip'];
 echo "<hr><div>
  <table class=\"table table-bordered table-condensed table-responsive \">
  <thead>
  <tr>
  <th class='text-center'>Name</th>
  <th class='text-center'>Database ID</th>
  <th class='text-center'>Unique ID</th>
  <th class='text-center'>First connected</th>
  <th class='text-center'>Last connect</th>
  <th class='text-center'>Connections</th>
  <th class='text-center'>IP Address</th>
  </tr>
  </thead>
  <tbody>
  <tr bgcolor='white'>
  <td class='text-center'>$client</td>
  <td class='text-center'>$dbid</td>
  <td class='text-center'>$uid</td>
  <td class='text-center'>$firstconnected</td>
  <td class='text-center'>$lastconnect</td>
  <td class='text-center'>$connections</td>
  <td class='text-center'>$ipaddress</td>
  </tr>";
}
 }
if(isset($_GET['client']))
{
	try{$client = $ts3_VirtualServer->clientGetByDbid($_GET['client']);}catch(exception $e) {$error = $e->getMessage();echo "<div class='alert alert-danger'>$error</div>";}
	$dbinfo = $client->infoDb();
 $dbid = $dbinfo['client_database_id'];
 $uid = $dbinfo['client_unique_identifier'];
 $firstconnected = gmdate("Y-m-d\ H:i:s\ ",$dbinfo['client_created']);
 $lastconnect = gmdate("Y-m-d\ H:i:s\ ",$dbinfo['client_lastconnected']);
 $connections = $dbinfo['client_totalconnections'];
 $ipaddress = $dbinfo['client_lastip'];
 echo "<hr><div>
  <table class=\"table table-bordered table-condensed table-responsive \">
  <thead>
  <tr>
  <th class='text-center'>Name</th>
  <th class='text-center'>Database ID</th>
  <th class='text-center'>Unique ID</th>
  <th class='text-center'>First connected</th>
  <th class='text-center'>Last connect</th>
  <th class='text-center'>Connections</th>
  <th class='text-center'>IP Address</th>
  </tr>
  </thead>
  <tbody>
  <tr bgcolor='white'>
  <td class='text-center'>$client</td>
  <td class='text-center'>$dbid</td>
  <td class='text-center'>$uid</td>
  <td class='text-center'>$firstconnected</td>
  <td class='text-center'>$lastconnect</td>
  <td class='text-center'>$connections</td>
  <td class='text-center'>$ipaddress</td>
  </tr>";
}


















?>