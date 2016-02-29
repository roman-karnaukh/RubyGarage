<html> 
	<head>
		<title>My Tasks</title>
		<link rel="stylesheet" href="syile.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	</head>
	<body> 
	<br>
	<div align="center">
			<h1>SIMPLE TODO LISTS</h1>
			<h4>FROM RUBY GARAGE</h4>
		</div>
		
		<div align="center">
			<br>
			<br>
		<?php
		//create new project
			$hostname = "mysql.cba.pl"; 
			$username = "roman_taskmaster"; 
			$password = "roman123"; 
			$dbName = "task_master_zzz_com_ua";
			$usertable = "projects";
			//connect to db
			$mysql_connect = mysql_connect($hostname,$username,$password);
			if (!$mysql_connect) {
				echo "error!";
				exit;
			}
 
			mysql_select_db($dbName);
			mysql_query("SET NAMES utf8");
			
			
		
			 
			if(isset($_POST['name_of_new_project'])){
					$name = $_POST['name_of_new_project'];
			
			/* запрос для вставки информации в таблицу */ 
			$query = "INSERT INTO $usertable VALUES('$name', 'new')"; 
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			mysql_query($query) or die(mysql_error()); 
			}
					
				
			//ОТОБРАЗИТЬ количество и имена ПРОЕКТОВ

			/* Переменные для соединения с базой данных */ 
			$hostname = "mysql.cba.pl"; 
			$username = "roman_taskmaster"; 
			$password = "roman123"; 
			$dbName = "task_master_zzz_com_ua";

			/* Таблица MySQL, в которой хранятся данные */ 
			$userstable = "projects"; 

			/* создать соединение */ 
			mysql_connect($hostname,$username,$password)
			 OR DIE("Не могу создать соединение "); 
			/* выбрать базу данных. Если произойдет ошибка - вывести ее */ 
			mysql_select_db($dbName) or die(mysql_error());  

			// составить запрос
			$query = "SELECT * FROM $userstable"; 
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			$res = mysql_query($query) or die(mysql_error()); 

			/* Как много нашлось таких */ 
			$number = mysql_num_rows($res); 

			/* Напечатать всех в красивом виде*/ 
			if ($number == 0) { 
			 echo "<CENTER>There is no Projects</CENTER>"; 
			 echo '<div id="greyBackground">
			<form action="" method="POST"> 
			<div class="createField">
			 <input type="text" id="forInput" name="name_of_new_project" placeholder = "Start typing here to create a project...">
			 <button id="forButton" type="submit" VALUE="Seve">Add Project</button>
			 </div></form></div>';
			} else { 
			echo '<div id="blueBackground">
			<table id="whiteText" width="100%">
			<tr>
			<td width="7%">
				<img src="image/task_icon.png"></img>
			</td>
			<td align="left">
				You have:'.$number.' Projects
			</td>	
			</tr>
			</table>
			</div>';
			
			echo '<div id="greyBackground">
			<form action="" method="POST">
			<table width="100%">
			<tr>
			<td width="7%">
			<img src="image/plus.png"></img>
			</td>
			<td>
			
			<div class="createField">
			<input type="text" id="forInput" name="name_of_new_project" placeholder = "Start typing here to create a project..."/>
			 <button id="forButton" type="submit" VALUE="Seve">Add Project</button>
			 </div>
			 </td>
			 </tr>
			 </table>
			 </form></div>';//СОЗДАТЬ НОВЫЙ ПРОЕКТ
			 			 
			/* Получать по одной строке из таблицы в массив $row,
			  пока строки не кончатся */  
			  while ($row=mysql_fetch_array($res)) { 
			  if($row['state']=="new"){
				echo '
				<div id="projectBack">
				<form action="" method="POST">
				<table width="100%" height="10">
				<tr>
				<td width="5%">
				<button id="buttonSetDone" type="submit" name="setDoneP" value="'.$row['name'].'"></button>
				</td><td width="2%"></td>
				<td width="50%">			
				<?xml version="1.0"?>
				<ubr>'.$row['name'].'</ubr>
				</XML>'." ".'</td><td width="30%">
				</td><td id="buttonSelectTake" >
				<button type="submit" id="buttonSelect" name="sub" value="'.$row['name'].'"></button>
				</td>
				<td id="buttonDeleteTake">
				<button type="submit" id = "buttonDelete" name="delete" value="'.$row['name'].'"></button>
				</td>
				<td  id="buttonRenameTake">
				<button id = "buttonRename" type="submit" name="rename" value="'.$row['name'].'"></button>
				</td>
				<td width="3%"></td>
				</tr>
				</table>
				</form>
			  </div>';}else{
				  echo '
				<div id="projectBack">
				<form action="" method="POST">
				<table width="100%" height="10">
				<tr>
				<td width="5%">
				<button id="buttonDone" disabled type="submit" name="setDoneP" value="'.$row['name'].'"></button>
				</td><td width="2%"></td>
				<td width="50%">			
				<?xml version="1.0"?>
				<ubr>'.$row['name'].'</ubr>
				</XML>'." ".'</td><td width="30%">
				</td><td id="buttonSelectTake" >
				<button type="submit" id="buttonSelect" name="sub" value="'.$row['name'].'"></button>
				</td>
				<td id="buttonDeleteTake">
				<button type="submit" id = "buttonDelete" name="delete" value="'.$row['name'].'"></button>
				</td>
				<td  id="buttonRenameTake">
				<button id = "buttonRename" type="submit" name="rename" value="'.$row['name'].'"></button>
				</td>
				<td width="3%"></td>
				</tr>
				</table>
				</form>
			  </div>';
			  }
				} 
				echo '<div id="endOfTheTable"></div>'; 
				echo '<br>';
			  
			} 
			echo '<script src="edition.js"></script>';
			
			//СТАТУС ПРОЕКТА - ВЫПОЛНЕН
			if(isset($_POST['setDoneP'])){
				    $projectUpdate = $_POST['setDoneP'];
					$userstablePP = "projects";
				// составить запрос
				
			$updateProject = "UPDATE $userstablePP SET state = 'done' WHERE name = '$projectUpdate'"; 	
			$updateTask = "UPDATE tasks SET state = 'done' WHERE project_name = '$projectUpdate'";
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			$res = mysql_query($updateProject) or die(mysql_error());
			$res = mysql_query($updateTask) or die(mysql_error());
			echo "<CENTER>State of the project was updated</CENTER>";
			echo '<script language="JavaScript"> 
			  window.location.href = "http://task-master.zzz.com.ua/RubyGarage/"
			</script>';
			}
			
			//УДАЛИТЬ ПРОЕКТ при нажатии на кнопку
			if(isset($_POST['delete'])){
				    $nameproject = $_POST['delete'];
					$column = "name";
					$userstable3 = "projects";
				// составить запрос
			$queryDeleteProject = "DELETE FROM $userstable3 WHERE $column = '$nameproject'"; 
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			$res = mysql_query($queryDeleteProject) or die(mysql_error());
			echo '<script language="JavaScript"> 
			  window.location.href = "http://task-master.zzz.com.ua/RubyGarage/"
			</script>';
			
			}
			
			//ПЕРЕИМЕНОВАТЬ ПРОЕКТ
			if(isset($_POST['rename'])){
				    $nameproject = $_POST['rename'];
					$column = "name";
					$userstable3 = "projects";
					$renamed = $_POST['renamed']; //UPDATE `projects` SET `name`="TestProject5" WHERE `name`="dfgdfgdfdf" 
				// составить запрос
				if($_POST['renamed'] == $_POST['sub']){
					echo "<CENTER>Please enter new name of project</CENTER>";
				}else{
				
			$queryDeleteProject = "UPDATE $userstable3 SET $column = '$renamed' WHERE $column = '$nameproject'"; 
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			$res = mysql_query($queryDeleteProject) or die(mysql_error());
			
			echo '<script language="JavaScript"> 
			  window.location.href = "http://task-master.zzz.com.ua/RubyGarage/"
			</script>';
				}
			}
			
			
						
				$nameproject = $_POST['sub'];		
			//ОТКРЫТЬ ЗАДАЧИ при нажатии на кнопку выбора проекта
			if(isset($_POST['sub'])){
					global $nameproject;
					$column = "project_name";
					$userstable2 = "tasks";
		
			// составить запрос
			$query = "SELECT * FROM $userstable2 WHERE $column = '$nameproject'"; 
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			$res = mysql_query($query) or die(mysql_error()); 

			/* Как много нашлось таких */ 
			$number = mysql_num_rows($res); 

			/* Напечатать всех в красивом виде*/ 
			if ($number == 0) { 
			 echo "<CENTER>There is no tasks in the $nameproject project</CENTER><BR>";
			 echo '<script src="calendar_ru.js" type="text/javascript"></script>
			<div id="greyBackground">
			
			<form action="" method="POST"> 		
			<table width="100%" height="10">
			<tr>
			<td width="7%">
			<img src="image/plus.png"></img>
			</td>
			<td>
			
			
			<div class="createField">
			<input type="text" id="taskInput" name="nameOfTheTask" placeholder = "Start typing here to create a task..."/>
			<input hidden type="text"  name="namePR" value="'.$nameproject.'"/>
			 <input type="text" id="calendarInput" name="deadline"   placeholder = "dd-mm-yy" onfocus="this.select();lcs(this)" onclick="event.cancelBubble=true;this.select();lcs(this)"/>
			 <button id="forButton" name="sb" type="submit" value="Save">Add Task</button>			 
			 </div>
			
			
			
			 </td></tr></table>
			  </form>
			 </div>';//ПОЛЕ СОЗДАНИЯ ЗАДАЧИ
			} else {
								
			echo '<div id="blueBackground">
			<table id="whiteText" width="100%">
			<tr>
			<td width="7%">
				<img src="image/task_icon.png"></img>
			</td>
			<td align="left">
			You have: '.$number.' tasks in the '.$nameproject.' project
			</td>	
			</tr>
			</table>
			</div>';//ОТОБРАЗИТ КОЛИЧЕСТВО ЗАДАЧ
								
			
			echo '<script src="calendar_ru.js" type="text/javascript"></script>
			<div id="greyBackground">
			
			<form action="" method="POST"> 		
			<table width="100%" height="10">
			<tr>
			<td width="7%">
			<img src="image/plus.png"></img>
			</td>
			<td>
			
			
			<div class="createField">
			<input type="text" id="taskInput" name="nameOfTheTask" placeholder = "Start typing here to create a task..."/>
			<input hidden type="text"  name="namePR" value="'.$nameproject.'"/>
			 <input type="text" id="calendarInput" name="deadline"   placeholder = "dd-mm-yy" onfocus="this.select();lcs(this)" onclick="event.cancelBubble=true;this.select();lcs(this)"/>
			 <button id="forButton" name="sb" type="submit" value="Save">Add Task</button>			 
			 </div>
			
			
			
			 </td></tr></table>
			  </form>
			 </div>';//ПОЛЕ СОЗДАНИЯ ЗАДАЧИ
			
			  /* Получать по одной строке из таблицы в массив $row,
			  пока строки не кончатся */  
			  while ($row=mysql_fetch_array($res)) { 
			   if($row['state']=="new"){
				echo  '<div id="projectBack" >
				<form action="" method="POST">
				<table width="100%">
				<tr><td width="5%">
				<button id="buttonSetDone" type="submit" name="setDone" value="'.$row['name'].'"></button>
				</td><td width="2%"></td>
				<td width="80%">
				<?xml version="1.0"?>
				<ubr>'.$row['name'].'</ubr>
				</XML>'." to ".$row['deadline'].'
				<td id="buttonDeleteTake">
				<button type="submit" id = "buttonDelete" name="deleteTask" value="'.$row['name'].'"> </button>
				</td>
				<td>
				</td>
				<td  id="buttonRenameTake">
				<button id = "buttonRename" type="submit" name="renameTask" value="'.$row['name'].'"> </button>
				</td>
				<td width="5%"></td>
				</tr>
				</table>
				</form>
				</div>';
			   }else{
				echo '<div id="projectBack" >
				<form action="" method="POST">
				<table  width="100%">
				<tr><td width="5%">
				<button disabled id="buttonDone" type="submit" name="setDone" value="'.$row['name'].'"></button>
				</td><td width="2%"></td>
				<td width="80%">
				<?xml version="1.0"?>
				<ubr>'.$row['name'].'</ubr>
				</XML>'." to ".$row['deadline'].'
				<td id="buttonDeleteTake">
				<button type="submit" id = "buttonDelete" name="deleteTask" value="'.$row['name'].'"> </button>
				</td>
				<td>
				</td>
				<td  id="buttonRenameTake">
				<button id = "buttonRename" type="submit" name="renameTask" value="'.$row['name'].'"> </button>
				</td>
				<td width="5%"></td>
				</tr>
				</table>
				</form>
				</div>';
			   }
				} 
				echo '<div id="endOfTheTable"></div>'; 
				echo '<br>';
			  } 
			
		
		    }
			//СТАТУС ЗАДАЧИ - ВЫПОЛНЕНА
			if(isset($_POST['setDone'])){
				    $taskUpdate = $_POST['setDone'];
					$column = "state";
					$userstableT = "tasks";
				// составить запрос
			$updateState = "UPDATE $userstableT SET $column = 'done' WHERE name = '$taskUpdate'"; 
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			$res = mysql_query($updateState) or die(mysql_error());
			echo "<CENTER>State of the task was updated</CENTER>";			
			}
			
			//УДАЛИТЬ ЗАДАЧУ
			if(isset($_POST['deleteTask'])){
				    $taskText = $_POST['deleteTask'];
					$column = "name";
					$userstableT = "tasks";
				// составить запрос
			$queryDeleteTask = "DELETE FROM $userstableT WHERE $column = '$taskText'"; 
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			$res = mysql_query($queryDeleteTask) or die(mysql_error());
			echo "<CENTER>Task was deleted</CENTER>";			
			}
			//ПЕРЕИМЕНОВАТЬ ЗАДАЧУ
			if(isset($_POST['renameTask'])){
				    $taskText = $_POST['renameTask'];
					$column = "name";
					$userstableT = "tasks";
					$renamed = $_POST['renamed']; //UPDATE `projects` SET `name`="TestProject5" WHERE `name`="dfgdfgdfdf" 
				// составить запрос
				if($_POST['renamed'] == $_POST['deleteTask']){
					echo "<CENTER>Please enter new name of project</CENTER>";
				}else{
				
			$queryDeleteProject = "UPDATE $userstableT SET $column = '$renamed' WHERE $column = '$taskText'"; 
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			$res = mysql_query($queryDeleteProject) or die(mysql_error());
			
			}
			echo "<CENTER>Task was renamed</CENTER>";
			}
			
			//СОЗДАТЬ ЗАДАЧИ
		if(isset($_POST['sb'])){
			
			        $nameproject22 = $_POST['namePR'];
					$nameOfTheTask = $_POST['nameOfTheTask'];
					$column = "name";
					$deadline = $_POST['deadline'];
					$userstable4 = "tasks";
				// составить запрос INSERT INTO `tasks`(`project_name`, `name`, `deadline`) VALUES ([value-1],[value-2],[value-3])
			$queryCreateTheTask = "INSERT INTO $userstable4 (project_name, name, deadline, state) VALUES('$nameproject22', '$nameOfTheTask', '$deadline', 'new')";  
			/* Выполнить запрос. Если произойдет ошибка - вывести ее. */ 
			$res = mysql_query($queryCreateTheTask) or die(mysql_error());
			
			echo "<CENTER>Task was created</CENTER>";
			}		
						
					
		?> 
		
		
		</div>
		
				
		<br>
		
		<footer>
   ⓒ  Ruby Garage
  </footer>
	</body>
</html> 