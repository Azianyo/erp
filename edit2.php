<?
	session_start();
	include("nagl.php");
	include("polacz.php");
	include("sessioncheck.php");

	if((isset($_SESSION['login']))&&(md5($_SESSION['login'])==$wiersz['haslo'])&&($_SESSION['nazwisko']==$wiersz['nazwisko'])&&($wiersz['uprawnienia'] == "1")){
		$tables = array('morfologia');
			foreach($tables as $table) {
			$query = "SELECT * FROM `". $table . "` WHERE id_pacjenta='". $_POST['id'] . "'";
			$sukces = mysqli_query($mysqli,$query)
			or die('Błąd zapytania' . mysqli_error($mysqli));

			
			if($sukces){
				echo "<h2>" . $table ."</h2>";
				while($row = mysqli_fetch_assoc($sukces)){
					foreach($row as $key => $obj) {
						if($key == "id_pacjenta" || $key == "id") {}
						else {
							echo $key . ": " . $obj . "<br>";
						}
					}
				}
			}
		}
	?>

	<form action="diagnose.php">
	<input type="hidden" name="id_pacjenta" value=<?echo $_POST['id'];?> size="20" maxlength="30" />
	<input type="submit" value="Postaw diagnozę" />
	</form>

	<form action="edit.php">
	<input type="submit" value="Wróć" />
	</form>

			<?
	}
	else {
		echo "Nie masz uprawnień do tego skryptu";
	}
	include ("stopka.php");
?>