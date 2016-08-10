 <div class="jumbotron">
          <span class="text-center"><br>
		  <?php
session_start(); $username = $password = $userError = $passError = '';
if(isset($_POST['sub'])){
  $username = $_POST['username']; $password = $_POST['password'];
  if($username === 'admin' && $password === 'password'){
    $_SESSION['login'] = true; header('LOCATION:install.php'); die();
  }
  if($username !== 'admin')$userError = 'Invalid Username';
  if($password !== 'password')$passError = 'Invalid Password';
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
    <label for='username'></label><input type='text' value='$username' id='username' name='username' />
    <div class='error'>$userError</div>
    <label for='password'></label><input type='password' value='$password' id='password' name='password' />
    <div class='error'>$passError</div>
    <input type='submit' value='Login' name='sub' />
  </form>
  <script type='text/javascript' src='common.js'></script>
</body>
</html>";
?>