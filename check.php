<?php
session_start();

#Проверка сессии
if(!$_SESSION['login']){
	header("Location: login.php");
	exit;
}

?>
<html> 
	<head>
		<title>My Task</title>
		<link rel="stylesheet" href="style.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	</head>
	<body>
<?php
// Скрипт проверки

# Соединямся с БД
$link=mysqli_connect("mysql.cba.pl", "roman_taskmaster", "roman123", "task_master_zzz_com_ua");

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
 or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Hm, something wrong;(";
    }
    else
    {
	
       header("Location: index.php");
    }
}
else
{
    print "Switch on cookies";
}
?>
		</body>
</html>
