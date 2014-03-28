<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head>
    <meta charset="utf-8">
		<title>Maandelijks aantal berichten, reacties en het totaal aantal likes en shares - Facebook Crawler</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="../../style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="../../style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="../.../style.responsive.css" media="all">

    <script src="../../jquery.js"></script>
    <script src="../../script.js"></script>
    <script src="../../script.responsive.js"></script>
				<?php
					//bedrijfid opvragen
					$bedrijf1=$_GET['B1'];
					$bedrijf2=$_GET['B2'];
					$bedrijf3=$_GET['B3'];
					//variabelen voor de gegevens aanmaken
					$aantalReacties = array();
					$index = 0;
					$aantalShares = array();
					$aantalLikes = array();
					$aantalBerichten = array();
					$jaar = date("Y");
					
					//connectie met sql server maken
						require '../../sqlconnect.php';
						
						//gegevens opvragen uit de database
						$result1 = mysqli_query($link, 'SELECT Datum FROM Bericht Where YEAR(datum)="'.$jaar.'" AND BedrijfID='.$bedrijf2) or die('Er ging iets mis11111' . mysqli_error($link));
						$result2 = mysqli_query($link, 'SELECT Datum FROM Reactie Where YEAR(datum)="'.$jaar.'" AND BedrijfID='.$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
						$result3 = mysqli_query($link, 'SELECT Shares, Datum FROM Bericht Where YEAR(datum)="'.$jaar.'" AND BedrijfID='.$bedrijf2) or die('Er ging iets mis3333' . mysqli_error($link));
						$result4 = mysqli_query($link, 'SELECT Likes, Datum FROM Bericht Where YEAR(datum)="'.$jaar.'" AND BedrijfID='.$bedrijf2) or die('Er ging iets mis4444' . mysqli_error($link));
						
						//gegevens per maand uit de sql results halen
						while ($rij1 = mysqli_fetch_array($result2)){
							$month = explode("-", $rij1["Datum"]);
							$aantalReacties[intval($month[1])] += 1;
						}
						while ($rij2 = mysqli_fetch_array($result1)){
							$month2 = explode("-", $rij2["Datum"]);
							$aantalBerichten[intval($month2[1])] += 1;
						}
						while ($rij3 = mysqli_fetch_array($result3)){
							$month3 = explode("-", $rij3["Datum"]);
							$aantalShares[intval($month3[1])] += intval($rij3["Shares"]);
						}
						while ($row1 = mysqli_fetch_array($result4)){
							$month4 = explode("-", $row1["Datum"]);
							$aantalLikes[intval($month4[1])] += intval($row1["Likes"]);
						}
						?>
						
					<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
					<script type="text/javascript">
					$(function () {
					$('#container1').highcharts({
						chart: {
							type: 'line',

						},
						title: {
							text: 'Aantal Berichten, Reacties, het totaal aantal likes op de berichten en het totaal aantal keer dat iets gedeeld is per maand',
							x: -20 //center
						},
						/*subtitle: {
							text: '',
							x: -20
						},*/
						xAxis: {
							categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
								'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
						},
						yAxis: {
						min: 0,
							title: {
								text: 'Aantal'
							},
							plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
						},
						credits: {
							enabled: false
						},
						series: [{
							name: 'Aantal berichten',
							data: 	[
										<?php 
											for ($i=1; $i<=12; $i++) {
											  echo json_encode($aantalBerichten[$i]).', ';
											}
										?>
									]
										
						}, {
							name: 'Totaal Aantal Reacties',
							data: 	[
										<?php 
											for ($i=1; $i<=12; $i++) {
											  echo json_encode($aantalReacties[$i]).', ';
											}
										?>
									]
						}, {
							name: 'Totaal aantal Likes op de berichten',
							data: 	[
										<?php 
											for ($i=1; $i<=12; $i++) {
											  echo json_encode($aantalLikes[$i]).', ';
											}
										?>
									]
						}, {
							name: 'Aantal keer dat iets gedeeld is',
							data: 	[
										<?php 
											for ($i=1; $i<=12; $i++) {
											  echo json_encode($aantalShares[$i]).', ';
											}
										?>
									]
						}]
					});
				});
				</script>
			<script src="../js/highcharts.js"></script>
			<script src="../js/modules/exporting.js"></script>
</head>
<body>
<div id="wha-main">
	<header class="wha-header clearfix">
		<div class="wha-shapes">
			<h1 class="wha-headline" data-left="50%"><a href="#">Webhoppers Analytics</a></h1>
			<h2 class="wha-slogan" data-left="50%">Facebook Crawler</h2>
		</div>                   
	</header>
	<nav class="wha-nav clearfix">
		<div class="wha-nav-inner">
		<ul class="wha-hmenu">
			<?php
			echo '<li><a href="http://www.interbellum.co/facebook/index.php">Home</a></li>';
			echo '<li><a href="totale-activiteit.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'">Totale Activiteit</a></li>';
			echo '<li><a href="vergelijk.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'">Vergelijk</a></li>';
			echo '<li><a href="maandelijkse-activteit1.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'">Maandelijkse Activteit Bedrijf 1</a></li>';
			echo '<li><a href="maandelijkse-activteit2.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'" class="active">Maandelijkse Activteit Bedrijf 2</a></li>';
			echo '<li><a href="maandelijkse-activteit3.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'">Maandelijkse Activteit Bedrijf 3</a></li>';
			?>
		</ul>
        </div>
    </nav>
	<div class="wha-sheet clearfix">
		<div class="wha-layout-wrapper clearfix">
			<div class="wha-content-layout">
				<div class="wha-content-layout-row">
					<div class="wha-layout-cell wha-content clearfix">
						<article class="wha-post wha-article">
							<div class="wha-postmetadataheader">
								<h2 class="wha-postheader">Maandelijks aantal berichten, reacties en het totaal aantal likes en shares</h2>                  
							</div>
							<div class="wha-postcontent wha-postcontent-0 clearfix">
							<div id="container1" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
							</div>
						</article>
					</div>
				</div>
			</div>
		</div>
    </div>
		<footer class="wha-footer clearfix">
			<div class="wha-footer-inner">
				<p>Copyright © 2013 Webhoppers Analytics. Alle rechten voorbehouden.<br></p>
			</div>
		</footer>
</div>
</body>
</html>