<?
session_start();

if(isset($_SESSION['login'])){
	echo"Zmienne sesji -> po zalogowaniu: <br>";
		Print_r($_SESSION);
		echo "<br><br>";
		
		echo "OK " . $_SESSION['login'];
		
		$button="<form action=\"wyloguj.php\" method=\"POST\">";
		$button.= "<input type = \"submit\" value=\"Wyloguj\"/>";
		$button.= "</form>";

		echo $button;
	}else{
		echo " Nie masz uprawnien do skryptu";
}
?>
