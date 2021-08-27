<html>
<head>
<title>Calendar</title>
<link rel="stylesheet" href="css/style.css" />	
</head>
<body>
  <div id="menu">
  <div id="submenu">
	<?php

	echo '<br><h1><a href="?seite=calendar">Calendar</a></h1><br>';	
	session_start();
	if(isset($_GET["seite"]) && $_GET["seite"] == "logout")
	{
		session_destroy();
		unset($_SESSION);
		setcookie("login_merken", "", time() -1);
		unset($_COOKIE["login_merken"]); 
	}

	if(isset($_SESSION["eingeloggt"]))
	{
		echo '<a href="?seite=suchen">Search / Filter</a><br><br>';			
		echo '<br><a href="?seite=logout">Logout</a>';	
	}
	else
	{
		echo '<br><a href="?seite=login">Login</a><br><br>';		
	}	
	?>
	</div>
  </div>
  <div id="content">
	<?php	  
	if(isset($_GET["seite"])){
		
		switch($_GET["seite"])
		{
			case "calendar":
				include("php/calendar.php");break;		
			case "login":
				include("seiten/login.php");break;
			case "logout":
				include("seiten/logout.php");break;			
			case "mycalender":
				include("seiten/meinetermine.php");break;
			case "tagesansicht":
				include("seiten/tagesansicht.php");break;								
			case "terminneu_confirm":
				include("seiten/terminneu_confirm.php");break;				
			case "terminneu":
				include("seiten/terminneu.php");break;
			case "delete_confirm":
				include("seiten/delete_confirm.php");break;			
			case "delete":
				include("seiten/delete.php");break;
			case "edit_confirm":
				include("seiten/edit_confirm.php");break;			
			case "edit":
				include("seiten/edit.php");break;	
			case "suchen":
				include("seiten/suchen.php");break;	
			case "suchergebnis":
				include("seiten/suchergebnis.php");break;			
			case "filtern":
				include("php/filtern.php");break;	
			case "filterergebnis":
				include("seiten/filterergebnis.php");break;			
		}
	}else
	{
		include("php/calendar.php");
	}	
	?>
  </div>
</body>
</html>