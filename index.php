<?php session_start(); ?>
<!DOCTYPE html>
<html lang="cz"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><base href="."><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TS3 PANEL</title>
    <meta charset="utf-8"/>
    <!-- Bootstrap -->
    <link href="index_files/bootstrap.min.css" rel="stylesheet">
    
    <!-- Core -->
    <link rel="stylesheet" href="./index_files/core.css">
  <link id="smartlook-style" rel="stylesheet" media="screen">

</head>
<body>
 <div class="jumbotron">
          <span class="text-center"><br>
		 <?php
		 $_SESSION = array(); $username = $password = $userError = $passError = '';
if(file_exists('config.php'))
{
if(isset($_POST['sub'])){
  $username = $_POST['username']; $password = $_POST['password'];
include('config.php');
  if($username !== $user) $passError = 'Invalid Username or Password';
  if($password !== $pass)$passError = 'Invalid Username or Password';
  if($username === $user && $password === $pass){
  $_SESSION['login'] = true;

  if(file_exists("config.php")){
  require_once("libraries/TeamSpeak3/TeamSpeak3.php");
  include('config.php');
  try{$ts3 = TeamSpeak3::factory("$logindetails"); header('LOCATION:panel.php');} 
  catch(Exception $e) {echo "Your login details have changed or your server is offline! Please try again. <br/>Error message: " . $e->getMessage();}}                          else{header('LOCATION:install.php'); die();}
  }

}
echo "<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
   <head>
     <meta http-equiv='content-type' content='text/html;charset=utf-8' />
     <title>Login</title>
     <style type='text.css'>
       @import common.css;
     </style>
   </head>
<body>
  <form name='input' action='{$_SERVER['PHP_SELF']}' method='post'>
    Username: <label for='username'></label><input type='text' value='$username' id='username' name='username' /><br/><br/>	
    Password: <label for='password'></label><input type='password' value='$password' id='password' name='password' /><br/>

    <br/>	<input type='submit' value='Login' name='sub' /><br/><br/>
	    <div class='error'>$passError</div><br/>
  </form>
  <script type='text/javascript' src='common.js'></script>
</body>
</html>";
}
else
{
echo '<meta http-equiv="refresh" content="0;url=install.php">';
}
?>
<br></br>
</body></html>
