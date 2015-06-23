
<?
	session_start();
	include("nagl.php");
	include("polacz.php");
	include("sessioncheck.php");

	print_r($_SESSION);
	print_r($_POST);

	if((isset($_SESSION['login']))&&(md5($_SESSION['login'])==$wiersz['haslo'])&&($_SESSION['nazwisko']==$wiersz['nazwisko'])&&($wiersz['uprawnienia'] == '1')){
		$tables = array('diagnozy');
		if(isset($_POST['TABELA'])) {
			$add = "INSERT INTO `". $_POST['TABELA'] ."`(`";
				foreach($_POST as $key => $val){
					if(end($_POST) == $val){
						$add.= $key . "`) VALUES ('";
					}
					else if($key == 'TABELA'){}
					else {
						$add.= $key . "`, `";
					}
				}
				foreach($_POST as $key => $val){
					if(end($_POST) == $val){
						$add.= $val . "')";
					}
					else if($key == 'HASLO'){
						$add .= md5($val) . "', '";;
					}
					else if($key == 'TABELA') {}
					else {
						$add.= $val . "', '";
					}
				}
			$wynik = mysqli_query($mysqli,$add)
			or die("Bład zapytania: " . mysqli_error($mysqli));
			if($wynik) {
				echo "Dodano rekord: " . $add . "<br>";
			}
			else {
				echo "Dodanie rekordu nie powiodło się <br>";
			}
		}

		

		foreach($tables as $table) {

			$query1 = "SELECT * FROM `". $table . "` WHERE id_pacjenta='". $_POST['id_pacjenta'] . "'";
			$sukces = mysqli_query($mysqli,$query1)
			or die('Błąd zapytania' . mysqli_error($mysqli));

			
			if($sukces){
				echo "<h2>" . $table ."</h2>";
				while($row = mysqli_fetch_assoc($sukces)){
					foreach($row as $key => $obj) {
						if($key == "id_pacjenta" || $key == "id" || $key == 'id_lekarza') {}
						else {
							echo $key . ": " . $obj . " ";
						}
					}
					echo "<br>";
				}
			}

			$forma = "<form action=\"diagnose.php\" method=\"POST\">";
			$forma.="<input type=\"hidden\" name=\"TABELA\" value=\"" . $table."\" size=\"20\" maxlength=\"30\" />";
			$query = "SELECT * FROM `". $table ."` WHERE 1";
			echo "<h1>". strtoupper($table) ."</h1>";
			$sukces = mysqli_query($mysqli,$query)
			or die('Błąd zapytania' . mysqli_error($mysqli));
			
			if($sukces){
				$row = mysqli_fetch_assoc($sukces);
				foreach($row as $key => $obj){
					if($key == 'id'){}
					else if($key == 'id_pacjenta') {
						$forma.= "<input type=\"hidden\" name=\"". $key ."\" value=\"" . $_POST['id_pacjenta'] ."\" size=\"20\" maxlength=\"30\" /><br>";

					}
					else if($key == 'nazwisko_lekarza') {
						$forma.= "<input type=\"hidden\" name=\"". $key ."\" value=\"" . $_SESSION['nazwisko'] ."\" size=\"20\" maxlength=\"30\" /><br>";

					}
					else if($key == 'id_lekarza') {
						$query = "SELECT * FROM `uzytkownicy` WHERE nazwisko='" . $_SESSION['nazwisko'] ."' AND uprawnienia='1'";
						echo $query;
						$sukces = mysqli_query($mysqli,$query)
						or die('Błąd zapytania' . mysqli_error($mysqli));

						if($sukces){
							while($row = mysqli_fetch_assoc($sukces)){
								echo $row['id'];
								$forma.= "<input type=\"hidden\" name=\"id_lekarza\" value=\"" . $row['id'] ."\" size=\"20\" maxlength=\"30\" /><br>";
							}
						}
					}
					else {
						$forma.= $key . ": <input type=\"text\" name=\"". $key ."\" size=\"20\" maxlength=\"30\" /><br>";
					}
				}
			}
			$forma.= "<input type=\"submit\" value=\"Dodaj diagnozę\" />";
			$forma.="</form>";
			echo $forma;
		}
?>	

		<form action="edit.php">
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