<?
	session_start();

	include("nagl.php");

	if(isset($_SESSION)){
		session_destroy();
		$_SESSION = array();
	}
	echo "<br /><br />Zostales poprawnie wylogowany<br /><br />";
	
	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"submit\" value=\"Ponownie zaloguj\">";
	echo "</form>";
	
	include("stopka.php");
?>
