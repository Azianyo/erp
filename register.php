<?
	include("nagl.php");
	include("polacz.php");

	if(isset($_SESSION)){
		session_destroy();
		$_SESSION = array();
		echo "<br /><br />Zostales poprawnie wylogowany<br /><br />";
	
		echo "<form action=\"index.php\" method=\"POST\">";
		echo "<input type=\"submit\" value=\"Ponownie zaloguj\">";
		echo "</form>";
	}


		if(isset($_POST['nazwisko'])&&isset($_POST['email'])&&isset($_POST['haslo'])&&
			isset($_POST['repeat_haslo'])&&($_POST['haslo']==$_POST['repeat_haslo']) && isset($_POST['imie'])){
			$query = " INSERT INTO `uzytkownicy`(`nazwisko`,`email`,`haslo`,`imie`) VALUES ('";
			$query .= $_POST['nazwisko']."', '".$_POST['email']."', '".md5($_POST['haslo']). "" . 
			$_POST['imie']."')";

			$wynik = mysqli_query($mysqli,$query)
			or die("Błąd zapytania:". mysqli_error($mysqli));

			if($wynik){
				echo "Zostałeś poprawnie zarejestrowany";
				echo "<form action=\"index.php\">
					<input type=\"submit\" value=\"Zaloguj się\" />
				</form>";
			}
		}
		else {
			echo "Przesłany formularz ma puste pola lub hasło zostało błędnie powtórzone.";
		}
	
?>
	<form action = "register.php" method = "POST">
		Nazwisko: <input type = "text" name = "nazwisko" /><br>
		E-mail: <input type = "text" name = "email" /><br>
		Hasło: <input type = "password" name ="haslo" /><br>
		Powtórz hasło: <input type = "password" name ="repeat_haslo" /><br>
		<input type = "submit" value = "zarejestruj" />
	</form>

	<form action="index.php">
		<input type="submit" value="Powrót do logowania" />
	</form>

	<?
		include("stopka/php");
	?>