<?
	session_start();
	include("nagl.php");
	include ("polacz.php");

	echo "<div class=\"wrapper\">";
	echo "<div class=\"container\">";
	


	if(isset($_SESSION)){
		
	}else
		echo "Sesja nie zostala jeszcze zainicjowana <br><br>";
		
	if ((!isset($_POST['email'])) && (isset($_SESSION))){
		$kwerenda = "select email, haslo, nazwisko, uprawnienia from uzytkownicy ";
		$kwerenda.= "where nazwisko = \"". $_SESSION['nazwisko']. "\""; //"\" AND haslo = \"". md5($_SESSION['haslo']). "\"";
	}
	else {

	$kwerenda = "select email, haslo, nazwisko, uprawnienia from uzytkownicy ";
	$kwerenda.= "where email = \"". $_POST['email']. "\"";
	}
	echo $kwerenda . "<br><br>";
	
	$wynik = mysqli_query($mysqli, $kwerenda)
	or die('Blad zapytania');
		
		if($wynik){
			$wiersz = mysqli_fetch_assoc($wynik);
			echo mysqli_fetch_assoc($wynik);
			$has = $wiersz['haslo'];
			echo "Zakodowane przez md5 haslo z bazy = $has<br>";
		}
				
		echo "========================================<br>";

		
		if((isset($has)) && md5($_POST['haslo']) == $has){
			echo"<br>Logujący podal poprawne dane <br>";
			echo "Mozna rozpoczac sesje <br><br>";
			$_SESSION['login'] = $_POST['haslo'];
			$_SESSION['nazwisko'] = $wiersz['nazwisko'];
			}
			if(((isset($has)) && (md5($_POST['haslo']) == $has)) || ((isset($_SESSION['login']))&&(md5($_SESSION['login'])==$wiersz['haslo'])&&($_SESSION['nazwisko']==$wiersz['nazwisko']))){
				print_r($wiersz);
				switch($wiersz['uprawnienia']){
					case -1:
						echo "Pacjent";
						echo "<br>";
						break;
					case 0:
						echo "Pracownik laboratorium";
						break;
					case 1:
						echo "Lekarz<br>";
						
						$forma ="<form action = \"add.php\" method=\"POST\">";
						$forma.= "<input type=\"submit\" value=\"Dodaj pacjenta\" />";
						$forma.="</form>";

						$forma1 ="<form action = \"edit.php\">";
						$forma1.= "<input type=\"submit\" value=\"Wybierz pacjenta\" />";
						$forma1.="</form>";

						$forma2 ="<form action = \"delete.php\">";
						$forma2.= "<input type=\"submit\" value=\"Usuwaj rekordy\" />";
						$forma2.="</form>";

						$forma3 ="<form action = \"calendar.php\">";
						$forma3.= "<input type=\"submit\" id=\"login-button\" value=\"Przeglądaj kalendarz\" />";
						$forma3.="</form>";

						echo $forma;
						echo $forma1;
						echo $forma2;
						echo $forma3;
						break;
					default:
						echo "Coś poszło nie tak";
						break;
				}
				$forma ="<form action = \"dalej.php\" method=\"POST\">";
				$forma.= "<input type=\"submit\" value=\"Kontynuacja sesji\" />";
				$forma.="</form>";
				
						$button="<form action=\"wyloguj.php\" method=\"POST\">";
						$button.= "<input type = \"submit\" value=\"Wyloguj\"/>";
						$button.= "</form>";

				echo $forma;
				echo $button;
				
						$buttonek="<form action=\"index.php\" method=\"POST\">";
						$buttonek.= "<input type = \"submit\" value=\"Powrót \"/>";
						$buttonek.= "</form>";
				echo $buttonek;
	
}
		if((isset($_POST['email']))&&(!((isset($has)) && md5($_POST['haslo']) == $has))){
			echo "Podales zle dane - nie masz uprawnien";
		}
		echo "</div> <ul class=\"bg-bubbles\">
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
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>"
	?>
	
	<?
		include("stopka.php");
	?>
