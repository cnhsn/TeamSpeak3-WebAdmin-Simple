<?php session_start(); ?>
 <html lang="cz"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><base href="."><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CONTROL PANEL INSTALLER</title>
    <meta charset="utf-8"/>
    <!-- Bootstrap -->
    <link href="./index_files/bootstrap.min.css" rel="stylesheet">
    
    <!-- Core -->
    <link rel="stylesheet" href="./index_files/core.css">
  <link id="smartlook-style" rel="stylesheet" media="screen">

</head>
<body>
 <div class="jumbotron">
          <span class="text-center"><br><b>Please enter your serveradmin query login details</b><br/><br/>
<style>
form { margin: 0 auto; }
		  </style>
<?php $username = $password = $userError = $passError = $qip = $qport = $sport ='';
if(isset($_POST['sub'])){
require_once("libraries/TeamSpeak3/TeamSpeak3.php");
  $username = $_POST['username']; $password = $_POST['password']; $qip= $_POST['qip']; $qport = $_POST['qport'];$user = $_POST['user']; $pass= $_POST['pass'];
  try{
  $ts3_VirtualServer = TeamSpeak3::factory("serverquery://$username:$password@$qip:$qport/");
   $myfile = fopen("config.php", "w") or die("Unable to open file!");
  $txt = ('<?php $user = '."'$user';" .'$pass'." = 	'$pass';".' $logindetails = ' . "'serverquery://$username:$password@$qip:$qport/'; ?>");
  fwrite($myfile,$txt);
  fclose();
  echo"<div class='alert alert-success'>
  <strong>Success!</strong> Successfuly registered.
</div>
          <script type='text/javascript'>
            window.location.href = 'index.php'
        </script>";
	echo'<meta http-equiv="refresh" content="0;url=index.php">';
  }
  catch(Exception $e)
  {
	  echo "Failed to connect to the server! Please correct your login details!";
  }
}
echo "
  <form name='input' action='{$_SERVER['PHP_SELF']}' method='post'>
    Username:  <label for='username'></label><input type='text' value='serveradmin' id='username' name='username' /><br/><br/>
    Password:  <label for='username'></label><input type='password' value='$password' id='password' name='password' /><br/><br/>
	IP: <label for='qip'></label><input type='text' value='$qip' id='qip' name='qip' /><br/><br/>
    Query port: <label for='qport'></label><input type='text' value='10011' id='qport' name='qport' /><br/><br/>
	<hr>
	ADMIN LOGIN: <label for='user'></label><input type='text' value='$user' id='user' name='user' /><br/><br/>
	ADMIN PASSWORD:<label for='pass'></label><input type='password' value='$pass' id='pass' name='pass' /><br/><br/>
    <input type='submit' value='Login' name='sub' />
  </form>
";


?>	 </div></body>
</html>