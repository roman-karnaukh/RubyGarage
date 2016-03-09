<?php
    //Стартуем сессии
 session_start();
 header('Content-Type: text/html; charset=utf-8');
?>
<html> 
	<head>
		<title>Registration</title>
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
<?
// Страница регистрации нового пользователя

# Соединямся с БД
$link=mysqli_connect("mysql.cba.pl", "roman_taskmaster", "roman123", "task_master_zzz_com_ua");

if(isset($_POST['submit']))
{
    $err = array();

    # проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login_task']))
    {
        $err[] = "Username may only consist of letters of the English alphabet and numbers";
    }

    if(strlen($_POST['login_task']) < 3 or strlen($_POST['login_task']) > 30)
    {
        $err[] = "Login must be at least 3 characters and no more than 30";
    }

    # проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login_task'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "User with the same name already exist. Please, try to change name.";
    }

    # Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['login_task'];

        # Убераем лишние пробелы и делаем двойное шифрование
        $password = md5(md5(trim($_POST['password_task'])));

        mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_password='".$password."'");

        echo '<script>
           alert("Registration is successful!");
           if (confirm("Go to the login page?")) {
                window.location.href = "login.php"

                 }
          </script>';
       
    }
    else
    {
        print "<b>Upon registration the following errors find:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>
 <div align="center">
    <br />
    <div id="regForm">
<form method="POST">
  <br>
Set your login name <br>
  <input name="login_task" autocomplete="off" type="text"><br>
Set your login password <br>
  <input name="password_task" autocomplete="off" type="password"><br><br>
<input id="buttonRegister" name="submit" type="submit" value="Create an Account">
  <br>
  <br>
  </form>
  </div>

<a href="login.php"><button id="buttonSign" mane="registration">Or Sign In</button></a>
    <br><br>
<br>

<div style="display:none">
<noindex>
		
      </body>

</div>
</noindex>

<footer>
   ⓒ  Ruby Garage
  </footer>
</html>	