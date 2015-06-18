<?
	if(isset($_SESSION['nazwisko'])){
		$kwerenda = "select email, haslo, nazwisko, uprawnienia from uzytkownicy ";
		$kwerenda.= "where nazwisko = \"". $_SESSION['nazwisko']. "\""; //"\" AND haslo = \"". md5($_SESSION['haslo']). "\"";

		//echo $kwerenda . "<br><br>";
	

	$wynik = mysqli_query($mysqli, $kwerenda)
	or die('Blad zapytania');
	}
		
		if($wynik){
			$wiersz = mysqli_fetch_assoc($wynik);
			echo mysqli_fetch_assoc($wynik);
			//echo "Zakodowane przez md5 haslo z bazy = $wiersz['haslo']<br>";
		}

?>
