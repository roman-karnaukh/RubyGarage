<?php
session_start();

?>
<html> 
	<head>
		<title>My Task</title>
		<link rel="stylesheet" href="style.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	</head>
	<body>
                    <br><br>
                        <div align="center">
			<h2>SIMPLE TODO LISTS</h2>
			<h5>FROM RUBY GARAGE</h5>
		         </div>
		<br>
<?php
// Страница авторизации

# Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

# Соединямся с БД
$link=mysqli_connect("mysql.cba.pl", "roman_taskmaster", "roman123", "task_master_zzz_com_ua");

if(isset($_POST['submit']))
{
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login_task'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    # Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password_task'])))
    {
        # Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        if(!@$_POST['not_attach_ip'])
        {
            # Если пользователя выбрал привязку к IP
            # Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        # Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        # Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);
		
		# Старт сессии, записываем  имя пользователя
		$_SESSION['login']=$_POST['login_task'];

        # Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: check.php"); exit();
    }
    else
    {
        print "Login or password is not correct";
    }
}
?>
<div align="center">
  <br>
    <div id="enterForm">
<form method="POST">
  <br>
Login<br>
  <input name="login_task" autocomplete="off" type="text"><br>
Password<br>
  <input name="password_task" autocomplete="off" type="password"><br>
Do not verify IP(not safely) <input type="checkbox" name="not_attach_ip"> <br>
<input id="buttonEnter" name="submit" type="submit" value="Enter"><br><br>
</form>
     </div>

<a href="register.php"><button id="buttonReg"  mane="registration">Registration</button></a>

<br><br>
  </div><br>

<div style="display:none">
<noindex>
		
      </body>

</div>
</noindex>
<footer>
   ⓒ  Ruby Garage
  </footer>
</html>