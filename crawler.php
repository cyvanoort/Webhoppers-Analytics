<?php
	require_once("facebook.php");
	
	//de functie om de url te maken zodat we het json bestand van facebook op kunnen vragen
	function fetchUrl($url){
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
 
     $retData = curl_exec($ch);
     curl_close($ch); 
 
     return $retData;
}

	//Automatisch genereren van access token
	$config = array();
	$config['appId'] = '276196792513669';
	$config['secret'] = 'fb0efd3103e9c76271926fa1041408ca';
	$config['fileUpload'] = false;
	$facebook = new Facebook($config);

	//Acces token ophalen van facebook
	$access_token = $facebook->getAccessToken();
	
	//retrieve a new Auth token
	$authToken = fetchUrl("https://graph.facebook.com/oauth/access_token?type=client_cred&client_id={$config['appId']}&client_secret={$config['secret']}");
	
	//woordenlijsten voor het analyseren van de berichten
	$words_positief = array(
				"Leuk", 
				"Super", 
				"geweldig", 
				"lekker", 
				"gezellig", 
				"geslaagd", 
				"briljant", 
				"awesome", 
				"Gezellig", 
				"Lekker eten", 
				"Leuk", 
				"Lekker", 
				"super lekker", 
				"mooi", 
				"gelukkig", 
				"Lekker", 
				"Sfeervol", 
				"Ervaring", 
				"Orde", 
				"Heerlijk", 
				"Goedkoop", 
				"Gaar", 
				"Supergoede", 
				"Betaalbaar", 
				"Stampvol", 
				"Perfect", 
				"Goeie", 
				"Vriendelijk", 
				"goede", 
				"super");
	$words_negatief = array(
				"niet", 
				"slecht", 
				"vreselijk", 
				"afschuwelijk"
			,	"Jammer"
			,	"Kleine"
			,	"Teleurstelling"
			,	"Minimale"
			,	"Geen"
			,	"Fantasieloos"
			,	"Ramp"
			,	"Bedorven"
			,	"Slechte"
			,	" Droog"
			,	"duur"
			,	"hard"
			,	"onvriendelijk"
			,	"langzaam"
			,	"lang"
			,	"geklaag"
			,	"zwart"	);
	
	//De functie om te kijken of berichten en reacties positief of negatief zijn.
	function isPositief($message) {
		if(0 < count(array_intersect(array_map('strtolower', explode(' ', $message)), $words_positief))) {
			//woord komt voor in de array nog controleren of er negative woorden voorkomen
			if(0 < count(array_intersect(array_map('strtolower', explode(' ', $message)), $words_negatief))) {
					//woord komt voor in de array dus het bericht is negatief
					return 0;
			} else {
				//woord komt niet voor in de array dus het bericht is positief
				return 2;
			}
		} else if(0 < count(array_intersect(array_map('strtolower', explode(' ', $message)), $words_negatief))) {
			//woord komt voor in de array dus het bericht is negatief
			return 0;
		} else {
			// geen van de woorden gevonden dus het bericht is neutraal	
			return 1;
		}
		return 0;
	}
	//ids is om de id's op te slaan zodat we deze op een andere pagina ook kunnen gebruiken.
	$ids = array("","","");
	$index = 0;
	
	//De hele crawler in een functie gezet zodat we meerdere bedrijven kunnen crawlen
	function crawlPage($bedrijfsID, $authToken) {
		require 'sqlconnect.php';
		//de id's opvragen
		global $ids, $index;
		
		//het json bestand opvragen
		$results = fetchUrl("https://graph.facebook.com/{$bedrijfsID}/feed?".$authToken."&limit=5000");
	
		//het bestand decode zodat we het kunnen uitlezen en gebruiken
		$json = json_decode($results);
		
		//controleren of het bedrijf al bestaat in de database zo niet toevoegen.
		$bedrijfCheck = false;
		foreach($json->data as $show) {
			$id = explode("_", $show->id);
			$likes = isset($show->likes->count) ? $show->likes->count : 0;
			$shares = isset($show->shares->count) ? $show->shares->count : 0;
			if (!$bedrijfCheck) {
				$bedrijfsId = $id[0];
				$ids[$index] = $bedrijfsId;
				$index++;
				$result = mysqli_query($link, 'SELECT * FROM Bedrijf WHERE BedrijfID='. $id[0]) or die('er ging iets mis00000 ' . mysqli_error($link));		
				if (mysqli_num_rows($result) == 0){
					mysqli_query($link, 'INSERT INTO Bedrijf VALUES ('.$id[0].', "'.$show->from->name.'")') or die('er ging1111 iets mis ' . mysqli_error($link));
				}
				$bedrijfCheck = true;
			}
			//alle gegevens van de berichten zoals de likes shares of ze positief of negatief zijn en hoevaak ze gedeeld zijn wegschrijven in de database
			//wel weer eerst controleren of deze al bestaat zo ja update zo nee toevoegen.
			$result = mysqli_query($link, "SELECT * FROM Bericht WHERE `BerichtID`=". $id[1]) or die('er ging2222 iets mis' . mysqli_error($link));		
			if (mysqli_num_rows($result) == 0){			
				mysqli_query($link, 'INSERT INTO Bericht VALUES ('.$id[1].', '.$id[0].', '.isPositief("".$show->message).', "'.$show->created_time.'", '.$likes.', '.$shares.')') or die('er ging iets3333 mis ' . mysqli_error($link));
			
			}  else  {
				mysqli_query($link, 'UPDATE Bericht SET BerichtID='.$id[1].', BedrijfID='.$id[0].', Positief='.isPositief("".$show->message).', Datum="'.$show->created_time.
											'", Likes='.$likes.', Shares='.$shares.' WHERE BerichtID='.$id[1] . '') or die('er ging iets mis4444 ' . mysqli_error($link));
			}
			
			//zelfde verhaal als met de berichten controle of het al bestaat ja updaten nee toevoegen met alle gegevens die we hebben kunnen vinden.
			foreach ($show->comments->data as $comments) {
				$commentId = explode('_', $comments->id);

				$like = isset($comments->likes->count) ? $comments->likes->count : 0;
				$result1 = mysqli_query($link, "SELECT * FROM Reactie WHERE `ReactieID`=". $commentId[2]) or die('er ging5555 iets mis' . mysqli_error($link));		
				if (mysqli_num_rows($result1) == 0){			
					mysqli_query($link, 'INSERT INTO Reactie VALUES ('.$commentId[2].', '.$commentId[0].', '.$commentId[1].', '.isPositief("".$comments->message).', '.$like.', "'.$comments->created_time.'")') or die('er ging iets6666 mis ' . mysqli_error($link));
				}  else  {
					mysqli_query($link, 'UPDATE Reactie SET ReactieID='.$commentId[2].', BedrijfID='.$commentId[0].', BerichtID='. $commentId[1].', Positief='.isPositief("".$comments->message).', Likes='.$like.', Datum="'.$comments->created_time.'" WHERE ReactieID='.$commentId[2]) or die('er ging iets mis7777 ' . mysqli_error($link));
				}
			}
		}
		//de algemene gegevens opvragen zoals de hoeveel mensen er waren en hoeveel mensen hierover praten en hoeveel de pagina leuk vinden
		$results = fetchUrl("https://graph.facebook.com/{$bedrijfsId}");
		$json = json_decode($results);
		$were_here = isset($json->were_here_count) ? $json->were_here_count : 0;
		$likes = isset($json->likes) ? $json->likes : 0;
		$talking_about = isset($json->talking_about_count) ? $json->talking_about_count : 0;
				
		//de hierboven opgegraagde gegevens wegschrijven in de database op het moment dat deze veranderd zijn.
		$result1 = mysqli_query($link, "SELECT * FROM Page WHERE `BedrijfID`=". $commentId[0]) or die('er ging5555 iets mis' . mysqli_error($link));		
		if (mysqli_num_rows($result1) == 0){			
			mysqli_query($link, 'INSERT INTO Page (pagelike, Visitors, Talk_about, BedrijfID) VALUES 
			('.$likes.', '. $were_here.', '.$talking_about.', '.$commentId[0].')') or die('er ging iets mis1010 ' . mysqli_error($link));
		}  else  {
			$equals = true;
			while ($row = mysqli_fetch_array($result1)) {
				if (intval($likes) != $row['pagelike'] || intval($were_here) != $row['Visitors']
							|| intval($talking_about) != $row['Talk_about'])
							$equals = false;
					
			}
			if (!$equals)
				mysqli_query($link, 'INSERT INTO Page (pagelike, Visitors, Talk_about, BedrijfID) VALUES ('.$likes.', '. $were_here.', '.$talking_about.', '.$commentId[0].')') or die('er ging iets mis1010 ' . mysqli_error($link));
		}
	}
	//de meerdere ingevulde bedrijven scannen
	if (empty($_GET['keyword'])){die('U heeft uw eigen bedrijf niet ingevult');}
	else if (empty($_GET['concurrent1'])){die('U heeft het veld concurrent een niet ingevult');}
	else if (empty($_GET['concurrent2'])){die('U heeft het veld concurrent twee niet ingevult');}
	else {
	crawlPage($_GET['keyword'], $authToken);
	crawlPage($_GET['concurrent1'], $authToken);
	crawlPage($_GET['concurrent2'], $authToken);
	}
	//alles doorsturen naar de pagina die de grafieken laat zien
	echo 'Redirecting to the graph';
	header('Refresh: 3; URL=highcard/results/totale-activiteit.php?B1='.$ids[0]."&B2=".$ids[1]."&B3=".$ids[2]);
	
?>