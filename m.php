<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?><!DOCTYPE html>
<html>
<meta charset="utf-8">
<head><title>tytułek</title></head>

<body>
<h1> DODAWANIE DO BAZY ted</h1><br />
<?php
error_reporting(E_ALL);
echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
	//$db = new PDO('mysql:host=mysql1.ugu.pl;dbname=db687831;charset=utf8mb4', 'db687831', 'bW9h9JewycTvfmnq', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$db = new PDO('mysql:host=localhost;dbname=ted;charset=utf8mb4', 'root', 'asd', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$tabela = 'te';
	$zapytanie = "INSERT INTO $tabela (id, haslo) VALUES ('','".$_POST['haslo']."')";
	if($_POST['haslo']){
	try {
    //connect as appropriate as above
    $db->query($zapytanie); 
	} catch(PDOException $ex) {
    echo "Error się pokazała! ".$ex->getMessage(); //user friendly message
    
	}}	
	
	//ile jest rekordów
	$zapytanie3 = "SELECT * FROM $tabela";
	try {
    $stmt = $db->query($zapytanie3); 
	} catch(PDOException $ex) {
    echo " Error się pokazał! ".$ex->getMessage(); 
    }
	$ile = $stmt->rowCount();
	$stmt->closeCursor();
	echo "<br />ilość wierszy = ".$ile;
	echo '<br />';
	//RANDOM ID
	$wylosowanyNumer = mt_rand(1,$ile);
	echo "Wylosowany numer: ".$wylosowanyNumer;	
	echo '<br />';	
	
	$zapytanie2 = "SELECT haslo FROM $tabela WHERE id=".$wylosowanyNumer;
	$stmt2 = $db->query($zapytanie2);
	foreach($stmt2 as $row) {
		echo 'Wylosowane hasło: '.$row[0]; //etc...
	}
    $stmt2->closeCursor();
?> 
<form action="m.php" method="post">
HASŁO:<br />
<input type="text" name="haslo" style="width:400px" /><br />
<input type="submit" value="dodaj" />
</form>
</body>
</html>
