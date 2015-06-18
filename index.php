<?
session_start();

include("nagl.php");

if(isset($_SESSION['login'])){
	session_destroy();
	$_SESSION = array();
	echo "Usunięcie pozostałości po poprzednim logowaniu <br><br>";
	}
	?>
	
		<form action = "log2.php" method = "POST">
			e-mail: <input type = "text" name = "email" /><br>
			hasło: <input type = "password" name ="haslo" /><br>
			<input type = "submit" value = "Zaloguj" />
		</form>
		
		<form action="register.php">
			<input type="submit" value="Zarejestruj się" />
		</form>

		<?

		include("stopka/php");
		?>