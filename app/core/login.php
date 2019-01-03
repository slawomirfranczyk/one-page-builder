<?php
/* DECLARE VARIABLES */
$username = 'admin';
$password = 'admin';
$random1 = '$2,hD7Sfi';
$random2 = 's$df.23';
$hash = md5($random1 . $password . $random2);
//$self = $_SERVER['REQUEST_URI'];

/* USER LOGOUT */
if(isset($_GET['logout']))
	Logout(); //funkcje.php
	
/* USER IS LOGGED IN */
if (isset($_SESSION['login']) && $_SESSION['login'] == $hash)
{
	logged_in_msg($username);
}
/* FORM HAS BEEN SUBMITTED */
else if (isset($_POST['submit']))
{
	if ($_POST['username'] == $username && $_POST['password'] == $password)
	{
		$_SESSION["login"] = $hash;
		$_SESSION["username"] = $username;
		header("Location: .");
	}
	else
	{
		// DISPLAY FORM WITH ERROR
		display_login_form();
		display_error_msg();
	}
}
/* SHOW THE LOGIN FORM */
else
{
	display_login_form();
}