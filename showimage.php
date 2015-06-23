<?
	include("nagl.php");
	include ("polacz.php");
	include("sessioncheck.php");
    
    


	//if((isset($_SESSION['login']))&&(md5($_SESSION['login'])==$wiersz['haslo'])&&($_SESSION['nazwisko']==$wiersz['nazwisko'])&&($wiersz['uprawnienia'] == "0")){
		 $result = mysqli_query($mysqli,"SELECT zdjecie FROM zdjecia WHERE id=".$_GET['id']);
		 
		 
          if (mysqli_num_rows($result) != 0)
        {
                $row = mysqli_fetch_assoc($result);
                header('Pragma: public');
				header('Cache-control: max-age=0');
				header('Content-Type: image');
				header("Content-Encoding: gzip");
				header("Vary: Accept-Encoding");
				ob_clean();
				echo gzencode( base64_decode ($row['zdjecie']) );
                //echo base64_decode($row['zdjecie']);
        }
?>


<?/*
	}
	else {
		print_r($_SESSION);
		echo "Nie masz uprawnień do tego skryptu";
	}*/
	include ("stopka.php");
?>