<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8" />
	<title>Szubienica gra JavaScript</title>
	<link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700&amp;subset=latin-ext" rel="stylesheet" /> 
	<meta name="description" content="takie koło fortuny z szubienicą w tle :D"/>
	<meta name="keywords" content="JavaScript gra w szubienice" />
<!--<script src="szubienica.js"></script>-->
	<link id="RSDlink" rel="stylesheet" type="text/css" href="szubienica.css" />


</head>
<body>
<div id="pojemnik">
	<div id="plansza"> </div>
	<div id="szubienica">
		<img src="img/s0.jpg" alt="gra szubienica by Damian Roszak" />


	</div>
	<div id="alfabet"> </div>
	<div style="clear:both;"> </div>
</div><br /> <br /> <br /> <br /><br /><br /><br /><br /><br /><br /><br />
<a id="login" href="login.php">Log In</a>
<script>
var haslo = "<?php
error_reporting(E_ALL);
	//$db = new PDO('mysql:host=mysql1.ugu.pl;dbname=db687831;charset=utf8mb4', 'db687831', 'bW9h9JewycTvfmnq', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$db = new PDO('mysql:host=localhost;dbname=ted;charset=utf8mb4', 'root', 'asd', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$tabela = 'te';
	//ile jest rekordów
	$zapytanie3 = "SELECT * FROM $tabela";
	try {
    $stmt = $db->query($zapytanie3); 
	} catch(PDOException $ex) {
    //echo " Error się pokazał! ".$ex->getMessage(); 
    }
	$ile = $stmt->rowCount();
	$stmt->closeCursor();
	//RANDOM ID
	$wylosowanyNumer = mt_rand(1,$ile);
	//wybieranie hasła
	$zapytanie2 = "SELECT haslo FROM $tabela WHERE id=".$wylosowanyNumer;
	$stmt2 = $db->query($zapytanie2);
	foreach($stmt2 as $row) {
		echo $row[0]; //etc...
	}
    $stmt2->closeCursor();
	
?>";

haslo = haslo.toUpperCase();

var dlugosc = haslo.length;
var ile_skuch = 0;

var yes = new Audio("yes.wav");
var no = new Audio("no.wav");

var haslo1 = "";

for(i=0; i<dlugosc; i++)
{
	if (haslo.charAt(i)==" ") haslo1 = haslo1 + " ";
	else haslo1 = haslo1 + "-";
}

function wypisz_haslo()
{
	document.getElementById("plansza").innerHTML = haslo1;
}

window.onload = start;
var litery = new Array(35);

litery[0] = "A";	litery[1] = "Ą";	litery[2] = "B";	litery[3] = "C";	litery[4] = "Ć";	litery[5] = "D";
litery[6] = "E";	litery[7] = "Ę";	litery[8] = "F";	litery[9] = "G";	litery[10] = "H";	litery[11] = "I";
litery[12] = "J";	litery[13] = "K";	litery[14] = "L";	litery[15] = "Ł";	litery[16] = "M";	litery[17] = "N";
litery[18] = "Ń";	litery[19] = "O";	litery[20] = "Ó";	litery[21] = "P";	litery[22] = "Q";	litery[23] = "R";
litery[24] = "S";	litery[25] = "Ś";	litery[26] = "T";	litery[27] = "U";	litery[28] = "V";	litery[29] = "W";
litery[30] = "X";	litery[31] = "Y";	litery[32] = "Z";	litery[33] = "Ź";	litery[34] = "Ż";	

function zmienCSS()
{
	document.getElementById("RSDlink").getAttribute("href") = "szubienica2.css";
}

function start()
{
	
	var tresc_diva = "";
	for (i=0; i<35; i++)
	{
		var element = "lit" + i;
		tresc_diva = tresc_diva + '<div class="litera" onclick="sprawdz('+i+')" id="'+element+'">' + litery[i] +'</div>';
		if ((i+1)%7==0) tresc_diva = tresc_diva + '<div style="clear:both;"></div>';
	}
	document.getElementById("alfabet").innerHTML = tresc_diva;
	
	
	
	
	
	wypisz_haslo();
}

String.prototype.ustawZnak = function (miejsce,znak)
{
	if(miejsce > this.length-1) return this.toString();
	else return this.substr(0, miejsce) + znak + this.substr(miejsce + 1);
}

function sprawdz(nr)
{
	var trafiona = false;
	for (i=0;i<dlugosc;i++)
	{
		if(haslo.charAt(i) == litery[nr])
		{
			haslo1 = haslo1.ustawZnak(i,litery[nr]);
			trafiona = true;
		}
	}
	
	if (trafiona == true)
	{
		yes.play();
		var element = "lit" + nr;
		document.getElementById(element).style.background = "#003300";
		document.getElementById(element).style.color = "#00C000";
		document.getElementById(element).style.border = "3px solid #00C000";
		document.getElementById(element).style.cursor = "default";
		
		
		wypisz_haslo();		
	}
	else
	{
		no.play();
		var element = "lit" + nr;
		document.getElementById(element).style.background = "#330000";
		document.getElementById(element).style.color = "#C00000";
		document.getElementById(element).style.border = "3px solid #C00000";
		document.getElementById(element).style.cursor = "default";	
		document.getElementById(element).setAttribute("onclick",";");
		
		ile_skuch++;
		var obraz = "img/s"+ile_skuch+".jpg";
		document.getElementById("szubienica").innerHTML = '<img src ="'+obraz+'" alt="Gra w szubienice by Damian Roszak NAJLEPSZE WWW" />';
	}
	
	//wygrana
	if (haslo == haslo1)
		document.getElementById("alfabet").innerHTML = "Wygrałeś/aś! Podano prawidłowe hasło: "+haslo+'<br /><br /><span class="reset" onclick="location.reload()">JESZCZE RAZ?</span>';
	
	if(ile_skuch>=9) document.getElementById("alfabet").innerHTML = "Błędne hasło! Prawidłowe jest takie: "+haslo+'<br /><br /><span class="reset" onclick="location.reload()">WISISZ :P</span>';
}
</script>
</body>
</html>