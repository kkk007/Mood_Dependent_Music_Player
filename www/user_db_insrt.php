<html>
<head>


</head>
<body>

<?php

session_start();
// store session data
$pass = $_POST["Pass"];
$_SESSION['exist'] = "";
$_SESSION['username'] = $_POST['fname'];
//$_SESSION['chk']=0;
//$_SESSION['f']=0;
$my = $_SESSION['username'];
if($_POST['fname']==NULL || $_POST['Pass']==NULL)
{
$_SESSION['exist'] = '*Error* Field left empty ';
header("location:register.php");
}
         
	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		
		$_SESSION['exist'] = '*Error* The captcha code does not match! ';
		//$_SESSION['log'] = '*Error* The captcha code does not match! ';
                header("location:register.php");
	}
	


else
{
$db = mysql_connect('localhost', 'root', '') or
die ('Unable to connect. Check your connection parameters.');

mysql_select_db('Record', $db) or die(mysql_error($db));

$query = "SELECT * FROM User_record";
$result = mysql_query($query, $db) or die (mysql_error($db));
while ($row = mysql_fetch_assoc($result))
{
if($my==$row['username'])
{

$_SESSION['exist'] = '*Error* Username already exists';
header("location:register.php");

}
}

if(strlen($pass)<6)
{
$_SESSION['exist'] = '*Error* Password length too small<br>Length must be atleast 6 ';
header("location:register.php");
}


else{

$db = mysql_connect('localhost', 'root', '') or
die ('Unable to connect. Check your connection parameters.');
mysql_select_db('Record', $db) or die(mysql_error($db));
$query = 'INSERT INTO User_record
(username , Password)
	VALUES
	("' . $_POST['fname'] . '",
	"' . $_POST['Pass'] . '")';
		
mysql_query($query, $db) or die(mysql_error($db));

//each user will have his own diary table


echo 'Click here to switch to<a href="login.php"><h1>Login</h1></a>page';

}

}
?>

</html>
</body>