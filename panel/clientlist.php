<div id="wrapper">
    <div id="header"><?php include('./header.php'); ?></div>
    <div id="nav">
	<ul>
  <li><a href="panel.php?p=home">Home</a></li>
      <li><a href="panel.php?p=createserver">Create Server</a></li>
  <li><a href="panel.php?p=settings">Settings</a></li>
  <li><a href="panel.php?p=pkeys">Privilege keys</a></li>
  <li><a href="panel.php?p=reset">Perm reset</a></li>
  <li><a class="active" href="panel.php?p=clientlist">Clientlist</a></li>
   <li><a href="panel.php?p=clientinfo">Clientinfo</a></li>
</ul>
	</div>
    <div id="content" style="margin-left:10%;padding:1px 16px;height:50px;">
	<br/><h2>List of all connected clients.</h2><br/>
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
$ban = $error ='';

if(!isset($_GET['ban'])){
header("Refresh: 5; URL='panel.php?p=clientlist'");}
function erroridtotext($code,$message)
{
	if($code == 770)
	{
		return "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>User is already in default channel!</div>";
	}
	else if($code == 2568)
	{
		return "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Insufficient permissions! Failed on <b>i_client_needed_kick_from_server_power</b></div>";
	}
	else if($code == 512)
	{
		return "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Invalid client UID!</div>";
	}
	else
	{
		return"$message";
	}
}
$ts3_VirtualServer->clientListReset();

echo "<div>
  <table class=\"table table-bordered table-condensed table-responsive \">
  <thead>
  <tr>
  <th class='text-center'>Name</th>
  <th class='text-center'>UID</th>
  <th class='text-center'>DbID</th>
  <th class='text-center'>Kick from Channel</th>
  <th class='text-center'>Kick from Server</th>
  <th class='text-center'>Ban client</th>
  </tr>
  </thead>
  <tbody>";
 foreach($ts3_VirtualServer->clientList() as $ts3_Client){
 if($ts3_Client["client_type"]) continue;
 $dbinfo = $ts3_Client->infoDb();
 $cluid = $dbinfo['client_unique_identifier'];
 $cldb = $dbinfo['client_database_id'];
  echo"
   <tr bgcolor='white'>
  <td class='text-center'><a href='panel.php?p=clientinfo&client=$cldb'>$ts3_Client</a></td>
  <td class='text-center'>$cluid</td>
    <td class='text-center'>$cldb</td>
  <td class='text-center'><a href='panel.php?p=clientlist&kickc=$cldb'>Click me</a></td>
  <td class='text-center'><a href='panel.php?p=clientlist&kicks=$cldb'>Click me</a></td>
  <td class='text-center'><a href='panel.php?p=clientlist&ban=$cldb'>Banhammer!</a></td>
  </tr>";	
 }
    if (isset($_GET['kickc']))
    {
		try{
		$ts3_VirtualServer->clientGetByDbid($_GET['kickc'])->kick(TeamSpeak3::KICK_CHANNEL);header("Refresh: 0; URL='panel.php?p=clientlist'");}
		catch (exception $e){/*header("Refresh: 0; URL='panel.php?p=clientlist'");*/ echo erroridtotext($e->getCode(),$e->getMessage());}
	}
	if (isset($_GET['kicks']))
    {
		try{
		$ts3_VirtualServer->clientGetByDbid($_GET['kicks'])->kick(TeamSpeak3::KICK_SERVER);header("Refresh: 0; URL='panel.php?p=clientlist'");}
		catch (exception $e){/*header("Refresh: 0; URL='panel.php?p=clientlist'");*/ echo erroridtotext($e->getCode(),$e->getMessage());sleep(1);}
	}
    if (isset($_GET['ban']))
    {
		try{
		$selectedclient = $ts3_VirtualServer->clientGetByDbid($_GET['ban']);
		echo "<div id='ban'><center>You are about to ban <b>$selectedclient</b><span style='float:right'><a href='panel.php?p=clientlist'>&#x2715</a></span><br/>
		<form method='post'><br/>
		Reason <input type='text' class='form-control' name='reason'>
		Length <input type='number' min='0' max='50000' class='form-control' name='lenght'><select name='type'>
        <option value='minutes'>Minutes</option>
        <option value='hours'>Hours</option>
        </select><br/>
		<input type='submit' class='btn btn-danger' value='Ban!' name='banbutton'></select></form><br/>
		
		</div>";
		if (isset($_POST['banbutton']))
	    {
			$type = $_POST['type'];
			$banlenght = $_POST['lenght'];
			$reason = $_POST['reason'];
			if($type == "minutes") { $selectedclient->ban($banlenght * 60,$reason);}
            else if ($type == "hours") { $selectedclient->ban($banlenght * 3600,$reason);}
			//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=panel.php?p=clientlist">';
	    }

		}
		catch (exception $e){echo erroridtotext($e->getCode(),$e->getMessage());}
	}

	echo $error;




















?>