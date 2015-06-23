
<?
	session_start();
	include("nagl.php");
	include("polacz.php");
	include("sessioncheck.php");

	print_r($_POST);

	if((isset($_SESSION['login']))&&(md5($_SESSION['login'])==$wiersz['haslo'])&&($_SESSION['nazwisko']==$wiersz['nazwisko'])&&($wiersz['uprawnienia'] == '0')){
		$tables = array('morfologia');
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

		
		echo "<h1>" . $_POST['imie'] . " " . $_POST['nazwisko'] . "</h1>";
		foreach($tables as $table) {
			$forma = "<form action=\"badanie.php\" method=\"POST\">";
			$forma.="<input type=\"hidden\" name=\"TABELA\" value=\"" . $table."\" size=\"20\" maxlength=\"30\" />";
			$query = "SELECT * FROM `". $table ."` WHERE 1";
			echo "<h1>". strtoupper($table) ."</h1>";
			$sukces = mysqli_query($mysqli,$query)
			or die('Błąd zapytania' . mysqli_error($mysqli));
			
			if($sukces){
				$row = mysqli_fetch_assoc($sukces);
				foreach($row as $key => $obj){
					if($key == 'id_pacjenta') {
						$forma.= "<input type=\"hidden\" name=\"". $key ."\" value=\"" . $_POST['id'] . " \" size=\"20\" maxlength=\"30\" /><br>";

					}
					else if($key == 'id'){}
					else {
						$forma.= $key . ": <input type=\"text\" name=\"". $key ."\" size=\"20\" maxlength=\"30\" /><br>";
					}
				}
			}
			$forma.= "<input type=\"submit\" value=\"Dodaj rekord\" />";
			$forma.="</form>";
			echo $forma;
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