<?
	session_start();
	include("nagl.php");
	include ("polacz.php");
	

	if(isset($_SESSION)){
		
	}else
		echo "Sesja nie zostala jeszcze zainicjowana <br><br>";
		
	if ((!isset($_POST['email'])) && (isset($_SESSION))){
		$kwerenda = "select id, imie, email, haslo, nazwisko, uprawnienia from uzytkownicy ";
		$kwerenda.= "where nazwisko = \"". $_SESSION['nazwisko']. "\""; 
	}
	else {

	$kwerenda = "select id, imie, email, haslo, nazwisko, uprawnienia from uzytkownicy ";
	$kwerenda.= "where email = \"". $_POST['email']. "\"";
	}
	//echo $kwerenda . "<br><br>";
	
	$wynik = mysqli_query($mysqli, $kwerenda)
	or die('Blad zapytania');
		
		if($wynik){
			$wiersz = mysqli_fetch_assoc($wynik);
			//echo mysqli_fetch_assoc($wynik);
			$has = $wiersz['haslo'];
			//echo "Zakodowane przez md5 haslo z bazy = $has<br>";
		}
				
		//echo "========================================<br>";

		
		if((isset($has)) && md5($_POST['haslo']) == $has){
			echo "<h1>" . $wiersz['imie'] . " " . $wiersz['nazwisko'] . "</h1>";
			$_SESSION['login'] = $_POST['haslo'];
			$_SESSION['nazwisko'] = $wiersz['nazwisko'];
			}
			if(((isset($has)) && (md5($_POST['haslo']) == $has)) || ((isset($_SESSION['login']))&&(md5($_SESSION['login'])==$wiersz['haslo'])&&($_SESSION['nazwisko']==$wiersz['nazwisko']))){
				//print_r($wiersz);
				switch($wiersz['uprawnienia']){
					case -1:
						echo "Zalogowany jako pacjent";
						//echo "<br>";

						$forma1 ="<form action = \"edit2.php\" method=\"POST\">";
						$forma1.="<input type=\"hidden\" name=\"id\" value=\"". $wiersz['id'] ."\" size=\"20\" maxlength=\"30\" />";
						$forma1.= "<input type=\"submit\" value=\"Mój rekord pacjenta\" />";
						$forma1.="</form>";

						echo $forma1;
						break;
					case 0:
						echo "Zalogowany jako pracownik laboratorium";

						$forma ="<form action = \"edit.php\" method=\"POST\">";
						$forma.= "<input type=\"submit\" value=\"Dodaj badanie\" />";
						$forma.="</form>";

						echo $forma;
						echo $zdjecie;
						break;
					case 1:
						echo "Zalogowany jako lekarz<br>";
						
						$forma ="<form action = \"add.php\" method=\"POST\">";
						$forma.= "<input type=\"submit\" value=\"Dodaj pacjenta\" />";
						$forma.="</form>";

						$forma1 ="<form action = \"edit.php\">";
						$forma1.= "<input type=\"submit\" value=\"Wybierz pacjenta\" />";
						$forma1.="</form>";


						echo $forma;
						echo $forma1;

						break;
					default:
						echo "Coś poszło nie tak";
						break;
				}
				
				$button="<form action=\"wyloguj.php\" method=\"POST\">";
				$button.= "<input type = \"submit\" value=\"Wyloguj\"/>";
				$button.= "</form>";
				
				echo $button;
				
				$buttonek="<form action=\"index.php\" method=\"POST\">";
				$buttonek.= "<input type = \"submit\" value=\"Powrót \"/>";
				$buttonek.= "</form>";
				echo $buttonek;
	
}
		if((isset($_POST['email']))&&(!((isset($has)) && md5($_POST['haslo']) == $has))){
			echo "Podales zle dane - nie masz uprawnien";
		}
	?>
	
	<?
		include("stopka.php");
	?>
