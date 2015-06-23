<?
	session_start();
	include("nagl.php");
	include("polacz.php");
	include("sessioncheck.php");

	echo "<h1>" . $_POST['imie'] . " " . $_POST['nazwisko'] . "</h1>";
	if((isset($_SESSION['login']))&&(md5($_SESSION['login'])==$wiersz['haslo'])&&($_SESSION['nazwisko']==$wiersz['nazwisko'])&&($wiersz['uprawnienia'] == "1" || $wiersz['uprawnienia'] == "-1")){
		$tables = array('morfologia', 'choroby', 'diagnozy');
			foreach($tables as $table) {
			$query = "SELECT * FROM `". $table . "` WHERE id_pacjenta='". $_POST['id'] . "'";
			$sukces = mysqli_query($mysqli,$query)
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
		}

		$form1= "<form action=\"diagnose.php\" method=\"POST\">";
		$form1.= "<input type=\"hidden\" name=\"id_pacjenta\" value=\"" . $_POST['id'] ."\" size=\"20\" maxlength=\"30\" />";
		$form1.= "<input type=\"submit\" value=\"Postaw diagnozę\" />";
		$form1.= "</form>";

		$form2= "<form action=\"edit.php\">";
		$form2.= "<input type=\"submit\" value=\"Wróć\" />";
		$form2.= "</form>";	

		$form3= "<form action=\"log2.php\">";
		$form3.= "<input type=\"submit\" value=\"Wróć\" />";
		$form3.= "</form>";			


	?>

	<a href="http://FreeHTMLtoPDF.com/?convert=http%3A%2F%2Fwww.student.agh.edu.pl/~borzemsk/erp/edit2.php">Download as PDF</a>

	<form action="disease.php" method="POST">
	<input type="hidden" name="id_pacjenta" value=<?echo $_POST['id'];?> size="20" maxlength="30" />
	<input type="submit" value="Dodaj przebytą chorobę" />
	</form>

	<?
		if($wiersz['uprawnienia'] == "1"){
			echo $form1;
			echo $form2;
		}
		else {
			echo $form3;
		}
	?>

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