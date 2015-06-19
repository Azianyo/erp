<?
	session_start();
	include("nagl.php");
	include("polacz.php");
	include("sessioncheck.php");

	if((isset($_SESSION['login']))&&(md5($_SESSION['login'])==$wiersz['haslo'])&&($_SESSION['nazwisko']==$wiersz['nazwisko'])&&($wiersz['uprawnienia'] == "1")){
		$tables = array('uzytkownicy');
		foreach($tables as $table) {
			$query = "SELECT * FROM `". $table ."` WHERE uprawnienia = '-1'";
			echo "<h1>". strtoupper($table) ."</h1>";
			$sukces = mysqli_query($mysqli,$query)
			or die("Nie udało się pobrać zawartości tabeli " . $table);
			if($sukces){
				while($row = mysqli_fetch_assoc($sukces)){
					$forma ="<form action = \"edit2.php\" method=\"POST\">";
					$forma.="<input type=\"text\" name=\"TABELA\" value=\"" . $table."\" size=\"20\" maxlength=\"30\" />";
					foreach($row as $key => $obj) {
						if($key == "haslo" || $key == "uprawnienia") {
						}
						else {
							echo $key . ": " . $obj . "   ";
						}
					}
					$forma ="<form action = \"edit2.php\" method=\"POST\">";
					$forma.="<input type=\"hidden\" name=\"TABELA\" value=\"uzytkownicy\" size=\"20\" maxlength=\"30\" />";
					foreach($row as $key => $obj) {
						if($key == "haslo") {}
						else {
							$forma.="<input type=\"hidden\" name=\"" . $key . "\" value=\"". $obj ."\" size=\"20\" maxlength=\"30\" />";
						}
					}
					$forma.= "<input type=\"submit\" value=\"Rekord pacjenta\" />";
					$forma.="</form>";
					echo $forma;	
				}
			}
		}
?>	

		<form action="log2.php">
		<input type="submit" value="Wróć" />
		</form>

		<form action="wyloguj.php" method="POST">
		<input type = "submit" value="Wyloguj"/>
		</form>

		<?
	}
	else {
		echo "Nie masz uprawnień do tego skryptu";
	}
	include ("stopka.php");
?>