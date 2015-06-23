<?
	session_start();
	include("nagl.php");
	include("polacz.php");
	include("sessioncheck.php");
	?>
	<style type="text/css" media="print">
   		.no-print { display: none; }
	</style>
	<?

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

		$form1= "<form action=\"diagnose.php\" class=\"no-print\" method=\"POST\">";
		$form1.= "<input type=\"hidden\" name=\"id_pacjenta\" value=\"" . $_POST['id'] ."\" size=\"20\" maxlength=\"30\" />";
		$form1.= "<input type=\"submit\" value=\"Postaw diagnozę\" />";
		$form1.= "</form>";

		$form2= "<form action=\"edit.php\" class=\"no-print\">";
		$form2.= "<input type=\"submit\" value=\"Wróć\" />";
		$form2.= "</form>";	

		$form3= "<form action=\"log2.php\" class=\"no-print\">";
		$form3.= "<input type=\"submit\" value=\"Wróć\" />";
		$form3.= "</form>";			


	?>


	<form action="disease.php" class="no-print" method="POST">
	<input type="hidden" name="id_pacjenta" value=<?echo $_POST['id'];?> size="20" maxlength="30" />
	<input type="submit" value="Dodaj przebytą chorobę" />
	</form>

	<form>
		<input type="button" onClick="window.print()" class="no-print" value="Wydrukuj lub ściągnij wypis w PDF">
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

	<form action="wyloguj.php" class="no-print" method="POST">
	<input type = "submit" value="Wyloguj"/>
	</form>


			<?
	}
	else {
		echo "Nie masz uprawnień do tego skryptu";
	}
	include ("stopka.php");
?>