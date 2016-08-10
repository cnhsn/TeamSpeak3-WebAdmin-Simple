<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>TS3 PANEL</title>
  <style>
    body, html {
        padding : 0px;
        margin : 0px;
        width : 100%;
    } 

    #wrapper {
        height:100%;
        margin: 0px;
        padding: 0px;
    }

    #header {
        height:10%;
        background-color:#930;
        width:100%;
    }

    #nav {
        background-color:#999;
        width:100px;
        height:90%;
        float:left;
    }

    #content {
        height:70%;
        width:70%;
    }
	ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 10%;
    background-color: #f1f1f1;
    position: fixed;
    height: 100%;
    overflow: auto;
}

li a {
    display: block;
    color: #000;
    padding: 8px 0 8px 16px;
    text-decoration: none;
}

li a.active {
    background-color: #4CAF50;
    color: white;
}

li a:hover:not(.active) {
    background-color: #555;
    color: white;
}
#header div.absolute {
    position: absolute;
    top: bottom;
    right: 0px;
    width: 75px;
    height: 25px;
    border: 2px solid black;
	background-color: yellow;
}
#logout div.absolute {
    position: absolute;
    top: 30px;
    right: 50px;
    width: 25px;
    height: 35px;
    border: 2px solid black;
	background-color: blue;
}

  </style>
    <link href="./index_files/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<?php 
session_start();
if($_SESSION["login"] != "true")
{
	$_SESSION = array();
	session_destroy();
	echo'<meta http-equiv="refresh" content="0;url=index.php">';
}
else
{
require_once("libraries/TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
$ts3 = TeamSpeak3::factory("$logindetails");
}	
if (isset($_GET['p']))
							$p = $_GET['p'];
						else
							$p = 'home';
						if (preg_match('/^[a-z0-9]+$/', $p))
						{
							$vlozeno = include('panel/' . $p . '.php');
							if (!$vlozeno)
							{include('errors/404s.php');}
						}
?>

</body>
</html>