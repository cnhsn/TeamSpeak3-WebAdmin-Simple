<div id="wrapper">
    <div id="header"><?php include('./header.php'); ?></div>
    <div id="nav">
	<ul>
  <li><a class="active" href="panel.php?p=home">Home</a></li>
      <li><a href="panel.php?p=createserver">Create Server</a></li>
  <li><a href="panel.php?p=settings">Settings</a></li>
  <li><a href="panel.php?p=pkeys">Privilege keys</a></li>
  <li><a href="panel.php?p=reset">Perm reset</a></li>
    <li><a href="panel.php?p=clientlist">Clientlist</a></li>
	   <li><a href="panel.php?p=clientinfo">Clientinfo</a></li>
</ul>
	</div>
    <div id="content" style="margin-left:10%;padding:1px 16px;height:50px;">
	<br/><h2>Basic info about your server!</h2><br/>
<?php 
if(isset($_GET['selserver']))
{
$checker = true;
$id = $_GET['selserver'];
$ts3_VirtualServer = $ts3->serverGetById($id);
$ts3_VirtualServer->selfUpdate(array('client_nickname'=>"Web Manager"));
$_SESSION['server'] = serialize($ts3_VirtualServer);
}

if(!isset($_SESSION["server"]))
{
	echo "<div class='alert alert-danger'>Please select a server by clicking on it's id before you proceed!</div>";
}

  echo "<div>
  <table class=\"table table-bordered table-condensed table-responsive \">
  <thead>
  <tr>
  <th class='text-center'>Status</th>
  <th class='text-center'>Name</th>
  <th class='text-center'>Address</th>
  <th class='text-center'>Slots</th>
  <th class='text-center'>Server ID	</th>
  </tr>
  </thead>
  <tbody>";
foreach($ts3 as $ts3_VS)
{
$name = $ts3_VS->virtualserver_name;
$slots = $ts3_VS->getProperty("virtualserver_clientsonline") - $ts3_VS->getProperty("virtualserver_queryclientsonline") . "/" . $ts3_VS->virtualserver_maxclients;
$ip = $ts3_VS->getAdapterHost() .":" . $ts3_VS->virtualserver_port;
$id = $ts3_VS->serverIdGetByPort($ts3_VS->virtualserver_port);
echo "
   <tr bgcolor='white'>
  <td class='text-center' style=\"color:#00C900;\">Online</td>
  <td class='text-center'>$name</td>
  <td class='text-center'><a href=ts3server://$ip>$ip</a></td>
  <td class='text-center'>$slots</td>
  <td class='text-center'><a href='panel.php?p=home&selserver=$id'>$id</a></td>
  </tr>";
}





























?>