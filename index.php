<?
session_start();

include("nagl.php");


if(isset($_SESSION['login'])){
	session_destroy();
	$_SESSION = array();
	echo "Usunięcie pozostałości po poprzednim logowaniu <br><br>";
	}
	?>
	
		<html >
  <head>
    <meta charset="UTF-8">
    <title>Calm breeze login screen</title>
    
    
		<link rel="stylesheet" href="css/style.css">
    
    
    
  </head>

  <body>

    <div class="wrapper">
	<div class="container">
		<h1>Elektroniczny rejestr pacjenta <br>
		Witamy!</h1>
		
		<form class="form" action = "log2.php" method = "POST" >
			<input type="text" name="email">
			<input type="password" name="haslo">
			<input type="submit" id="login-button" value ="Zaloguj">
		</form>
		
		<form action="register.php">
			<input type="submit" value="Zarejestruj się" />
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    

    
    
    
  </body>
</html>

		<?

		include("stopka/php");
		?>