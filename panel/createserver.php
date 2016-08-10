<div id="wrapper">
    <div id="header"><?php include('./header.php'); ?></div>
    <div id="nav">
	<ul>
  <li><a href="panel.php?p=home">Home</a></li>
     <li><a class="active" href="panel.php?p=createserver">Create Server</a></li>
  <li><a href="panel.php?p=settings">Settings</a></li>
  <li><a href="panel.php?p=pkeys">Privilege keys</a></li>
  <li><a href="panel.php?p=reset">Perm reset</a></li>
  <li><a href="panel.php?p=clientlist">Clientlist</a></li>
   <li><a href="panel.php?p=clientinfo">Clientinfo</a></li>
</ul>
	</div>
    <div id="content" style="margin-left:10%;padding:1px 16px;height:100px;">
	<br/><h2>Create new virtual server!</h2><br/>
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
echo "<form method='post'><br/>
		Name of server: <input type='text' class='form-control' name='name' required><br/>
		Max clients: <input type='number' min='1' class='form-control' name='slots' required><br/>
		Port: <input type='number' min='1' class='form-control' name='port' required><br/>
<input type='submit' class='btn btn-info' value='Create!' name='create_server'></select></form><br/>";

if(isset($_POST['create_server']))
{
$name = $_POST['name'];
$port = $_POST['port'];
$serverid = $ts3->serverCreate(array("virtualserver_name" => "$name","virtualserver_maxclients" => $_POST['slots'],"virtualserver_port" => $port));
echo "Your server has been automatically created! Now go ahead select the server and edit the settings.";
}















?>