<?
	session_start();
	include("nagl.php");
	include ("polacz.php");
	include("sessioncheck.php");
	
	if((isset($_SESSION['login']))&&(md5($_SESSION['login'])==$wiersz['haslo'])&&($_SESSION['nazwisko']==$wiersz['nazwisko'])&&($wiersz['uprawnienia'] == "0")){
		$fhandle = fopen($_FILES['zdjecie']['tmp_name'], "r");
        $content = base64_encode(fread($fhandle, $_FILES['zdjecie']['size']));
        fclose($fhandle);
        $zapytanie = mysqli_query($mysqli,"INSERT INTO zdjecia (zdjecie, id_pacjenta) VALUES ('$content', \"".$_POST['id_pacjenta']."\")");
        $adres = "http://student.agh.edu.pl/~borzemsk/erp/showimage.php?id=".mysqli_insert_id($mysqli);
        echo "Twoje zdjęcie otrzymało adres: <br/>".$adres;
        echo "<br/><img src=\"".$adres."\"/>";
?>

	<form action="badanie.php">
	<input type="submit" value="Wróć" />
	</form>

<?
	}
	else {
		echo "Nie masz uprawnień do tego skryptu";
	}
	include ("stopka.php");
?>